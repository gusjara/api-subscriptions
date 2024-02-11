<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Plan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\Plans\PlanResource;
use App\Http\Resources\Plans\PlanCollection;

class PlanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $plans = Plan::all();
        return new PlanCollection($plans);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'price' => 'required|numeric',
        ], []);

        if ($validator->fails()) {
            return response()->json([
                'messahe' => 'The given data was invalid.',
                'errors' => $validator->errors()
            ], 400);
        }

        $plan = Plan::create([
            'name' => $request->name,
            'price' => $request->price,
            'active' => true,
        ]);

        return new PlanResource($plan);
    }

    /**
     * Display the specified resource.
     */
    public function show(Plan $plan)
    {
        return new PlanResource($plan);
    }
}
