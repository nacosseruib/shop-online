<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class UserTypeModel extends Model
{
    use HasFactory, Notifiable;

    protected $table        = 'user_type';
    protected $primaryKey   = 'user_typeID';


    protected $fillable = [
        'type_name',
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
