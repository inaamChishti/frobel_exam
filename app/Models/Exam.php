<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    use HasFactory;
    protected $fillable = [
        
        'exam_board',
        'qualification',
        'subject',
        'exam_entry_code',
        'level',
        'optional_code',
        'userId',
    ];
}
