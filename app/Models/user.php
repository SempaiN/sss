<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class User extends Authenticatable
{
    use Notifiable;
    use HasFactory, Notifiable;
    protected $perPage = 20;

    protected $fillable = [
        'name',
        'surname',
        'email',
        'password',
    ];

    public function tasks()
    {
        return $this->hasMany(Task::class, 'user_id', 'id');
    }

}
