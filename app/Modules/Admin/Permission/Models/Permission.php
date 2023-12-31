<?php

namespace App\Modules\Admin\Permission\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Permission extends Model
{
    use SoftDeletes;

    protected $table = 'permissions';
    protected $primaryKey= 'id';

    public function __construct()
    {
        $this->connection = config('connections.rhomb');
    }


}
