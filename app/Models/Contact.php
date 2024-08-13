<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    // Define which attributes are mass assignable
    protected $fillable = [
        'name',        // Allow mass assignment for the name attribute
        'email',
        'phone',
        'address',
        // Add any other attributes you want to be mass assignable
    ];
}
