<?php

namespace App\Services;

use App\Helpers\Constants;
use App\Helpers\UserProfileAttribute;
use App\Repositories\AreaRepository;
use App\Repositories\RankRepository;
use App\Traits\MediaTrait;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\App;

class ProductService
{
    use MediaTrait {
        MediaTrait::__construct as private __fhConstruct;
    }

    /**
     * @var RankRepository
     */
    protected $rankRepository;

    /**
     * @var AreaRepository
     */
    protected $areaRepository;

    /**
     * @var object
     */
    protected $user;

    /**
     * UserService constructor.
     * @param RankRepository $rankRepository
     * @param AreaRepository $areaRepository
     */
    public function __construct(
        RankRepository $rankRepository,
        AreaRepository $areaRepository
    ) {
        $this->__fhConstruct();
        $this->rankRepository = $rankRepository;
        $this->areaRepository = $areaRepository;
    }


}
