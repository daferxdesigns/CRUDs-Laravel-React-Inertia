<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tickets extends Model
{
    /** @use HasFactory<\Database\Factories\TicketsFactory> */
    use HasFactory;

    protected $fillable = [

        'ticket_number',
        'user_id',
        'the_client',
        'serial_number',
        'title',
        'description',
        'message',
        'priority',
        'status',
        'is_resolved',
        'assigned_to'
    ];
}
