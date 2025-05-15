<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MotorModel extends Model
{
    use HasFactory;

    protected $table = 'motor_models';
    protected $fillable = ['name', 'maker_id'];

    public function maker(): BelongsTo
    {
        return $this->belongsTo(Maker::class);
    }

    public function motors(): HasMany
    {
        return $this->hasMany(Motor::class, 'model_id');
    }
}
