<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'SKU',
        'title',
        'image',
    ];

    /**
     * @param array $data
     * @return Product
     */
    public static function saveFromApi(array $data): Product
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
