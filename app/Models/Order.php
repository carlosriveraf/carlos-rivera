<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'orders';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'order_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['nro_pedido', 'id_vendedor', 'id_repartidor', 'estado',];

    public function details(): HasMany
    {
        return $this->hasMany(OrderDetail::class, 'order_id');
    }

    public function status(): BelongsTo
    {
        return $this->belongsTo(Status::class, 'estado', 'status_id');
    }

    public static function getNextOrderNumber()
    {
        $lastSequence = SequenceOrder::orderBy('sequence_value', 'desc')->first();

        $nextOrderNumber = $lastSequence ? $lastSequence->sequence_value + 1 : 1;

        SequenceOrder::create(['sequence_value' => $nextOrderNumber]);

        return str_pad($nextOrderNumber, 8, '0', STR_PAD_LEFT);
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($order) {
            if (is_null($order->nro_pedido)) {
                $order->nro_pedido = self::getNextOrderNumber();
            }
        });
    }
}
