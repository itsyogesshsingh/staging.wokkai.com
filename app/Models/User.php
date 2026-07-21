<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Admin\Lead;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Collection;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $table = 'saas_users';
    protected $primaryKey = 'uid';
    protected $guard_name = 'web';
    protected $fillable = [
        'first_name',
        'last_name',
        'username',
        'email',
        'password',
        'img',
        'status',
        'created_by'
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

    public function setPasswordAttribute($password)
    {
        if(!empty($password)) {
            $this->attributes['password'] = bcrypt($password);
        }
    }

    public function getAllPermissionSlugs(): Collection
    {
        return $this->getAllPermissions()->pluck('slug');
    }

    public function hasPermissionSlug(string $slug): bool
    {
        if ($this->hasRole('root')) {
            return true;
        }

        return $this->getAllPermissionSlugs()->contains($slug);
    }

    public function creator()
    {
        return $this->belongsTo(self::class, 'created_by', 'uid');
    }

    // public function leads()
    // {
    //     return $this->hasMany(Lead::class, 'created_by');
    // }
}
