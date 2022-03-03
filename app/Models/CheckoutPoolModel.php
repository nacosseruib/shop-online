<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
//use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Uuid;

class CheckoutPoolModel extends Model
{

    use HasFactory, Notifiable;
    protected $guarded      = [];
    protected $table        = 'checkout_pool';
    protected $primaryKey   = 'poolID';


    protected $fillable = [
        'userID',
        'receiverID',
        'user_store_details',
        'order_number',
        'receiver_order_number',
        'percentage_rate_from',
        'percentage_rate_to',
        'total_cart_amount',
        'receiver_total_amount',
        'is_item_delivered_to_user',
        'item_quantity',
        'cart_item_list',
        'created_at',
        'updated_at',
    ];


    protected $casts = [];

    protected $hidden = [];

    public $timestamps = false;

}
