<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class DeliveredProductModel extends Model
{

    use HasFactory, Notifiable;

    protected $table        = 'delivered_product';
    protected $primaryKey   = 'deliveredID';


    protected $fillable = [
        'delivery_userID',
        'receiver_userID',
        'order_number',
        'transactionID',
        'delivery_code',
        'created_at',
        'updated_at',
    ];


    protected $casts = [];

    protected $hidden = [];

    public $timestamps = false;

}
