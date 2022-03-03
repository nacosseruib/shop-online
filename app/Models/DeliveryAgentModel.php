<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Uuid;

class DeliveryAgentModel extends Model
{

    use HasFactory, Notifiable;

    //Using UUID
    use Uuid;
    protected $keyType      = 'string';
    public $incrementing    = false;
    protected $guarded      = [];

    protected $table        = 'delivery_agent';
    protected $primaryKey   = 'agentID';


    protected $fillable = [
        'userID',
        'ID',
        'agent_fullname',
        'gender',
        'address',
        'phone_number',
        'email',
        'picture',
        'delivery_charge_plan',
        'status',
        'created_at',
        'updated_at',
        'admin_status'
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
