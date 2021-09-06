<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Contracts\WearepentagonApiInterface;

class Product extends Model implements WearepentagonApiInterface
{
    use HasFactory;

    protected $fillable = [
        'SKU',
        'title',
        'image',
    ];

    /**
     * @param array $data
     * @return WearepentagonApiInterface
     */
    public static function saveFromApi(array $data): WearepentagonApiInterface
    {
        $product = Product::where('SKU', $data['SKU'])->first(['title', 'SKU', 'image']);

        if (empty($product)) {
            $product = new Product($data);
            $product->save();
        }

        if (isset($product["id"])) {
            unset($product["id"]);
        }

        return $product;
    }
}
