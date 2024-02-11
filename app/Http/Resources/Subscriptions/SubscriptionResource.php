<?php

namespace App\Http\Resources\Subscriptions;

use App\Http\Resources\Clients\ClientResource;
use Illuminate\Http\Request;
use Illuminate\Support\Number;
use App\Http\Resources\Plans\PlanResoruce;
use App\Http\Resources\Plans\PlanResource;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Properties\PropertyResource;

class SubscriptionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'property_name' => $this->property->name,
            'plan_name' => $this->plan->name,
            'plan_price' => Number::currency($this->plan->price, 'ARS', 'arg'),
            'payment_type' => $this->payment_type,
            'status' => $this->status,
            'fecha_inicio' => $this->init_date->format('d-m-Y'),
            'fecha_fin' => $this->end_date->format('d-m-Y'),
            'contact_email' => $this->client->email,
            'proerty' => $this->property_id ? new PropertyResource($this->property) : null,
            'plan' => $this->plan_id ? new PlanResource($this->plan) : null,
            'client' => $this->client_id ? new ClientResource($this->client) : null,
        ];
    }
}
