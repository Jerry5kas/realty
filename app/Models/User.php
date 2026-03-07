<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

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

    /**
     * Relationships
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'user_role')
                    ->withTimestamps();
    }

    /**
     * Check if user has a specific role
     */
    public function hasRole($role)
    {
        if (is_string($role)) {
            return $this->roles->contains('slug', $role);
        }

        return $this->roles->contains('id', $role->id);
    }

    /**
     * Check if user has any of the given roles
     */
    public function hasAnyRole($roles)
    {
        if (is_array($roles)) {
            foreach ($roles as $role) {
                if ($this->hasRole($role)) {
                    return true;
                }
            }
            return false;
        }

        return $this->hasRole($roles);
    }

    /**
     * Check if user has all of the given roles
     */
    public function hasAllRoles($roles)
    {
        foreach ($roles as $role) {
            if (!$this->hasRole($role)) {
                return false;
            }
        }
        return true;
    }

    /**
     * Assign role to user
     */
    public function assignRole($role)
    {
        if (is_string($role)) {
            $role = Role::where('slug', $role)->firstOrFail();
        }

        if (!$this->hasRole($role)) {
            $this->roles()->attach($role->id);
        }

        return $this;
    }

    /**
     * Remove role from user
     */
    public function removeRole($role)
    {
        if (is_string($role)) {
            $role = Role::where('slug', $role)->firstOrFail();
        }

        $this->roles()->detach($role->id);

        return $this;
    }

    /**
     * Sync roles
     */
    public function syncRoles($roles)
    {
        $this->roles()->sync($roles);
        return $this;
    }

    /**
     * Check if user has a specific permission
     */
    public function hasPermission($permission)
    {
        foreach ($this->roles as $role) {
            if ($role->hasPermission($permission)) {
                return true;
            }
        }
        return false;
    }

    /**
     * Check if user has any of the given permissions
     */
    public function hasAnyPermission($permissions)
    {
        if (is_array($permissions)) {
            foreach ($permissions as $permission) {
                if ($this->hasPermission($permission)) {
                    return true;
                }
            }
            return false;
        }

        return $this->hasPermission($permissions);
    }

    /**
     * Get all permissions from user's roles
     */
    public function getAllPermissions()
    {
        return $this->roles->flatMap(function ($role) {
            return $role->permissions;
        })->unique('id');
    }

    /**
     * Favorites relationship
     */
    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

    /**
     * Check if user has favorited an item
     */
    public function hasFavorited($type, $id)
    {
        return $this->favorites()
            ->where('favoritable_type', $type)
            ->where('favoritable_id', $id)
            ->exists();
    }
}
