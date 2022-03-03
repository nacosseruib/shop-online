<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class AgentRatingModel extends Model
{
    use HasFactory, Notifiable;

    protected $table        = 'agent_rating';
    protected $primaryKey   = 'ratingID';


    protected $fillable = [
        'user_rating',
        'agent_userID',
        'status',
        'updated_at',
        'rating'
    ];


    protected $casts = [];

    protected $hidden = [];

    public $timestamps = false;

}
