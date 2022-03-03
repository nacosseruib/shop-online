<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class ProductImageModel extends Model
{

    use HasFactory, Notifiable;

    protected $table        = 'product_image';
    protected $primaryKey   = 'product_imageID';


    protected $fillable = [
        'userID',
        'productID',
        'file_name',
        'file_description',
        'created_at',
    ];


    protected $casts = [];

    protected $hidden = [];

    public $timestamps = false;

}
