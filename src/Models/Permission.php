<?php

namespace LaraPack\RolePermission\Models;

use App\Traits\OrderableTrait;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $table = 'permission';
    protected $fillable = ['name'];

}
