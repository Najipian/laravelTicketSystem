<?php
class StaticArray
{

    public static $ticketStatus = [
        OPEN_TICKET_STATUS => [ 'name' => 'OPEN' , 'color' => 'info'],
        SOLVED_TICKET_STATUS => [ 'name' => 'SOLVED' , 'color' => 'success'],
        CLOSED_TICKET_STATUS => [ 'name' => 'CLOSED' , 'color' => ''],
        CANCELED_TICKET_STATUS => [ 'name' => 'CANCELED' , 'color' => 'danger'],
    ];
}
