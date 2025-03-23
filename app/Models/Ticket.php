<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    // Define the table associated with the model (optional if table name follows Laravel conventions)
    protected $table = 'tickets';

    // Allow these columns to be mass-assigned
    protected $fillable = [
        'subject',
        'description',
        'category',
        'priority',
        'file',
        'status'
    ];

    // If you're using timestamps, you can enable this, or you can disable it by setting to false
    public $timestamps = true;
}
