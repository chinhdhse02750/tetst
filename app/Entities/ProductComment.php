<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use \Illuminate\Database\Eloquent\Relations\BelongsTo;
use \Illuminate\Database\Eloquent\Relations\BelongsToMany;
use \Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * Class ProductReview.
 *
 * @package namespace App\Entities;
 */
class ProductComment extends Model implements Transformable
{
    use TransformableTrait;


    protected $table = 'product_comment';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'product_id',
        'name',
        'email',
        'description',
        'rating',
        'status'
    ];


    /**
     * @return BelongsTo
     */
    public function product()
    {
        return $this->belongsTo('App\Entities\Product', 'product_id');
    }
}
