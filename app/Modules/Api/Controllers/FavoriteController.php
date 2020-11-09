<?php

namespace App\Modules\Api\Controllers;

use App\Modules\Admin\Controllers\Controller;
use App\Repositories\UserFavoriteRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use PHPUnit\Exception;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Traits\ResponseTrait;

/**
 * Class FavoriteController
 * @package App\Modules\Api\Controllers
 */
class FavoriteController extends Controller
{
    use ResponseTrait;

    protected $userFavoriteRepository;

    /**
     * FavoriteController constructor.
     * @param UserFavoriteRepository $userFavoriteRepository
     */
    public function __construct(UserFavoriteRepository $userFavoriteRepository)
    {
        $this->userFavoriteRepository = $userFavoriteRepository;
    }

    /**
     * Toggle favorite.
     *
     * @param Request $request
     * @param int     $id
     *
     * @return JsonResponse
     * @throws ValidatorException
     */
    public function toggle(Request $request, int $id)
    {
        try {
            $data = [
                'user_id' => $id,
                'favorite_id' => (int)$request->get('favorite_id')
            ];
            $userFavorite = $this->userFavoriteRepository->findWhere($data)->first();
            if (empty($userFavorite)) {
                $this->userFavoriteRepository->create($data);

                return $this->success($data);
            }

            $this->userFavoriteRepository->delete($userFavorite->id);

            return $this->success($data);
        } catch (Exception $e) {
            return $this->error('[ERROR_TOGGLE_FAVORITE]: '. $e->getMessage());
        }//end try
    }
}
