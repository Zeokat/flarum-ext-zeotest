<?php

/*
 * (c) Zeokat
 */

namespace Zeokat\AddOgData\Listener;

use Flarum\Event\ConfigureClientView;
use Illuminate\Contracts\Events\Dispatcher;

class AddOgMetaData
{
    /**
     * @param Dispatcher $events
     */
    public function subscribe(Dispatcher $events)
    {
        $events->listen(ConfigureClientView::class, [$this, 'addAssets']);
    }
    
    public function addAssets(ConfigureClientView $event)
    {
        if ($event->isForum()) {
            $ogdata = '<meta property="og:site_name" content="foro.vozidea.com" />';
            $event->view->addHeadString($ogdata);
        }
    }
}
