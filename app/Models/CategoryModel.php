<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class CategoryModel extends Model
{
    use HasFactory, Notifiable;

    protected $table        = 'product_category';
    protected $primaryKey   = 'categoryID';


    protected $fillable = [
        'category',
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
