<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
//use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Uuid;

class CartModel extends Model
{

    use HasFactory, Notifiable;
    protected $guarded      = [];
    protected $table        = 'product_cart';
    protected $primaryKey   = 'cartID';


    protected $fillable = [
        'userID',
        'productID',
        'quantity',
        'status',
        'transactionID',
        'order_number',
        'is_order_placed',
        'is_cancel',
        'is_item_delivered',
        'store_token',
        'delivery_code',
        'checkout',
        'created_at',
        'updated_at',
        'is_item_confirm_by_store',
    ];


    protected $casts = [];

    protected $hidden = [];

    public $timestamps = false;

}
