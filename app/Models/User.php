<?php
namespace App\Models;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
/**
 * @property bool $is_admin
 */
#[Fillable(['name', 'email', 'password'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable implements MustVerifyEmail{
    use HasFactory, Notifiable;
    protected function casts(): array{ return ['email_verified_at' => 'datetime','password' => 'hashed','is_admin' => 'boolean'];}
    public function experiences()
    {
        return $this->hasMany(Experience::class);
    }
    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }
    
/*s4*/

public function sentMessages() { return $this->hasMany(Message::class, 'sender_id');}
public function receivedMessages() { return $this->hasMany(Message::class, 'receiver_id');}

// returns users in dm
public function conversationPartners() {
    $sent = $this->sentMessages()->pluck('receiver_id');
    $received = $this->receivedMessages()->pluck('sender_id');
    return User::whereIn('id', $sent->merge($received)->unique())->get();
}

/*Reputation helpers*/ 
public function reputationTier(): string { 
    return match(true) { $this->reputation_points >= 16 => 'Trusted Advisor', $this->reputation_points >= 7  => 'Seasoned Vet',default => 'New Contributor'};}

public function reputationBadgeColour(): string { return match($this->reputationTier()) {'Trusted Advisor' => 'green','Seasoned Vet' => 'blue',default => 'gray'};}
}
