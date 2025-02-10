<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use App\Models\order;

class CancelUnpickedOrders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */

    /**
     * Execute the console command.
     */
    protected $signature = 'orders:cancel-unpicked';
    protected $description = 'Cancel unpicked orders after 5 PM';

    public function handle()
    {
        $currentDate = Carbon::now()->format('Y-m-d');
        $cutoffTime = Carbon::createFromTimeString('17:00:00');

        // Fetch orders with 'for pickup' status, scheduled for today
        $unpickedOrders = Order::where('delivery_status', 'for pickup')
            ->whereDate('delivery_date', $currentDate)
            ->whereTime('delivery_date', '<=', $cutoffTime)
            ->get();

        foreach ($unpickedOrders as $order) {
            $order->update([
                'delivery_status' => 'cancelled',
                'cancel_reason' => 'Not picked up on time',
                'other_reason' => 'Automatic Cancel'
            ]);
        }

        $this->info('Unpicked orders have been canceled successfully.');
    }
}
