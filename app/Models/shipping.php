<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class shipping extends Model
{
    use HasFactory;
    protected $fillable = ['lat' , 'long' , 'address' , 'city' , 'country' , 'phone_number' , 'notes'];
}
