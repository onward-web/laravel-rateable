<?php

namespace willvincent\Rateable;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;
use EloquentFilter\Filterable;

class Rating extends Model
{
    use Filterable;

    public $table = RATING_TABLE_NAME;

    protected $guarded = [];

    public function rateable()
    {
        return $this->morphTo();
    }

    public function user()
    {
        $userClassName = Config::get('rateable.user_model');

        return $this->belongsTo($userClassName);
    }

    public function newEloquentBuilder($query)
    {
        return new \App\Builders\BaseBuilder($query);
    }


    public function descriptions(){
        return $this->hasMany(RatingDescription::class, 'rating_id', 'id');
    }

    public function description($lang = null){
        if($lang == null){
            $lang = sc_get_locale();
        }
        return $this->hasOne(RatingDescription::class, 'rating_id', 'id')->where('lang', $lang);
    }


}
