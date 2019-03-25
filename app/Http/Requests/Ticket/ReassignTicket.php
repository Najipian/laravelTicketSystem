<?php

namespace App\Http\Requests\Ticket;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ReassignTicket extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $ticket = $this->route('ticket');

        return $ticket->property->landlord->id == $this->user()->landlord->id;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'landlord_user_id' => [
                'required',
                'integer',
                Rule::exists('landlords' , 'id')->where(function($landlordUsers){

                    $landlordUsers
                        ->where('parent_landlord_id' , $this->user()->landlord->id)
                        ->orWhere('id' , $this->user()->landlord->id);
                })
            ]
        ];
    }
}
