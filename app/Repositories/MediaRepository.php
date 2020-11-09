<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Entities\Media;
use App\Helpers\Constants;

/**
 * Class MediaRepository
 * @package App\Repositories
 */
class MediaRepository extends BaseRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Media::class;
    }


    /**
     * Insert new Media and get ID to create relation with user
     *
     * @param array $data
     * @return array
     */
    public function createManyMedia(array $data): array
    {
        $this->model()::insert($data);
        $lastIdBeforeInsertion = $this->model()::orderby('id', 'desc')->first()->id;
        $insertedIds = [];

        for ($i = $lastIdBeforeInsertion; $i > ($lastIdBeforeInsertion - count($data)); $i--) {
            array_push($insertedIds, $i);
        }

        return array_reverse($insertedIds);
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
