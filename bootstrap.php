<?php
/*
 * (c) Zeokat
 */

namespace Zeokat\AddOgData;

use Illuminate\Contracts\Events\Dispatcher;

return function (Dispatcher $events) {
    $events->subscribe(Listener\AddOgMetaData::class);
};
