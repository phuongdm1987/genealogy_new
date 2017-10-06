<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnPhoneToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('avatar')->nullable()->after('name'); // Anh dai dien
            $table->string('phone', 50)->nullable()->after('avatar'); // Dien thoai
            $table->boolean('sex')->default(1)->after('phone'); // Gioi tinh
            $table->timestamp('dob')->nullable()->after('confirmation_code'); // date of birth
            $table->timestamp('dod')->nullable()->after('dob'); // date of death
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['avatar', 'phone', 'sex', 'dob', 'dod']);
        });
    }
}
