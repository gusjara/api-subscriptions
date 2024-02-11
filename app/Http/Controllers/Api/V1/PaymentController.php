<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Payment;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Number;
use App\Http\Controllers\Controller;
use App\Http\Resources\Payments\PaymentResource;
use App\Http\Resources\Payments\PaymentCollection;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $payments = Payment::all();
        return new PaymentCollection($payments);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
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

        $total_amount = 0;

        foreach ($payment->subscriptions as $subscription) {
            $total_amount = $total_amount + $subscription->plan->price;
        }

        $payment->total_amount = $total_amount;
        $payment->save();

        return new PaymentResource($payment);
    }

    /**
     * Display the specified resource.
     */
    public function show(Payment $payment)
    {
        return new PaymentResource($payment);
    }

    /**
     * Display the specified resource by code lote.
     */
    public function showByCode($code)
    {
        $payment = Payment::where('lote', $code)->first();

        if (!$payment) {
            return response()->json([
                'status' => false,
                'message' => "Error. The requested resource does not exist"
            ], 404);
        }
        return new PaymentResource($payment);
    }

    public function amountsQuantityById(Payment $payment)
    {
        $data = [
            'id' => $payment->id,
            'lote' => $payment->lote,
            'total_amount' => Number::currency($payment->total_amount, 'ARS', 'arg'),
            'total_subcriptions' => count($payment->subscriptions)
        ];

        return response()->json([
            'data' => $data
        ]);
    }

    public function amountsQuantityByCode($code)
    {
        $payment = Payment::where('lote', $code)->first();

        if (!$payment) {
            return response()->json([
                'status' => false,
                'message' => "Error. The requested resource does not exist"
            ], 404);
        }

        $data = [
            'id' => $payment->id,
            'lote' => $payment->lote,
            'total_amount' => Number::currency($payment->total_amount, 'ARS', 'arg'),
            'total_subcriptions' => count($payment->subscriptions)
        ];

        return response()->json([
            'data' => $data
        ]);
    }
}
