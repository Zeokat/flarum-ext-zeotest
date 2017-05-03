<?php

/*
 * (c) Zeokat
 */

namespace Zeokat\FollowAutolink\Listener;

use Flarum\Event\ConfigureFormatter;
use Illuminate\Contracts\Events\Dispatcher;

class AddBBCode
{
    public function subscribe(Dispatcher $events)
    {
        $events->listen(ConfigureFormatter::class, [$this, 'addBBCode']);
    }
    
    public function addBBCode(ConfigureFormatter $event)
    {
        $event->configurator->BBCodes->addCustom(
            '[INTURL]{URL},{TEXT}[/INTURL]',
            '<a href="{URL}">{TEXT}</a>'
        );
        
        $event->configurator->BBCodes->addCustom(
            '[INTURLB]{URL},{TEXT}[/INTURLB]',
            '<a href="{URL}" target="_blank" rel="noopener noreferrer">{TEXT}</a>'
        );
        
        $event->configurator->BBCodes->addCustom(
            '[INTURLC={URL}]{TEXT}[/INTURLC]',
            '<a href="{URL}" target="_blank" rel="noopener noreferrer">{TEXT}</a>'
        );
    }
}
