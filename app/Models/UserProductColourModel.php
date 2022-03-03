<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class UserProductColourModel extends Model
{
    use HasFactory, Notifiable;

    protected $table        = 'user_product_colour';
    protected $primaryKey   = 'user_product_colourID';


    protected $fillable = [
        'userID',
        'productID',
        'colourID',
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
