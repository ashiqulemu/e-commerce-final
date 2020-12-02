<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded=['id'];
    protected $casts = [
        'medias' => 'array',
    ];

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function medias(){
        return $this->hasMany('App\Media');
    }

    public function payments(){
        return $this->morphMany('App\Payment', 'paymentable');
    }

}
