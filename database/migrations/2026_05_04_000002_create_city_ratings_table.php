<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create('city_ratings', function (Blueprint $table) {
            $table->id();
            /* uerid and cityid pair detects unique ratings*/
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('city_id')->constrained()->cascadeOnDelete();
            //star rating from 1 to 5
            $table->unsignedTinyInteger('rating');
            $table->timestamps();
            //Single rating per user
            $table->unique(['user_id', 'city_id']);
            });
    }

    public function down(): void { Schema::dropIfExists('city_ratings');}
};
