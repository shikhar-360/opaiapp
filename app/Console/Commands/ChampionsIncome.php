<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use Illuminate\Support\Facades\Log;

use App\Services\LeadershipChampionsIncomeService;

class ChampionsIncome extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:champions-income';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(LeadershipChampionsIncomeService $svc)
    {
        $svc->assignLeadershipchampions();
        $this->info('Champions rank assigned successfully.');
        Log::info('Champions rank assigned successfully.');
        return self::SUCCESS;
    }
}
