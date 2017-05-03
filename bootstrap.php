<?php
/*
 * (c) Zeokat
 */

namespace Zeokat\FollowAutolink;

use Illuminate\Contracts\Events\Dispatcher;

return function (Dispatcher $events) {
    $events->subscribe(Listener\AddBBCode::class);
};
