<?php

namespace App\Modules\Admin\Role\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Modules\Admin\Permission\Models\Permission;

class Role extends Model
{
    use SoftDeletes;

    protected $table = 'roles';
    protected $primaryKey= 'id';

    public function __construct()
    {
        $this->connection = config('connections.rhomb');
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'role_has_permissions', 'role_id', 'permission_id');
    }

    public function hasPermission($idPermission) {
        return $this->permissions->where('id', $idPermission)->first();
    }

}
