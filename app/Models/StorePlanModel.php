<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class StorePlanModel extends Model
{
    use HasFactory, Notifiable;

    protected $table        = 'store_premium';
    protected $primaryKey   = 'premiumID';


    protected $fillable = [
        'premium_name',
        'premium_days',
        'price',
        'currency',
        'status'
    ];


    protected $casts = [];

    protected $hidden = [];

    public $timestamps = false;

}
