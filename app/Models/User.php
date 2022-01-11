<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;


    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'id', 'password', 'created_at', 'updated_at'
    ];

    /**
     * Get the reviews for user.
     */
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    /**
     * Get the wishes for user.
     */
    public function wishes()
    {
        return $this->hasMany(Wish::class);
    }

    /**
     * Create the model.
     *
     * @param  array
     * @return \App\Models\User
     */
    public static function create($attributes)
    {
        $model = new static;

        $model->name =  $attributes['name'];
        $model->email =  $attributes['email'];
        $model->password =  $attributes['password'];

        $model->save();

        return $model;

    }
}
