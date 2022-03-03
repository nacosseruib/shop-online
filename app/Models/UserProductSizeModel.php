<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class UserProductSizeModel extends Model
{
    use HasFactory, Notifiable;

    protected $table        = 'user_product_size';
    protected $primaryKey   = 'user_product_sizeID';


    protected $fillable = [
        'userID',
        'productID',
        'sizeID',
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
