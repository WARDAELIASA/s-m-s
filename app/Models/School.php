<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;


class School extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'name',
        'email',
        'address',
        'phone',
        'location',
    ];
    protected $dates = [
        'deleted_at'


    ];
    public function levels()
    {
        return $this->hasMany(Level::class);
    }
}
