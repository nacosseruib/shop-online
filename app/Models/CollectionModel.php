<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class CollectionModel extends Model
{
    use HasFactory, Notifiable;

    protected $table        = 'product_collection';
    protected $primaryKey   = 'collectionID';


    protected $fillable = [
        'categoryID',
        'collection',
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
