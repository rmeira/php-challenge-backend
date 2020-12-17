<?php

namespace App\Observers;

use App\Jobs\XmlProcessJob;
use App\Models\XmlProcess;

class XmlProcessObserver
{
    /**
     * Handle the XmlProcess "created" event.
     *
     * @param  \App\Models\XmlProcess  $xmlProcess
     * @return void
     */
    public function created(XmlProcess $xmlProcess)
    {
        XmlProcessJob::dispatch($xmlProcess);
    }
}
