<?php

namespace App\Modules\Api\Controllers;

use App\Modules\Admin\Controllers\Controller;
use App\Repositories\UserRepository;
use App\Traits\ResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use PHPUnit\Exception;
use Prettus\Validator\Exceptions\ValidatorException;

class MemberController extends Controller
{
    use ResponseTrait;

    protected $userRepository;

    /**
     * MemberController constructor.
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function show(int $id)
    {
        $member = $this->userRepository->find($id);
        if (!$member) {
            return $this->notFound();
        }

        $data = [
            'private_photos' => [],
            'videos' => [],
        ];
        if ($member->has_image_private) {
            foreach ($member->image_private as $image) {
                $data['private_photos'][] = [
                    'src' => $image->media_url,
                    'thumb' => $image->thumbnail_url,
                ];
            }
        }

        if ($member->has_video) {
            foreach ($member->videos as $video) {
                $data['videos'][] = [
                    'id' => $video->id,
                    'video' => $video->video_url,
                    'thumb' => $video->thumbnail_url,
                    'poster' => $video->thumbnail_url,
                    'html' => '#video' . $video->id
                ];
            }
        }

        return $this->success($data);
    }

    /**
     * Update user status.
     *
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     * @throws ValidatorException
     */
    public function updateStatus(Request $request, int $id)
    {
        try {
            $data['active'] = $request->get('active');
            $this->userRepository->update($data, $id);

            return $this->success($data, trans('alerts.general.success.updated'));
        } catch (Exception $e) {
            return $this->error('[ERROR_STORE_FAVORITE]: ' . $e->getMessage());
        }//end try
    }
}
