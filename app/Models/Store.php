<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Store extends Model
{

    use SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'stores';


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
        'category_id', 'county_id', 'local_code_id',
        'name', 'introduction', 'telephone_number', 
        'rating_average', 'review_count', 'address_detail'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'id', 'category_id', 'county_id', 'local_code_id', 
        'created_at', 'updated_at'
    ];

    /**
     * Get the wishes for store.
     */
    public function wishes()
    {
        return $this->hasMany(Wish::class);
    }

    /**
     * Get the reviews for store.
     */
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    /**
 * Get the images for store.
     */
    public function images()
    {
        return $this->hasMany(Image::class);
    }

    /**
     * Get the category that owns the stores.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get the city that owns the stores.
     */
    public function county()
    {
        return $this->belongsTo(County::class);
    }

    /**
     * Get the localCode that owns the stores.
     */
    public function localCode()
    {
        return $this->belongsTo(LocalCode::class);
    }

    /**
     * Create the model.
     *
     * @param  array
     * @return \App\Models\Store
     */
    public static function create($attributes)
    {
        $model = new static;

        $model->category_id =  $attributes['category_id'];
        $model->county_id =  $attributes['county_id'];
        $model->local_code_id =  $attributes['local_code_id'];
        
        $model->name =  $attributes['name'];
        $model->introduction =  $attributes['introduction'];
        $model->telephone_number =  $attributes['telephone_number'];
        $model->rating_average =  $attributes['rating_average'];
        $model->review_count =  $attributes['review_count'];
        $model->address_detail =  $attributes['address_detail'];

        $model->save();

        return $model;

    }

}
