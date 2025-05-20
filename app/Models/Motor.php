<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Motor extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'motor'; 
    protected $fillable = [
        'user_id',
        'maker_id',
        'model_id',
        'year',
        'price',
        'vin',
        'mileage',
        'motor_type_id',
        'fuel_type_id',
        'city_id',
        'address',
        'phone_number',  // Changed from 'phone' to 'phone_number'
        'description',
        'published_at'
    ];

    protected $casts = [
        'published_at' => 'datetime', // Cast published_at as a datetime
    ];

    public function motorType(): BelongsTo
    {
        return $this->belongsTo(MotorType::class);
    }

   

    public function fuelType(): BelongsTo
    {
        return $this->belongsTo(FuelType::class);
    }

    public function maker(): BelongsTo
    {
        return $this->belongsTo(Maker::class);
    }

    public function motorModel(): BelongsTo
    {
        return $this->belongsTo(MotorModel::class, 'model_id');
    }

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class , 'user_id');
    }

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }

    public function features(): HasOne
    {
        return $this->hasOne(MotorFeatures::class);
    }

    public function images(): HasMany
    {
        return $this->hasMany(MotorImage::class);
    }

    public function primaryImage(): HasOne
    {
        return $this->hasOne(MotorImage::class)
            ->oldestOfMany('position');
    }

    public function favouredUsers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'favourite_motors');
    }

    public function favorites(): HasMany
    {
        return $this->hasMany(MotorFavorite::class);
    }

    public function isFavoritedBy(User $user)
    {
        return $this->favorites()->where('user_id', $user->id)->exists();
    }

    public function getCreatedDate(): string
    {
        return (new Carbon($this->created_at))->format('d M Y');
    }
}
