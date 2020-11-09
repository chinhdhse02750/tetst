<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Spatie\Permission\Traits\HasRoles;

/**
 * Class Admin.
 *
 * @package namespace App\Entities;
 */
class Admin extends Authenticatable implements Transformable
{
    use TransformableTrait, SoftDeletes, HasRoles;
    protected $table = 'admins';
    protected $guard = 'admin';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'last_login_ip', 'remember_token'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Get is admin attribute.
     *
     * @return bool
     */
    public function getIsAdminAttribute()
    {
        return $this->hasRole('admin');
    }

    /**
     * Get is super admin attribute.
     *
     * @return bool
     */
    public function getIsSuperAdminAttribute()
    {
        return $this->hasRole('super_admin');
    }

    /**
     * Get all roles name attribute.
     *
     * @return string
     */
    public function getAllRolesNameAttribute()
    {
        $roles = $this->getRoleNames()->toArray();

        return implode(", ", $roles);
    }
}
