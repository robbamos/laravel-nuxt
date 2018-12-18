<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Role Model.
 *
 * @category Model
 * @package  Vertical
 * @author   Rob Amos <r.amos21@outlook.com>
 * @license  MIT http://opensource.org/licenses/MIT
 * @link     https://github.com/robbamos/laravel-nuxt
 */
class Role extends Model
{
    public $incrementing = false;
    protected $table = 'roles';
    public $timestamps = false;
    protected $fillable = [
        'name', 'display_name', 'id',
    ];
    protected $hidden = [
        'id'
    ];
}
