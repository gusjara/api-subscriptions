<?php

namespace App\Http\Resources\Payments;

use Illuminate\Http\Request;
use Illuminate\Support\Number;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Subscriptions\SubscriptionCollection;

class PaymentResource extends JsonResource
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
            'lote' => $this->lote,
            'total_subcriptions' => count($this->subscriptions),
            'total_amount' => Number::currency($this->total_amount, 'ARS', 'arg'),
            'status' => $this->status,
            'periodo_sufix' => $this->period_sufix,
            'period_start' => $this->period_start->format('d-m-Y'),
            'period_end' => $this->period_end->format('d-m-Y'),
            'generate_date' => $this->generate_date->format('d-m-Y'),
            'send_to_pay_date' => $this->send_to_pay_date?->format('d-m-Y') ?? false,
            'paid_date' => $this->paid_date?->format('d-m-Y') ?? false,
            'subscripciones' => $this->subscriptions ? new SubscriptionCollection($this->subscriptions) : null,
        ];
    }
}
