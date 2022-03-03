<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
//use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Uuid;

class DeliveredUserProductModel extends Model
{

    use HasFactory, Notifiable;
    protected $guarded      = [];
    protected $table        = 'delivered_user_product';
    protected $primaryKey   = 'deliveredID';


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
        'item_quantity',
        'cart_item_list',
        'created_at',
        'updated_at',
        'is_active',
        'buy_from_store',
        'user_experience',
    ];


    protected $casts = [];

    protected $hidden = [];

    public $timestamps = false;

}
