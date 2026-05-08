<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

//Adds reputation points. Default zero. awarded +3 for experience upload and +1 for each qn answers
return new class extends Migration {
    public function up(): void {
        Schema::table('users', function (Blueprint $table) {
            // total reputation, can't be less than 0
            $table->unsignedInteger('reputation_points')->default(0)->after('is_admin');
        });
    }
    public function down(): void {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('reputation_points');
        });
    }
};
