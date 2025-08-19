<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

use function PHPSTORM_META\type;

// use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable 
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function wishlists(): HasMany
    {
        return $this->hasMany(Wishlist::class);
    }
    public function rates(): HasMany
    {
        return $this->hasMany(Rate::class);
    }
    public function likes(): HasMany
    {
        return $this->hasMany(Like::class);
    }
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }
    public static function create_user($request, $profile_url, $phone, $password)
    {
        return self::create([
            'name' => $request->name,
            'phone' => $phone,
            'password' => Hash::make($password),
            'address' => $request->address,
            'city' => $request->city,
            'kodposti' => $request->kodposti,
            'email' => $request->email,
            'profile' => $profile_url
        ]);
    }
    public static function findByPhone($phone)
    {
        return self::where('phone', $phone)->first();
    }
}
