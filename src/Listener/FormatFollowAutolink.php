<?php

/*
 * (c) Zeokat
 */

namespace Zeokat\FollowAutolink\Listener;

use Flarum\Event\ConfigureFormatter;
use Flarum\Settings\SettingsRepositoryInterface;
use Illuminate\Contracts\Events\Dispatcher;

class FormatFollowAutolink
{
    /**
     * @var SettingsRepositoryInterface
     */
    protected $settings;

    /**
     * @param SettingsRepositoryInterface $settings
     */
    public function __construct(SettingsRepositoryInterface $settings)
    {
        $this->settings = $settings;
    }

    /**
     * @param Dispatcher $events
     */
    public function subscribe(Dispatcher $events)
    {
        $events->listen(ConfigureFormatter::class, [$this, 'addFollowAutolinkFormatter']);
    }

    /**
     * @param ConfigureFormatter $event
     */
    public function addFollowAutolinkFormatter(ConfigureFormatter $event)
    {
        $event->configurator->plugins->set(
            'FollowInternalAutolink',
            "Zeokat\\FollowAutolink\\TextFormatter\\Plugins\\FollowInternalAutolink\\Configurator"
        );
    }
}
