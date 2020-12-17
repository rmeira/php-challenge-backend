<?php

namespace App\Jobs;

use App\Models\XmlProcess;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class XmlProcessJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * XmlProcess model
     *
     * @var object
     */
    protected $xmlProcess;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(XmlProcess $xmlProcess)
    {
        $this->xmlProcess = $xmlProcess;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $xmlFile = simplexml_load_string(storage_get($this->xmlProcess->file));

        return ($xmlFile);
    }
}
