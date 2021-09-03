<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'total',
        'shipping_total',
        'create_time',
        'timezone',
    ];

    /**
     * @param array $data
     * @return Order
     */
    public static function saveFromApi(array $data):Order
    {
        $order = Order::where('id', $data['id'])->first(['id', 'total', 'shipping_total', 'create_time', 'timezone']);

        if (empty($order)) {
            $order = new Order($data);
            $order->save();
        }

        return $order;
    }
}
