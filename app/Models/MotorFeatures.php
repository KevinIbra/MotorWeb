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


    public function motor(): BelongsTo
    {
        return $this->belongsTo(Motor::class);
    }
}
