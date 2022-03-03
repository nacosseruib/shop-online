<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class ColourModel extends Model
{
    use HasFactory, Notifiable;

    protected $table        = 'product_colour';
    protected $primaryKey   = 'colourID';


    protected $fillable = [
        'colour_name',
        'colour_code',
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
