<?php

namespace App\Repositories;

use App\Entities\Media;
use App\Entities\Banner;
use App\Helpers\Constants;
use GuzzleHttp\Psr7\Request;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class BannerRepository
 * @package App\Repositories
 */
class BannerRepository extends BaseRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Banner::class;
    }

    public function getBannerDisplay()
    {
        return Banner::where('active', '=', Constants::DEFAULT_ACTIVE)
            ->orderBy('order', Constants::BANNER_ORDER_BY)
            ->orderBy('created_at', Constants::FILTER_DEFAULT_SORT_ORDER)
            ->limit(Constants::BANNER_DISPLAY_LIMIT)
            ->get();
    }

    public function setActiveBanner(int $id)
    {
        return Banner::where('id', '<>', $id)
            ->update(['active' => 0]);
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
