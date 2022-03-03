<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
//use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Uuid;

class ProductCommentModel extends Model
{

    use HasFactory, Notifiable;
    protected $guarded      = [];
    protected $table        = 'product_comment';
    protected $primaryKey   = 'commentID';


    protected $fillable = [
        'userID',
        'productID',
        'comment',
        'name',
        'email',
        'status',
        'created_at',
        'updated_at',
    ];


    protected $casts = [];

    protected $hidden = [];

    public $timestamps = false;

}
