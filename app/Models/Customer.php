<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'customer_email',
        'phone_number',
        'address_line_1',
        'address_line_2',
        'city',
        'county',
        'postcode',
    ];
}
