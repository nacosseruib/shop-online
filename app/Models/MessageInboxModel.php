<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Uuid;

class MessageInboxModel extends Model
{

    use HasFactory, Notifiable;

    //Using UUID
    use Uuid;
    protected $keyType      = 'string';
    public $incrementing    = false;
    protected $guarded      = [];

    protected $table        = 'message_inbox';
    protected $primaryKey   = 'inboxID';


    protected $fillable = [
        'senderID',
        'receiverID',
        'message',
        'file_name',
        'flag',
        'is_active',
        'can_reply',
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
