<?php
namespace willvincent\Rateable;

use Illuminate\Database\Eloquent\Model;
use EloquentFilter\Filterable;
class RatingDescription extends Model
{
    use Filterable;
    protected $guarded = [];
    public $timestamps = false;
    public $incrementing = false;

    protected $primaryKey = 'rating_id';

    public $table = RATING_DESCRIPTION_TABLE_NAME;

    public function rating(){
        return $this->belongsTo(Rating::class, 'rating_id', 'id');
    }
}