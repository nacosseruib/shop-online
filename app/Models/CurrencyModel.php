<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class CurrencyModel extends Model
{
    use HasFactory, Notifiable;

    protected $table        = 'currency';
    protected $primaryKey   = 'currencyID';


    protected $fillable = [
        'currency_name',
        'currency_symbol',
        'status',
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
