<?php

namespace App\Console\Commands;

use App\Models\HistoryTransaction;
use App\Models\Transaction;
use App\Services\HistoryTransactionService;
use Illuminate\Console\Command;

class DepreciateAssets extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'depreciation:calculate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Calculate straight line and reducing balance depreciation for all transactions';

    protected $service;

    public function __construct(HistoryTransactionService $service)
    {
        parent::__construct();
        $this->service = $service;
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        info('Command runs every minute.');
        $histories = HistoryTransaction::all();
        $latestHistories = $histories->groupBy('transaction_id')->map(function ($group) {
            return $group->sortByDesc('created_at')->first();
        });

        foreach ($latestHistories as $latestHistory) {
            $transaction = Transaction::with('asset')->find($latestHistory->transaction_id);

            info("Processing transaction: {$latestHistory->transaction_id} - {$latestHistory->name}");
            try {
                $this->service->depreciateMonthly($latestHistory, $transaction);
                info("Depreciation processed for asset: {$transaction->name}");
            } catch (\Exception $e) {
                info("Error processing transaction {$transaction->transaction_id}: " . $e->getMessage());
            }
        }

        info('Monthly depreciation completed.');
    }
}
