<?php

namespace App\Console\Commands;

use App\Jobs\Bling\BlingSyncData;
use App\Models\BlingToken;
use Illuminate\Console\Command;

class BlingSync extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:bling-sync';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $blingTokens = BlingToken::where('sync', '<>', '2')
            ->where('access_token', '<>', '')
            ->get();

        foreach ($blingTokens as $blingToken) {
            BlingSyncData::dispatch($blingToken);
        }
    }
}
