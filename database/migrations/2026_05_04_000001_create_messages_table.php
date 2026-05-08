<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            //sender
            $table->foreignId('sender_id')->constrained('users')->cascadeOnDelete();
            //receiver
            $table->foreignId('receiver_id')->constrained('users')->cascadeOnDelete();
            $table->text('body');
            //if null,unread. else read
            $table->timestamp('read_at')->nullable();
            $table->timestamps();});
    }
    public function down(): void { Schema::dropIfExists('messages');}
};
