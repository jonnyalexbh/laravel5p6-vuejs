<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name', 'description', 'condition',
    ];
    /**
     * Get the articles record associated with the category.
     */
    public function articles()
    {
        return $this->hasOne('App\Article');
    }
}
