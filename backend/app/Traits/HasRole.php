<?php

namespace App\Traits;

use App\Models\Role;

/**
 * Has Role trait
 *
 * @category Trait
 * @package  Vertical
 * @author   Rob Amos <r.amos21@outlook.com>
 * @license  MIT http://opensource.org/licenses/MIT
 * @link     https://github.com/robbamos/laravel-nuxt
 */
trait HasRole
{
    /**
     * Add Role Relationship
     *
     * @return void
     */
    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    /**
     * Assign a role to this model
     *
     * @param string $role
     * @return void
     */
    public function assignRole($role)
    {
        $r = Role::where('name', $role)->first();
        if ($r != null) {
            return $this->update(
                [
                    'role_id' => $r->id,
                ]
            );
        }
        return false;

    }

    /**
     * Check if this model has a role
     *
     * @param string $role
     * @return boolean
     */
    public function hasRole($role)
    {
        return $this->role->contains('name', $role);
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function getIsAdminAttribute()
    {
        if ($this->hasRole('admin')) {
            return true;
        }
        return false;
    }
}
