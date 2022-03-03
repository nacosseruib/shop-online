<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class HearAboutUsModel extends Model
{
    use HasFactory, Notifiable;

    protected $table        = 'hear_about_us';
    protected $primaryKey   = 'hear_aboutID';


    protected $fillable = [
        'how_hear_us',
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
