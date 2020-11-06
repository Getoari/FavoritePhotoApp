<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FavoritePhoto extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'photo_id' 
    ];

    public function user() {
        return $this->belongsTo('App\User');
    }
}
