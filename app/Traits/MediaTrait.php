<?php

namespace App\Traits;

use App\Helpers\Constants;
use App\Helpers\Media;
use Illuminate\Support\Arr;
use Intervention\Image\Facades\Image;
use Pawlox\VideoThumbnail\Facade\VideoThumbnail;
use Log;
use Exception;
use Aws\S3\S3Client;
use App\Helpers\Common;
use League\Flysystem\Filesystem;
use League\Flysystem\Adapter\Local;
use Illuminate\Support\Facades\Storage;
use League\Flysystem\AwsS3v3\AwsS3Adapter;

trait MediaTrait
{
    protected $local;

    protected $s3;

    protected $rootLocalUpload = 'app/public';

    public function __construct()
    {
        if (Common::isLocalEnv()) {
            $this->initLocal();
        } else {
            $this->initS3();
        }
    }

    public function initLocal()
    {
        $adapter = new Local(storage_path($this->rootLocalUpload));
        $this->local = new Filesystem($adapter);
    }

    public function initS3()
    {
        try {
            $client = new S3Client(
                [
                    'region' => config('filesystems.disks.s3.region'),
                    'version' => 'latest',
                    'signature' => 'v4',
                ]
            );
            $adapter = new AwsS3Adapter(
                $client,
                config('filesystems.disks.s3.bucket')
            );

            $this->s3 = new Filesystem($adapter);
        } catch (Exception $e) {
            Log::error('[ERROR_S3_INIT] => ' . $e->getMessage());
        }
    }

    /**
     * Upload file.
     *
     * @param object $file
     * @param string $path
     * @param boolean $isRename
     *
     * @return boolean|string
     */
    public function uploadFile(object $file, string $path, bool $isRename = true)
    {
        try {
            $fileName = $this->getFileName($file, $isRename);
            $key = $this->getUploadKey($path, $fileName);
            if (Common::isLocalEnv()) {
                $this->local->put($key, file_get_contents($file));

                return $fileName;
            }

            $this->s3->put($key, file_get_contents($file));

            return $fileName;
        } catch (Exception $e) {
            Log::error('[ERROR_S3_UPLOAD_IMAGE] =>' . $e->getMessage());

            return false;
        }//end try
    }

    /**
     * Upload file to s3 role public.
     *
     * @param object $file
     * @param string $path
     * @param boolean $isRename
     *
     * @return boolean|string
     */
    public function uploadS3Public(object $file, string $path, bool $isRename = true)
    {
        try {
            $fileName = $this->getFileName($file, $isRename);
            $key = $this->getUploadKey($path, $fileName);
            if (Common::isLocalEnv()) {
                $this->local->put($key, file_get_contents($file));

                return $fileName;
            }

            Storage::disk('s3')->put($key, file_get_contents($file), 'public');

            return $fileName;
        } catch (Exception $e) {
            Log::error('[ERROR_S3_UPLOAD_ROLE_PUBLIC] =>' . $e->getMessage());

            return false;
        }//end try
    }

    /**
     * Upload and get thumbnail role public.
     *
     * @param object $file
     * @param string $path
     * @param string $fileName
     * @param int $width
     * @return array|bool
     */
    public function getThumbnailImage(
        object $file,
        string $path,
        string $fileName,
        int $width = Constants::THUMBNAIL_IMAGE_WIDTH
    ) {
        try {
            $thumbnail = [];
            $thumbnailName = Media::renameThumbnailImage($fileName);
            $key = $this->getUploadKey($path, $thumbnailName);
            $imageResize = Image::make($file->getRealPath());
            $defaultWidth = $imageResize->width();
            $defaultHeight = $imageResize->height();
            $heightResize = $width * ($defaultHeight / $defaultWidth);

            $imageResize->resize($width, $heightResize);
            $size = strlen((string)$imageResize->encode('png'));
            Arr::set($thumbnail, 'name', $thumbnailName);
            Arr::set($thumbnail, 'size', $size);

            if (Common::isLocalEnv()) {
                $this->local->put($key, (string)$imageResize->encode());

                return $thumbnail;
            }

            Storage::disk('s3')->put($key, (string)$imageResize->encode(), 'public');

            return $thumbnail;
        } catch (Exception $e) {
            Log::error('[ERROR_S3_UPLOAD_ROLE_PUBLIC] =>' . $e->getMessage());

            return false;
        }//end try
    }


    /**
     * Upload and get thumbnail role public.
     *
     * @param object $file
     * @param string $path
     * @param string $fileName
     * @param int $width
     * @param int $height
     *
     * @return array|bool
     */
    public function getThumbnailVideo(
        object $file,
        string $path,
        string $fileName,
        int $width = Constants::THUMBNAIL_IMAGE_WIDTH,
        int $height = Constants::THUMBNAIL_VIDEO_HEIGHT
    ) {
        try {
            $thumbnailVideo = [];
            $thumbnail = explode(".", $fileName);
            $thumbnailFullName = $thumbnail[0] . '.jpg';
            $thumbnailName = Media::renameThumbnailVideo($thumbnailFullName);
            $key = $this->getUploadKey($path, $thumbnailName);

            $thumbnail_path = public_path();
            \VideoThumbnail::createThumbnail(
                $file,
                $thumbnail_path,
                $thumbnailName,
                Constants::TIME_CREATE_THUMBNAIL,
                $width,
                $height
            );

            $contents = file_get_contents(public_path($thumbnailName));
            $size = strlen($contents);

            Arr::set($thumbnailVideo, 'name', $thumbnailName);
            Arr::set($thumbnailVideo, 'size', $size);

            if (Common::isLocalEnv()) {
                $this->local->put($key, $contents);
                unlink(public_path($thumbnailName));

                return $thumbnailVideo;
            }

            Storage::disk('s3')->put($key, $contents, 'public');
            unlink(public_path($thumbnailName));

            return $thumbnailVideo;
        } catch (Exception $e) {
            Log::error('[ERROR_S3_UPLOAD_ROLE_PUBLIC] =>' . $e->getMessage());

            return false;
        }//end try
    }

