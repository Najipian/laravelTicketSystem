<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = "tickets_comments";

    protected $fillable = [
        'ticket_id' , 'direction' , 'responding_landlord_id' , 'comment'
    ];

    public function ticket(){
        return $this->belongsTo('App\Ticket' , 'ticket_id');
    }

    public function responding_landlord(){
        return $this->belongsTo('App\Landlord' , 'responding_landlord_id');
    }
}
