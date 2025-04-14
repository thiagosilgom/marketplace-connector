<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Offer
 *
 * @property int $id
 * @property string $reference
 * @property string|null $title
 * @property string|null $description
 * @property string|null $status
 * @property int $stock
 * @property float|null $price
 * @property array|null $images
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 */
class Offer extends Model
{
    protected $fillable = [
        'reference',
        'title',
        'description',
        'status',
        'stock',
        'price',
        'images',
    ];

    protected $casts = [
        'images' => 'array',
        'price' => 'float',
    ];
}
