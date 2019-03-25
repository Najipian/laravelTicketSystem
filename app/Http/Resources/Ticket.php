<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Ticket extends JsonResource
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
            'title' => $this->title,
            'description' => $this->description,
            'property' => [
                'name' => $this->property->name,
                'landlord' => $this->property->landlord->user->name
            ],
            'user' => $this->tenant->name,
            'assigned_user' => $this->assigned_landlord->user->name,
            'created_at' => (string) $this->created_at,
            'comments' => TicketComments::collection($this->whenLoaded('comments'))
        ];
    }
}
