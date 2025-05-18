<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    use HasUuids;
    public $incrementing = false;
    protected $fillable = [
        'customer_id',
        'laundry_id',
        'service_id',
        'jenis',
        'status',
        'barcode',
        'weight',
        'total_price',
        'note',
        'order_date',
    ];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function laundry(): BelongsTo
    {
        return $this->belongsTo(Laundry::class);
    }
    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }
}
