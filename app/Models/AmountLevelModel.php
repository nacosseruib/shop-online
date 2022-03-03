<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class AmountLevelModel extends Model
{
    use HasFactory, Notifiable;

    protected $table        = 'amount_level';
    protected $primaryKey   = 'amount_levelID';


    protected $fillable = [
        'stage',
        'amount',
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
