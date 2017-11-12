<?php

/*
 * (c) Zeokat
 */

namespace Zeokat\AddOgData\Listener;

use Flarum\Event\ConfigureFormatter;
use Illuminate\Contracts\Events\Dispatcher;

class AddOgMetaData
{
    public function subscribe(Dispatcher $events)
    {
        $events->listen(ConfigureFormatter::class, [$this, 'addBBCode']);
    }
    
    public function addBBCode(ConfigureFormatter $event)
    {
        $event->configurator->BBCodes->addCustom(
            '[INTURL={URL}]{TEXT}[/INTURL]',
            '<a href="{URL}">{TEXT}</a>'
        );
        
        $event->configurator->BBCodes->addCustom(
            '[INTURLB={URL}]{TEXT}[/INTURLB]',
            '<a href="{URL}" target="_blank" rel="noopener noreferrer">{TEXT}</a>'
        );
    }
}
