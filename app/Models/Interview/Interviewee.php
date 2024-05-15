<?php

namespace App\Models\Interview;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Interviewee extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $fillable = [
        'name', 'email', 'technology', 'phone_number', 'status', 'image', 'comment'
    ];
    
}