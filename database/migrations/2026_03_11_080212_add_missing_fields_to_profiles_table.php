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
        Schema::table('profiles', function (Blueprint $table) {
            if (!Schema::hasColumn('profiles', 'student_id')) {
                $table->string('student_id')->nullable()->after('user_id');
            }
            if (!Schema::hasColumn('profiles', 'batch')) {
                $table->string('batch')->nullable()->after('student_id');
            }
            if (!Schema::hasColumn('profiles', 'profile_picture')) {
                $table->string('profile_picture')->nullable()->after('batch');
            }
            // Update existing columns to allow strings
            $table->string('year')->nullable()->change();
            $table->string('semester')->nullable()->change();
            $table->string('department')->nullable()->change();
            $table->string('gender')->nullable()->change();
            $table->string('number')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('profiles', function (Blueprint $table) {
            $table->dropColumn(['student_id', 'batch', 'profile_picture']);
        });
    }
};
