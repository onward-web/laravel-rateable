<?php
namespace willvincent\Rateable;

use Illuminate\Database\Eloquent\Model;
use EloquentFilter\Filterable;
class RatingDescription extends Model
{
    use \Jeidison\CompositeKey\CompositeKey;

    use Filterable;
    protected $guarded = [];
    public $timestamps = false;
    public $incrementing = false;

    protected $primaryKey = ['rating_id', 'lang'];

    public $table = RATING_DESCRIPTION_TABLE_NAME;

    public function rating(){
        return $this->belongsTo(Rating::class, 'rating_id', 'id');
    }
}
