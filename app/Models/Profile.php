<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;
    protected $guarded=['title'];
    public function profileImage() {
        if ($this->image) {
            return '/storage/'.$this->image;
        }
        else {
            return '/images/profile.png';
        }
    }
    public function followers() {
        return $this->belongsToMany(User::class);
    }
    public function user() {
        return $this->belongsTo(User::class);
    }
}
