<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
// Reports table: reportable_type s are experiences,answers adn questions. and a reportable id for the content's primary key
return new class extends Migration {
    public function up(): void {
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            //reporter
            $table->foreignId('reporter_id')->constrained('users')->cascadeOnDelete();
            $table->morphs('reportable');
            $table->text('reason');
            //pending=to be reviewed, approved = same as before reporting, removed = content gone lmao
            $table->enum('status',['pending', 'approved', 'removed'])->default('pending');
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('reports');}
};
