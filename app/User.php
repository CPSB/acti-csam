<?php

namespace ActivismeBE;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * Database Eloquent Model 'User'
 *
 * @property integer            $id                 The primary key from the database row.
 * @property string             $name               The username column.
 * @property string             $email              The user his email address.
 * @property string             $password           The password column from the user.
 * @property string             $remember_token     The remember_token from the user in the database.
 * @property \Carbon\Carbon     $created_at         The timestamp when the user is created.
 * @property \Carbon\Carbon     $updated_at         The timestamp when the user is last updated.
 */
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];
}
