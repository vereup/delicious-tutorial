<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Review extends Model
{

    use SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'reviews';


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
        'store_id', 'user_id',
        'title', 'contents', 'rating', 'been_date'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'id', 'store_id', 'user_id', 'created_at', 'updated_at'
    ];

    /**
     * Get the user that owns the reviews.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the store that owns the reviews.
     */
    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    /**
     * Create the model.
     *
     * @param  array
     * @return \App\Models\Review
     */
    public static function create($attributes)
    {
        $model = new static;

        $model->store_id =  $attributes['store_id'];
        $model->user_id =  $attributes['user_id'];

        $model->title =  $attributes['title'];
        $model->contents =  $attributes['contents'];
        $model->rating =  $attributes['rating'];
        $model->been_date =  $attributes['been_date'];

        $model->save();

        return $model;

    }
}
