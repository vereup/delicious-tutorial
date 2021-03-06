<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LocalCode extends Model
{

    use SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'local_codes';

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
        'number'
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
     * Get the LocalCode for stores.
     */
    public function stores()
    {
        return $this->hasMany(Store::class);
    }

    /**
     * Create the model.
     *
     * @param  array
     * @return \App\Models\LocalCode
     */
    public static function create($attributes)
    {
        $model = new static;

        $model->number =  $attributes['number'];

        $model->save();

        return $model;

    }

}
