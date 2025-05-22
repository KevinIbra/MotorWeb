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
use Illuminate\Support\Facades\Storage;

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
        'phone_number',
        'phone',  // Add both variations to support legacy data
        'description',
        'published_at',
        'primary_image_id'
    ];

    protected $casts = [
        'published_at' => 'datetime', // Cast published_at as a datetime
        'price' => 'decimal:0'
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

    public function primaryImage(): BelongsTo
    {
        return $this->belongsTo(MotorImage::class, 'primary_image_id');
    }

    // Add an accessor for image path with fallback
    public function getImagePathAttribute()
    {
        return $this->primaryImage?->path ?? asset('img/placeholder.png');
    }

    // Add an accessor for image path with proper storage URL
    public function getImageUrlAttribute(): string
    {
        if ($this->primaryImage) {
            return Storage::url($this->primaryImage->path);
        }
        return asset('img/placeholder.jpg');
    }

    public function favouredUsers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'favourite_motors');
    }

    public function favorites(): HasMany
    {
        return $this->hasMany(MotorFavorite::class);
    }

    public function isFavoritedBy(User $user): bool
    {
        return $this->favoritedBy()->where('user_id', $user->getKey())->exists();
    }

    public function favoritedBy(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'favourite_motor')
                    ->withTimestamps();
    }

    /**
     * Get the users that have favorited this motor
     */
    public function favouritedBy(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'favourite_motor')
                    ->withTimestamps();
    }

    /**
     * Check if the motor is favorited by a specific user
     */
    public function isFavouritedBy(User $user): bool
    {
        if (!$user) {
            return false;
        }
        
        return $this->favouritedBy()
                    ->where('user_id', $user->id)
                    ->exists();
    }

    public function getCreatedDate(): string
    {
        return (new Carbon($this->created_at))->format('d M Y');
    }

    // Add accessor to get phone number
    public function getPhoneAttribute()
    {
        return $this->phone_number ?? $this->attributes['phone'] ?? null;
    }
}
