<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class SizeModel extends Model
{
    use HasFactory, Notifiable;

    protected $table        = 'product_size';
    protected $primaryKey   = 'sizeID';


    protected $fillable = [
        'size_name',
        'size_code',
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
