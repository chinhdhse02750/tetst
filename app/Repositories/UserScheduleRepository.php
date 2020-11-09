<?php
namespace App\Repositories;

use App\Entities\UserSchedule;
use Prettus\Repository\Eloquent\BaseRepository;

class UserScheduleRepository extends BaseRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return UserSchedule::class;
    }

    /**
     * Insert data.
     *
     * @param array $data
     *
     * @return bool
     */
    public function insertData(array $data): bool
    {
        return $this->model()::insert($data);
    }

    /**
     * Delete data.
     *
     * @param array $data
     *
     * @return bool
     * @throws \Exception
     */
    public function deleteData(array $data): bool
    {
        return $this->model()::whereIn('identify', $data)->delete();
    }
}
