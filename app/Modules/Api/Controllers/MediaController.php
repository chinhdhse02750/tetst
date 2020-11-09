<?php

namespace App\Modules\Api\Controllers;

use App\Helpers\Constants;
use App\Modules\Admin\Controllers\Controller;
use App\Repositories\MediaRepository;
use App\Traits\MediaTrait;
use Illuminate\Contracts\Routing\ResponseFactory;
use \Illuminate\Http\JsonResponse;
use App\Helpers\Media;
use Illuminate\Http\Request;

/**
 * Class MediaController
 * @package App\Modules\Api\Controllers
 */
class MediaController extends Controller
{
    use MediaTrait {
        MediaTrait::__construct as private __fhConstruct;
    }
    /**
     * @var MediaRepository
     */
    protected $mediaRepository;

    /**
     * MediaController constructor.
     * @param MediaRepository $mediaRepository
     */
    public function __construct(MediaRepository $mediaRepository)
    {
        $this->__fhConstruct();
        $this->mediaRepository = $mediaRepository;
    }

    /**
     * Put file and pass data to blade view.
     *
     * @param Request $request
     * @return ResponseFactory|JsonResponse|\Illuminate\Http\Response
     * @throws \Exception
     */
    public function storeMedia(Request $request)
    {
        $file = $request->file('file');
        $mimeType = $file->getMimeType();

        $request = Media::getDataMedia($file, Constants::DEFAULT_PUBLIC_PATH, Constants::IS_PUBLIC);
        $thumbnailImage = $this->getThumbnailImage($file, Constants::DEFAULT_PUBLIC_PATH, $request['name']);
        if (strpos($mimeType, 'video') !== false) {
            $thumbnailImage = $this->getThumbnailVideo($file, Constants::DEFAULT_PUBLIC_PATH, $request['name']);
        }
        if (!$thumbnailImage) {
            return response([
                'message' => 'Upload Fail!'
            ], 404);
        }

        $dataMedia = $this->setDataMedia($request, $thumbnailImage);
        $publicUrl = $this->getPublicUrl($request['name'], $request['path']);
        $thumbnailUrl = $this->getPublicUrl($thumbnailImage['name'], Constants::DEFAULT_PUBLIC_PATH);

        return response()->json([
            'data_media' => $dataMedia,
            'public_url' => $publicUrl,
            'thumbnail_url' => $thumbnailUrl
        ]);
    }

    /**
     * Set data Media.
     *
     * @param array $request
     * @param array $thumbnailData
     * @return array
     */
    public function setDataMedia(array $request, array $thumbnailData = null): array
    {
        return [
            'name' => $request['name'],
            'thumbnail_name' => $thumbnailData['name'] ? $thumbnailData['name'] : '',
            'type' => $request['type'],
            'size' => Media::convertSize($request['file']->getSize()),
            'thumbnail_size' => $thumbnailData['size'] ? Media::convertSize($thumbnailData['size']) : ''
        ];
    }
}
