<?php

namespace App\Modules\Api\Controllers;

use App\Helpers\Constants;
use App\Modules\Admin\Controllers\Controller;
use App\Repositories\AreaRepository;
use App\Repositories\MediaRepository;
use App\Traits\MediaTrait;
use \Illuminate\Http\JsonResponse;
use App\Helpers\Media;
use Illuminate\Http\Request;

/**
 * Class AreaController
 * @package App\Modules\Api\Controllers
 */
class AreaController extends Controller
{

    protected $areaRepository;

    /**
     * AreaController constructor.
     * @param AreaRepository $areaRepository
     */
    public function __construct(AreaRepository $areaRepository)
    {
        $this->areaRepository = $areaRepository;
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function getListPrefecture(int $id)
    {
        $prefectures = $this->areaRepository->getPrefectureByAreaID($id);

        return response()->json([
            'status' => 'success',
            'prefectures' => $prefectures
        ], 200);
    }
}
