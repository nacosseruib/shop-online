<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class UserProfileModel extends Model
{
    use HasFactory, Notifiable;

    protected $table        = 'user_profile';
    protected $primaryKey   = 'user_profileID';


    protected $fillable = [
        'userID',
        'first_name',
        'last_name',
        'gender',
        'profile_picture',
        'phone_number',
        'storeID',
        'user_typeID',
        'currencyID',
        'is_store_suspended',
        'store_country',
        'store_state',
        'store_city',
        'store_latitude',
        'store_logtitude',
        'store_zip_code',
        'store_ip_address',
        'store_name',
        'store_address1',
        'store_address2',
        'delivery_address',
        'store_phone_number',
        'store_description',
        'store_logo',
        'store_advert_banner',
        'how_did_you_know_about_usID',
        'store_premium',
        'created_at',
        'updated_at',
        'status',
        'user_role',

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
