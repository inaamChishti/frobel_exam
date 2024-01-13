<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;
    protected $fillable = ['pdf_path','user_id','exam_session', 'dob', 'gender', 'accessArrangements', 'other', 'subjects'];
}
