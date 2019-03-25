<?php

namespace App\Http\Requests\Ticket;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ChangeStatusTicket extends FormRequest
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
            'ticket_status' => [
                'required',
                'integer',
                Rule::in(array_keys(\StaticArray::$ticketStatus))
            ]
        ];
    }
}
