<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\Subscriptions\SubscriptionResource;
use App\Http\Resources\Subscriptions\SubscriptionCollection;

class SubscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subscriptions = Subscription::all();
        return new SubscriptionCollection($subscriptions);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'property_id' => 'required|integer',
            'client_id' => 'required|integer',
            'plan_id' => 'required|integer',
            'payment_type' => 'required|in:debit,card',
        ], []);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'The given data was invalid.',
                'errors' => $validator->errors()
            ], 400);
        }

        $subscription = Subscription::create([
            'property_id' => $request->property_id,
            'client_id' => $request->client_id,
            'plan_id' => $request->plan_id,
            'payment_type' => $request->payment_type,
            'status' => true,
            'init_date' => Carbon::now(),
            'end_date' => Carbon::now()->addYear(),
        ]);

        return new SubscriptionResource($subscription);
    }

    /**
     * Display the specified resource.
     */
    public function show(Subscription $subscription)
    {
        return new SubscriptionResource($subscription);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
