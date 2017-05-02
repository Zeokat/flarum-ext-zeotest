<?php
/*
 * (c) Zeokat
 */
 
use Zeokat\FollowAutolink\Listener;
use Illuminate\Contracts\Events\Dispatcher;

return function (Dispatcher $events) {
    $events->subscribe(Listener\FormatFollowAutolink::class);
};
