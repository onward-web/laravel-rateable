<?php

namespace willvincent\Rateable;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;

class Rating extends Model
{
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
}
