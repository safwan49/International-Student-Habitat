<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Message extends Model {
    protected $fillable = ['sender_id', 'receiver_id', 'body', 'read_at'];
    protected $casts = ['read_at' => 'datetime'];
    //sender
    public function sender() { return $this->belongsTo(User::class, 'sender_id');}

    //Receiver
    public function receiver() { return $this->belongsTo(User::class, 'receiver_id');}

    //Counts and displays unread messages
    public function scopeUnread($query){ return $query->whereNull('read_at');}

    // Returns all messages in the dm of the two users
    public static function thread(int $userA, int $userB){
        return static::where(function ($q) use ($userA, $userB) {
            $q->where('sender_id', $userA)->where('receiver_id', $userB);
        })->orWhere(function ($q) use ($userA, $userB) {
        $q->where('sender_id', $userB)->where('receiver_id', $userA);
        })->orderBy('created_at')->get();
    }
}
