<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MotorImage extends Model
{
    use HasFactory;

    protected $table = 'motor_images';
    public $timestamps = false;

    protected $fillable = [
        'motor_id',
        'path',
        'is_primary'
    ];

    protected $casts = [
        'is_primary' => 'boolean'
    ];

    public function motor(): BelongsTo
    {
        return $this->belongsTo(Motor::class);
    }
}