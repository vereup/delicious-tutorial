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
        'address_id', 'county'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'id', 'address_id', 'created_at', 'updated_at'
    ];

    /**
     * Get the address that owns the counties.
     */
    public function address()
    {
        return $this->belongsTo(Address::class);
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

        $model->address_id =  $attributes['address_id'];

        $model->county =  $attributes['county']; 

        $model->save();

        return $model;

    }
}
