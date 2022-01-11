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
        'title',
        'contents',
        'rating',
        'written_date',
        'been_date'
    ];

     /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'id',
        'store_id',
        'user_id'
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

}
