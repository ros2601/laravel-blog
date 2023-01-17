<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class comment extends Model
{
    use HasFactory;
    protected $table="comment";
    public $timestamps=true;
    
    public function upload()
    {
        return $this->belongsTo(upload::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
