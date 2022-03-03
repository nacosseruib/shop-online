<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class UserAmountLevelModel extends Model
{
    use HasFactory, Notifiable;

    protected $table        = 'user_amount_level';
    protected $primaryKey   = 'user_levelID';


    protected $fillable = [
        'userID',
        'level',
        'status',
        'updated_at',
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
