<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        "name",
        "level_id",
        "address",
        "email"
    ];
    protected $dates = [
        "deleted_at",
    ];

    public function level()
    {
        return $this->belongsTo(Level::class, "level_id");
    }
}
