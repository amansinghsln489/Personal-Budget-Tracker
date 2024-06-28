<?php

namespace App\Models\Interview;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Company\Technology;

class Interviewee extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $fillable = [
        'name', 'email', 'technology', 'phone_number', 'status', 'image', 'comment'
    ];
    
    public function technologyName()
    {
        return $this->belongsTo(Technology::class, 'technology');
    }
}