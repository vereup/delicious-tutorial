<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{

    use SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'categories';


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
        'name'
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
     * Get the categories for store.
     */
    public function stores()
    {
        return $this->hasMany(Stores::class);
    }

    /**
     * Create the model.
     *
     * @param  array
     * @return \App\Models\Category
     */
    public static function create($attributes)
    {
        $model = new static;

        $model->name =  $attributes['name'];

        $model->save();

        return $model;

    }

}
