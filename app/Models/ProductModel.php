<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Uuid;

class ProductModel extends Model
{

    use HasFactory, Notifiable;

    //Using UUID
    use Uuid;
    protected $keyType      = 'string';
    public $incrementing    = false;
    protected $guarded      = [];

    protected $table        = 'product';
    protected $primaryKey   = 'productID';


    protected $fillable = [
        'userID',
        'currencyID',
        'product_code',
        'product_token',
        'product_name',
        'original_price',
        'old_price',
        'categoryID',
        'collectionID',
        'brand',
        'is_available',
        'is_comment',
        'is_online',
        'product_details',
        'product_feature',
        'payment_method',
        'created_at',
        'updated_at',
        'admin_status',
        'is_deleted'

    ];



    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [];

    protected $hidden = [];

    public $timestamps = false;

}
