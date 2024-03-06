<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSchoolInformationTbl extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('school_information', function (Blueprint $table) {
            $table->increments('id');
            $table->string('school_name');
            $table->string('school_no')->nullable();
            $table->string('affiliation_to')->nullable()->comment("Affiliation #");
            $table->string('school_short_name')->nullable();
            $table->string('affiliation_no')->nullable();
            $table->string('associates')->nullable();
            $table->string('trust_society_name')->nullable()->comment("Trust of society");
            $table->string('trust_society_no')->nullable();
            $table->string('contact_number');
            $table->string('email_address');
            $table->string('support_email')->nullable();
            $table->string('website')->nullable();
            $table->text('address1');
            $table->text('address2')->nullable();
            $table->string('establishment_year')->nullable();
            $table->string('establishment_code')->nullable();
            $table->string('chairman')->nullable();
            $table->string('iso_details')->nullable();
            $table->string('working_days')->nullable();
            $table->text('school_logo')->nullable();
            $table->string('otp',20)->nullable();
            $table->enum('verified_at', ['yes', 'no'])->default('no')->index();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('school_information');
    }
}
