<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MotorFeatures extends Model
{
    use HasFactory;

    protected $table = 'motor_features';

    protected $fillable = [
        'motor_id',
        'abs',
        'keyless',
        'alarm_system',
        'led_lights',
        'digital_speedometer',
        'bluetooth_connectivity',
        'usb_charging',
        'engine_kill_switch',
        'side_stand_sensor',
        'traction_control'
    ];

    protected $casts = [
        'abs' => 'boolean',
        'keyless' => 'boolean',
        'alarm_system' => 'boolean',
        'led_lights' => 'boolean',
        'digital_speedometer' => 'boolean',
        'bluetooth_connectivity' => 'boolean',
        'usb_charging' => 'boolean',
        'engine_kill_switch' => 'boolean',
        'side_stand_sensor' => 'boolean',
        'traction_control' => 'boolean'
    ];

    public function motor(): BelongsTo
    {
        return $this->belongsTo(Motor::class);
    }
}
