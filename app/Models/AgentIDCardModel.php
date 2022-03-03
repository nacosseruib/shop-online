<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class AgentIDCardModel extends Model
{

    use HasFactory, Notifiable;

    protected $table        = 'agent_id_card';
    protected $primaryKey   = 'agent_id_cardID';


    protected $fillable = [
        'userID',
        'agentID',
        'file_name',
        'approved',
        'created_at',
    ];


    protected $casts = [];

    protected $hidden = [];

    public $timestamps = false;

}
