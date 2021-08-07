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
        $this->initLocal();
    }

    public function initLocal()
    {
        $adapter = new Local(storage_path($this->rootLocalUpload));
        $this->local = new Filesystem($adapter);
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
            $this->local->put($key, file_get_contents($file));

            return $fileName;
        } catch (Exception $e) {
            Log::error('[ERROR_S3_UPLOAD_IMAGE] =>' . $e->getMessage());

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

            return Storage::disk('local')->url($key);
        } catch (Exception $e) {
            Log::error('ERROR_GET_URL:' . $e->getMessage());

            return null;
        }//end try
    }

    /**
     * Get public url.
     *
     * @param string $name
     * @param string $path
     *+
     * @return null|string|boolean
     */
    public function getPublicUrl(string $name, string $path)
    {
        try {
            $key = $this->getUploadKey($path, $name);

            return Storage::disk('local')->url($key);
        } catch (Exception $e) {
            Log::error('ERROR_GET_PUBLIC_URL:' . $e->getMessage());

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

            return $this->local->delete($key);
        } catch (Exception $e) {
            Log::error('[ERROR_DELETE_IMAGE] =>' . $e->getMessage());

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
