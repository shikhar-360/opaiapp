<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use Illuminate\Support\Facades\Log;

use App\Services\LeadershipIncomeService;

class LeadershipIncome extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:leadership-income';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(LeadershipIncomeService $svc)
    {
        $svc->assignLeadership();
        $this->info('Leadership rank assigned successfully.');
        // Log::info('Leadership rank assigned successfully.');
        return self::SUCCESS;
    }
}
