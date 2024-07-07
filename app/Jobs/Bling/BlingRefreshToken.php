<?php

namespace App\Jobs\Bling;

use App\Models\BlingToken;
use App\Models\User;
use App\Services\BlingRefreshTokenService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class BlingRefreshToken implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $service;

    /**
     * Create a new job instance.
     */
    public function __construct(BlingToken $bling_token)
    {
        $this->service = new BlingRefreshTokenService($bling_token);
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $this->service->execute();
    }
}
