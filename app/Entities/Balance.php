<?php

namespace App\Entities;

use App\Helpers\Constants;
use App\Traits\Scope\BalanceScope;
use Illuminate\Contracts\Translation\Translator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Balances.
 *
 * @package namespace App\Entities;
 */
class Balance extends Model implements Transformable
{
    use TransformableTrait, SoftDeletes, BalanceScope;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'balances';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'model_type',
        'model_id',
        'amount',
    ];

    /**
     * @return MorphTo
     */
    public function model()
    {
        return $this->morphTo();
    }

    /**
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\Entities\User', 'user_id');
    }

    /**
     * @return array|Translator|string|null
     */
    public function getTransactionAttribute()
    {
        if (strpos($this->model_type, Constants::BALANCE_TYPE_ADJUSTMENT) !== false) {
            return @trans('point.label.adjustment');
        }
        return '';
    }

    /**
     * @return string
     */
    public function getBalanceAttribute()
    {
        if (strpos($this->model_type, Constants::BALANCE_TYPE_ADJUSTMENT) !== false) {
            if ($this->amount < 0) {
                return number_format($this->amount) . ' ' . @trans('point.label.point');
            }

            return '+' . number_format($this->amount) . ' ' . @trans('point.label.point');
        }

        return '-' . number_format($this->amount) . ' ' . @trans('point.label.point');
    }

    public function getPointAmountAttribute()
    {
        if (strpos($this->model_type, Constants::BALANCE_TYPE_ADJUSTMENT) !== false) {
            return  $this->amount;
        }

        return  -($this->amount);
    }
}
