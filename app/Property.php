<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    protected $table = "properties";

    protected $fillable = [
        'name' , 'landlord_id' , 'user_id'
    ];

    public function landlord(){
        return $this->belongsTo('App\Landlord' , 'landlord_id');
    }

    public function tenant(){
        return $this->belongsTo('App\User' , 'user_id');
    }

    public function tickets(){
        return $this->hasMany('App\Ticket' , 'property_id');
    }
}
