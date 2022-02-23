<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class County extends Model
{

    use SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'counties';


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
        'city_id', 'county'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_at', 'updated_at'
    ];

    /**
     * Get the city that owns the counties.
     */
    public function city()
    {
        return $this->belongsTo(City::class);
    }

    /**
     * Create the model.
     *
     * @param  array
     * @return \App\Models\County
     */
    public static function create($attributes)
    {
        $model = new static;

        $model->city_id =  $attributes['city_id'];

        $model->county =  $attributes['county']; 

        $model->save();

        return $model;

    }
}
