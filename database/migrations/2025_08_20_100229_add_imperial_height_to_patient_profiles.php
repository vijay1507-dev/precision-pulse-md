<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddImperialHeightToPatientProfiles extends Migration
{
    public function up()
    {
        Schema::table('patient_profiles', function (Blueprint $table) {
            $table->unsignedTinyInteger('height_feet')->nullable()->after('height_cm')->comment('Patient height in feet');
            $table->unsignedTinyInteger('height_inches')->nullable()->after('height_feet')->comment('Patient height in inches');
        });
    }

    public function down()
    {
        Schema::table('patient_profiles', function (Blueprint $table) {
            $table->dropColumn(['height_feet', 'height_inches']);
        });
    }
}
