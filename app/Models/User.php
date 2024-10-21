<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Enums\IsDeleted;
use App\Enums\UserRole;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    private
        $STAFF_ROLES = [
            UserRole::ADMIN->value,
            UserRole::CASHIER->value,
            UserRole::RIDER->value
        ];

    public function addresses()
    {
        return $this->hasMany(Address::class);
    }

    public function scopeNotDeleted($query)
    {
        return $this->where('is_deleted', '=', IsDeleted::NO->value);
    }

    public function scopeStaffs($query)
    {
        return $query->whereIn('role', $this->STAFF_ROLES);
    }

    public function scopeSearchStaffs($query, $search, $role)
    {

        if (!empty($search)) {
            $query->whereIn('role', $this->STAFF_ROLES)
                ->whereAny([
                    'first_name',
                    'last_name',
                    'middle_name',
                    'email',
                    'phone'
                ], 'like', '%' . $search . '%')
                ->orWhereHas('addresses', function ($query) use ($search) {
                    $query->whereAny(
                        [
                            'street',
                            'barangay',
                            'city',
                            'province'
                        ],
                        'like',
                        '%' . $search . '%'
                    );
                });
        }

        if (!empty($role)) {
            $query->where('role', '=', $role);
        }
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'email',
        'last_name',
        'middle_name',
        'phone',
        'password',
        'role'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
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
}
