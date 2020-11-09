<?php

namespace App\Helpers;

use App\Traits\MediaTrait;
use App\Helpers\Constants;

class Media
{
    use MediaTrait {
        MediaTrait::__construct as private __fhConstruct;
    }

    public function __construct()
    {
        $this->__fhConstruct();
    }

    /**
     * Get data media.
     *
     * @param object $file
     * @param string $path
     * @param bool $isPublic
     * @return array
     * @throws \Exception
     */
    public static function getDataMedia(object $file, string $path, $isPublic = false): array
    {
        $media = new self();
        if ($isPublic) {
            $fileName = $media->uploadS3Public($file, $path);
        } else {
            $fileName = $media->uploadFile($file, $path);
        }

        if (!$fileName) {
            throw new \Exception('Upload false');
        }

        $imageSize = getimagesize($file);
        $size = null;
        if ($imageSize) {
            $size = $imageSize[0] . 'x' . $imageSize[1];
        }

        return [
            'file' => $file,
            'path' => $path,
            'size' => $size,
            'name' => $fileName,
            'type' => $file->getClientOriginalExtension(),
        ];
    }


    /**
     * Convert byte Size of image
     *
     * @param int $bytes
     * @return int|string
     */
    public static function convertSize(int $bytes)
    {
        if ($bytes >= Constants::DEFAULT_GB) {
            $bytes = number_format($bytes / Constants::DEFAULT_GB, 2) . ' GB';
        } elseif ($bytes >= Constants::DEFAULT_MB) {
            $bytes = number_format($bytes / Constants::DEFAULT_MB, 2) . ' MB';
        } elseif ($bytes >= Constants::DEFAULT_KB) {
            $bytes = number_format($bytes / Constants::DEFAULT_KB, 2) . ' KB';
        } elseif ($bytes > 1) {
            $bytes = $bytes . ' bytes';
        } elseif ($bytes == 1) {
            $bytes = $bytes . ' byte';
        } else {
            $bytes = '0 bytes';
        }

        return $bytes;
    }

    /**
     * @param string $path
     * @param int $id
     * @param string $name
     * @return string
     */
    public static function getPathMedia(string $path, int $id, string $name = null)
    {
        if ($name !== null) {
            return sprintf('%s/%s/%s', $path, $id, $name);
        }

        return sprintf('%s/%s', $path, $id);
    }

    /**
     * @param string $path
     * @param string $name
     * @return string
     */
    public static function getTempPathMedia(string $path, string $name)
    {
        return sprintf('%s/%s', $path, $name);
    }

    /**
     * @param string $name
     * @return string
     */
    public static function renameThumbnailImage(string $name)
    {
        return Constants::THUMBNAIL_NAME_PREFIX . $name;
    }

    /**
     * @param string $name
     * @return string
     */
    public static function renameThumbnailVideo(string $name)
    {
        return Constants::THUMBNAIL_VIDEO_PREFIX . $name;
    }
}
