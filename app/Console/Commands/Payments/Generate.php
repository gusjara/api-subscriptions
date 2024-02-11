<?php

namespace App\Console\Commands\Payments;

use App\Models\Payment;
use App\Models\Subscription;
use Illuminate\Support\Carbon;
use Illuminate\Console\Command;

class Generate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'payments:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Comando para generar los pagos (lotes) los días 5 de cada mes';

    /**
     * Execute the console command.
     */
    public function handle()
    {

        $payment = Payment::where('period_sufix', date('m-Y'))->first();

        if (!$payment) {

            $subscriptions = Subscription::where('status', true)
                ->where('end_date', '>=', now())
                ->pluck('id');

            $payment = Payment::create([
                'lote' =>  md5(date('m-Y')),
                'status' =>  Payment::GENERATE,
                'period_sufix' => date('m-Y'),
                'period_start' => Carbon::now(),
                'period_end' => Carbon::now()->addMonth(1),
                'generate_date' => Carbon::now(),
            ]);

            $payment->subscriptions()->attach($subscriptions);
        }
    }
}
