<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Report extends Model {
    protected $fillable = ['reporter_id','reportable_id','reportable_type','reason','status'];
    // Subject that's to be reported
    public function reportable() { return $this->morphTo(); }
    //reporter
    public function reporter() { return $this->belongsTo(User::class, 'reporter_id');}
    //pending reports for admin
    public function scopePending($query) { return $query->where('status', 'pending');}
}
