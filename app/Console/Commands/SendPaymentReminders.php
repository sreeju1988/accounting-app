<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\ServiceBooking;
use App\Mail\PaymentReminderMail;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class SendPaymentReminders extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'payments:send-reminders';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send payment reminder emails for completed service orders with pending balance';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Checking for pending payments...');

        $orders = ServiceOrder::where('status', 'completed')
            ->whereDate('updated_at', '<=', Carbon::now()->subDays(2))
            ->get();

        $count = 0;

        foreach ($orders as $order) {
            $paid = $order->payments->sum('amount');
            $total = $order->total_fee ?? 0;

            if ($total > $paid) {
                $balance = $total - $paid;
                if ($order->agent && $order->agent->email) {
                    Mail::to($order->agent->email)->send(new PaymentReminderMail($order, $balance));
                    $count++;
                }
            }
        }

        $this->info("Sent {$count} payment reminder(s).");
        return 0;
    
    }
}
