<?php

namespace ActivismeBE;

use Cog\Laravel\Ban\Traits\Bannable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Cog\Contracts\Ban\Bannable as BannableContract;
use Spatie\Permission\Traits\HasRoles;

/**
 * Database Eloquent Model 'User'
 *
 * @property integer            $id                 The primary key from the database row.
 * @property string             $name               The username column.
 * @property string             $email              The user his email address.
 * @property string             $avatar             The path to the user image in the system.
 * @property string             $password           The password column from the user.
 * @property string             $remember_token     The remember_token from the user in the database.
 * @property \Carbon\Carbon     $created_at         The timestamp when the user is created.
 * @property \Carbon\Carbon     $updated_at         The timestamp when the user is last updated.
 */
class User extends Authenticatable implements BannableContract
{
    use Notifiable, HasRoles, Bannable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'avatar', 'password'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];
}
