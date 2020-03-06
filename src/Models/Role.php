<?php

namespace LaraPack\RolePermission\Models;

use App\Traits\OrderableTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use SoftDeletes;

    const SELLER_ROLE_IDS = [6, 7];

    protected $fillable = ['name', 'slug', 'permissions'];
    protected $casts    = ['permissions' => 'array'];
    protected $dates    = ['deleted_at'];

    const  ADMIN_KAFEIN_ROLE = 'admin-kafein';
    const  ADMIN_TC_ROLE = 'admin-tc';
    const  DIRECTOR_GENERAL_ROLE = 'dg';
    const  DIRECTOR_COMMERCIAL_ROLE = 'dc';
    const  CHEF_DES_VENTES_ROLE = 'chef-des-ventes';
    const  VENDEUR_ROLE = 'vendeur';
    const  SECRETAIRE_LOUEUR_ROLE = 'secretaire-loueur';
    const  SECRETAIRE_PRODUITS_ROLE = 'secretaire-produits';



    /**
     * Filter only internal roles.
     * @param $query
     * @return mixed
     */
    public function scopeHasPermission($query, $permission)
    {
        return $query->where('permissions', 'LIKE', '%"' . $permission . '":1%');
    }


    /**
     * The role's users.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'role_users');
    }


    /**
     * Checks if current role has the given permissions.
     * Check the presence of all permissions or just one depending on given $checkAll.
     * @param array $permissions
     * @param bool  $checkAll
     * @return bool
     */
    public function hasPermissions($permissions, $checkAll = true)
    {
        foreach ($permissions as $permission)
            if ($checkAll && !$this->hasPermission($permission))
                return false;
            elseif (!$checkAll && $this->hasPermission($permission))
                return true;

        return (bool)$checkAll;
    }


    /**
     * Checks if current role has given permission.
     * @param $permission
     * @return bool
     */
    private function hasPermission($permission)
    {
        return !empty($this->permissions[$permission]) ? $this->permissions[$permission] : false;
    }
}
