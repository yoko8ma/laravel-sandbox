<?php

namespace App;

use Hyn\Tenancy\Traits\UsesTenantConnection;
use Spatie\Permission\Models\Permission as BasePermission;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use UsesTenantConnection;
}
