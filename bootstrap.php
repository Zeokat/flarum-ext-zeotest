<?php
/*
 * (c) Zeokat
 */

namespace oe800\FollowAutolink;

use Illuminate\Contracts\Events\Dispatcher;

return function (Dispatcher $events) {
    $events->subscribe(Listeners\AddBBCode::class);
};
