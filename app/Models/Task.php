<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class Task extends Model
{
    use HasFactory, Notifiable;
    protected $perPage = 20;

    protected $fillable = ['title', 'description', 'expiration_date', 'completed', 'user_id'];


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }


}
