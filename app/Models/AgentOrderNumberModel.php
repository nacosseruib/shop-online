<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Uuid;

class AgentOrderNumberModel extends Model
{

    use HasFactory, Notifiable;

    //Using UUID
    use Uuid;
    protected $keyType      = 'string';
    public $incrementing    = false;
    protected $guarded      = [];

    protected $table        = 'agent_order';
    protected $primaryKey   = 'agent_orderID';


    protected $fillable = [
        'senderID',
        'receiverID',
        'message',
        'order_number',
        'flag',
        'is_active',
        'updated_at',
        'created_at',
        'is_deleted'
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
