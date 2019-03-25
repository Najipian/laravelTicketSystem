<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TicketComments extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'direction' => $this->direction == FROM_TENANT_TO_LANDLORD ? 'From user to landlord' : 'From landlord to user',
            'responded_landlord' => $this->when($this->direction == FROM_LANDLORD_TO_TENANT, function () {
                return $this->responding_landlord->user->name;
            }),
            'comment' => $this->comment
        ];
    }
}
