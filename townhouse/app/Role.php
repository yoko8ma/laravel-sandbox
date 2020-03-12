<?php

namespace App;

use Hyn\Tenancy\Traits\UsesTenantConnection;
use Spatie\Permission\Models\Role as BaseRole;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use UsesTenantConnection;
}
