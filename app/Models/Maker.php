<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Maker extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function motorModel(): HasMany
    {
        return $this->hasMany(MotorModel::class);
    }

    public function motors(): HasMany
    {
        return $this->hasMany(Motor::class);
    }
}
