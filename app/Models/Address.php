<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Address extends Model
{

    use SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'addresses';


    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'city'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'id', 'created_at', 'updated_at'
    ];

    /**
     * Get the stores for address.
     */
    public function stores()
    {
        return $this->hasMany(Store::class);
    }

    /**
     * Get the counties for address.
     */
    public function counties()
    {
        return $this->hasMany(County::class);
    }

    /**
     * Create the model.
     *
     * @param  array
     * @return \App\Models\Address
     */
    public static function create($attributes)
    {
        $model = new static;

        $model->city =  $attributes['city'];

        $model->save();

        return $model;

    }

}
