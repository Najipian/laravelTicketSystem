<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $table = "tickets";

    protected $fillable = [
        'user_id' , 'property_id' , 'assigned_landlord_id' , 'title' , 'description' , 'status'
    ];

    public function tenant(){
        return $this->belongsTo('App\User' , 'user_id');
    }

    public function property(){
        return $this->belongsTo('App\Property' , 'property_id');
    }

    public function assigned_landlord(){
        return $this->belongsTo('App\Landlord' , 'assigned_landlord_id');
    }

    public function comments(){
        return $this->hasMany('App\Comment');
    }
}
