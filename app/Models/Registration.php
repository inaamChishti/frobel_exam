<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    use HasFactory;
    protected $fillable = [
        'exam_session',
        'form_passport_photo',
        'photographic_id',
        'first_name',
        'middle_name',
        'last_name',
        'date_of_birth',
        'gender',
        'address_uk',
        'street_address_uk',
        'line_address_uk',
        'city',
        'county',
        'zip_code',
        'country',
        'UCI_number',
        'mobile',
        'email',
        'confirm_email',
        'emergency_contact',
        'medical_conditions',
        'access_arrangements',
        'practical_endorsement',
        'guardian_firstName',
        'guardian_middleName',
        'guardian_lastName',
        'signature',
        'date',
        'user_id',
    ];
}
