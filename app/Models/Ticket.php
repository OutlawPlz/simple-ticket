<?php

namespace App\Models;

use Coderflex\LaravelTicket\Models\Ticket as BaseTicket;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ticket extends BaseTicket
{
    /** @use HasFactory<\Database\Factories\TicketFactory> */
    use HasFactory;
}
