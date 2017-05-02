<?php

/*
 * (c) Zeokat
 */

namespace Zeokat\FollowAutolink\Listener;

use Flarum\Event\ConfigureFormatter;
use Flarum\Event\ConfigureFormatterParser;
use Flarum\Event\ConfigureFormatterRenderer;
use Illuminate\Contracts\Events\Dispatcher;

class FormatFollowAutolink
{
    /**
     * @param Dispatcher $events
     */
    public function subscribe(Dispatcher $events)
    {
        $events->listen(ConfigureFormatter::class, [$this, 'configure']);
        $events->listen(ConfigureFormatterParser::class, [$this, 'parse']);
        $events->listen(ConfigureFormatterRenderer::class, [$this, 'render']);
    }

     /**
     * @param ConfigureFormatter $event
     */
    public function configure(ConfigureFormatter $event)
    {
        $configurator = $event->configurator;

        $tagName = 'USERMENTION';

        $tag = $configurator->tags->add($tagName);
        $tag->attributes->add('username');
        $tag->attributes->add('id')->filterChain->append('#uint');
        $tag->attributes['id']->required = false;

        $tag->template = '<a href="{$PROFILE_URL}{@username}" class="UserMention">@<xsl:value-of select="@username"/></a>';
        $tag->filterChain->prepend([static::class, 'addId'])
            ->addParameterByName('userRepository')
            ->setJS('function() { return true; }');

        $configurator->Preg->match('/\B@(?<username>[a-z0-9_-]+)(?!#)/i', $tagName);
    }

    /**
     * @param ConfigureFormatterParser $event
     */
    public function parse(ConfigureFormatterParser $event)
    {
        $event->parser->registeredVars['userRepository'] = $this->users;
    }

    /**
     * @param ConfigureFormatterRenderer $event
     */
    public function render(ConfigureFormatterRenderer $event)
    {
        $event->renderer->setParameter('PROFILE_URL', $this->url->toRoute('user', ['username' => '']));
    }

    /**
     * @param $tag
     * @param UserRepository $users
     * @return bool
     */
    public static function addId($tag, UserRepository $users)
    {
        if ($id = $users->getIdForUsername($tag->getAttribute('username'))) {
            $tag->setAttribute('id', $id);

            return true;
        }
    }
}
