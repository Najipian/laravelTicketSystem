<?php

namespace App\Http\Requests\Ticket;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Request;
class UpdateTicket extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $ticket = $this->route('ticket');
        $output = false;

        if(Request::is('landlord/*')){
            $output = ( $this->user()->landlord->id == $ticket->property->landlord_id ) || ( $this->user()->landlord->id == $ticket->assigned_landlord_id );
        }else{
            $output = $ticket->user_id == $this->user()->id;
        }
        return $output;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'comment' => 'required|string|max:500'
        ];
    }
}
