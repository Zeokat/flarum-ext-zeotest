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
            // Add google analytics if tracking UA has been configured.
            if ($this->settings->get('flagrow.analytics.statusGoogle') && $this->settings->get('flagrow.analytics.googleTrackingCode')) {
                $rawJs = file_get_contents(realpath(__DIR__ . '/../../assets/js/google-analytics.js'));
                $js    = str_replace("%%TRACKING_CODE%%", $this->settings->get('flagrow.analytics.googleTrackingCode'), $rawJs);
                $event->view->addHeadString($js);
            }
        }
    }
}
