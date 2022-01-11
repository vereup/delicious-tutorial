<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Image extends Model
{

    use SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'images';


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
        'store_id',
        'path'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'id', 'store_id', 'created_at', 'updated_at'
    ];

    /**
     * Get the store that owns the images.
     */
    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    /**
     * Create the model.
     *
     * @param  array
     * @return \App\Models\Image
     */
    public static function create($attributes)
    {
        $model = new static;

        $model->store_id =  $attributes['store_id'];

        $model->path =  $attributes['path'];

        $model->save();

        return $model;

    }

}
