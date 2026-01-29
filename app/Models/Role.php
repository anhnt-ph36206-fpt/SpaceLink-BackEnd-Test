<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    /**
     * Fillable fields
     */
    protected $fillable = [
        'name',
        'display_name',
        'description',
    ];

    /**
     * Relationship: Role has many Users
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }

    /**
     * Relationship: Role has many Permissions (Many-to-Many)
     */
    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'role_permissions');
    }
}
