<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamDate extends Model
{
    use HasFactory;
    protected $fillable = ['subjectName', 'fromDate', 'toDate'];
}