    /**
     * Get url.
     *
     * @param string $name
     * @param string $path
     *
     * @return null|string|boolean
     */
    public function getUrl(string $name, string $path)
    {
        try {
            $key = $this->getUploadKey($path, $name);
            if (Common::isLocalEnv()) {
                return Storage::disk('local')->url($key);
            }

            if (!$this->s3) {
                return false;
            }

            $client = $this->s3->getAdapter()->getClient();
            if (!$this->isExistS3($key, $client)) {
                Log::error('[ERROR_S3_URL_NOT_EXIST][name=' . $name . ']
                [type=' . $path . '] => ' . 'Image not found in S3');

                return null;
            }

            return $this->generateS3Url($key, $client);
        } catch (Exception $e) {
            Log::error('ERROR_S3_GET_URL:' . $e->getMessage());

            return null;
        }//end try
    }

    /**
     * Get public url.
     *
     * @param string $name
     * @param string $path
     *
     * @return null|string|boolean
     */
    public function getPublicUrl(string $name, string $path)
    {
        try {
            $key = $this->getUploadKey($path, $name);
            if (Common::isLocalEnv()) {
                return Storage::disk('local')->url($key);
            }

            if (!$this->s3) {
                return false;
            }

            $client = $this->s3->getAdapter()->getClient();
            if (!$this->isExistS3($key, $client)) {
                Log::error('[ERROR_S3_URL_NOT_EXIST][name=' . $name . ']
                [type=' . $path . '] => ' . 'Image not found in S3');

                return null;
            }

            return Storage::disk('s3')->url($key);
        } catch (Exception $e) {
            Log::error('ERROR_S3_GET_PUBLIC_URL:' . $e->getMessage());

            return null;
        }//end try
    }

    /**
     * Check file exist s3.
     *
     * @param string $key
     * @param S3Client $client
     *
     * @return bool
     */
    public function isExistS3($key, $client): bool
    {
        return $client->doesObjectExist(
            config('filesystems.disks.s3.bucket'),
            $key
        );
    }

    /**
     * Check file exist s3.
     *
     * @param string $key
     *
     * @return boolean
     */
    public function isFileExist(string $key): bool
    {
        try {
            $client = $this->s3->getAdapter()->getClient();

            return $this->isExistS3($key, $client);
        } catch (Exception $e) {
            return false;
        }
    }

    /**
     * Generate s3 url.
     *
     * @param string $key
     * @param S3Client $client
     *
     * @return string
     */
    public function generateS3Url(string $key, S3Client $client): string
    {
        $cmd = $client->getCommand('GetObject', [
            'Bucket' => config('filesystems.disks.s3.bucket'),
            'Key' => $key,
        ]);
        $request = $client->createPresignedRequest($cmd, config('filesystems.disks.s3.time_url'));

        return (string)$request->getUri();
    }

    /**
     * Delete image.
     *
     * @param string $name
     * @param string $path
     *
     * @return boolean
     */
    public function deleteImage(string $name, string $path): bool
    {
        try {
            $key = sprintf('%s/%s', $path, $name);
            if (Common::isLocalEnv()) {
                return $this->local->delete($key);
            }

            return $this->s3->delete($key);
        } catch (Exception $e) {
            Log::error('[ERROR_S3_DELETE_IMAGE] =>' . $e->getMessage());

            return false;
        }
    }

    /**
     * Get upload key to s3.
     *
     * @param string $path path.
     * @param string $name name.
     *
     * @return string
     */
    public function getUploadKey(string $path, string $name): string
    {
        return sprintf('%s/%s', $path, $name);
    }

    /**
     * Get file name.
     *
     * @param object $file
     * @param boolean $isRename
     *
     * @return string
     */
    public function getFileName(object $file, bool $isRename = true): string
    {
        $fileName = $file->getClientOriginalName();
        if ($isRename) {
            $fileName = encrypt_file_name(
                random_st(),
                $file->getClientOriginalExtension()
            );
        }

        return $fileName;
    }


    /**
     * Move object S3.
     *
     * @param string $path
     * @param string $newPath
     * @return bool
     */
    public function moveObject(string $path, string $newPath): bool
    {
        try {
            $client = $this->s3->getAdapter()->getClient();
            if ($this->isExistS3($path, $client)) {
                if ($this->s3->getAdapter()->copy($path, $newPath)) {
                    return $this->s3->getAdapter()->delete($path);
                }

                return false;
            }

            return false;
        } catch (\Exception $e) {
            Log::error('[MOVE_OBJECT] => ' . $e->getMessage());

            return false;
        }
    }

    /**
     * Copy object s3.
     *
     * @param string $sourcePath
     * @param string $destinationPath
     * @return bool
     */
    public function copyObject(string $sourcePath, string $destinationPath): bool
    {
        try {
            $client = $this->s3->getAdapter()->getClient();
            if ($this->isExistS3($sourcePath, $client)) {
                if ($this->s3->getAdapter()->copy($sourcePath, $destinationPath)) {
                    return true;
                }
            }

            return false;
        } catch (\Exception $e) {
            Log::error('[COPY_OBJECT] => ' . $e->getMessage());

            return false;
        }
    }
}
