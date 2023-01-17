<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class upload extends Model
{
    use HasFactory;
    protected $table="upload";
    public $timestamps=false;

    public function comments()
    {
        return $this->hasMany(comment::class);
    }
    public function User()
    {
        return $this->hasMany(User::class);
    }
}
