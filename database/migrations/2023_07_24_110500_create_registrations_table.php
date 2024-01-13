<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('registrations', function (Blueprint $table) {
            $table->id();
            $table->string('exam_session')->nullable();
            $table->string('form_passport_photo')->nullable();
            $table->string('photographic_id')->nullable();
            $table->string('first_name')->nullable();
            $table->string('middle_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('date_of_birth')->nullable();
            $table->string('gender')->nullable();
            $table->string('address_uk')->nullable();
            $table->string('street_address_uk')->nullable();
            $table->string('line_address_uk')->nullable();
            $table->string('city')->nullable();
            $table->string('county')->nullable();
            $table->string('zip_code')->nullable();
            $table->string('country')->nullable();
            $table->string('UCI_number')->nullable();
            $table->string('mobile')->nullable();
            $table->string('email')->nullable();
            $table->string('confirm_email')->nullable();
            $table->string('emergency_contact')->nullable();
            $table->text('medical_conditions')->nullable();
            $table->text('access_arrangements')->nullable();
            $table->string('practical_endorsement')->nullable();
            $table->string('guardian_firstName')->nullable();
            $table->string('guardian_middleName')->nullable();
            $table->string('guardian_lastName')->nullable();
            $table->text('signature')->nullable();
            $table->string('date')->nullable();
            $table->string('user_id');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registrations');
    }
};
