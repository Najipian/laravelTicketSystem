<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Landlord extends Model
{
    //
    protected $table = "landlords";

    protected $fillable = [
        'user_id', 'parent_landlord_id'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function landlord_account_users(){
        return $this->hasMany('App\Landlord', 'parent_landlord_id');
    }

    public function parent_landlord()
    {
        return $this->belongsTo('App\Landlord' , 'parent_landlord_id');
    }

    public function assigned_tickets(){
        return $this->hasMany('App\Ticket' , 'assigned_landlord_id');
    }

    public function tickets(){
        return $this->hasManyThrough(
            'App\Ticket',
            'App\Property',
            'landlord_id',
            'property_id',
            'id',
            'id'
        );
    }

    public function properties(){
        return $this->hasMany('App\Property' , 'landlord_id');
    }
}
