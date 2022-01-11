<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Wish extends Model
{
    use SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'wishes';


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
        'store_id', 'user_id'
    ];


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'id', 'store_id', 'user_id', 
        'created_at', 'updated_at'
    ];

    /**
     * Get the user that owns the wishes.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the store that owns the wishes.
     */
    public function store()
    {
        return $this->belongsTo(Store::class);
    }


    /**
     * Create the model.
     *
     * @param  array
     * @return \App\Models\Wish
     */
    public static function create($attributes)
    {
        $model = new static;

        $model->store_id =  $attributes['store_id'];
        $model->user_id =  $attributes['user_id'];

        $model->save();

        return $model;

    }
}
