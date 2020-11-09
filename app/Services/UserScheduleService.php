<?php
namespace App\Services;

use App\Repositories\UserScheduleRepository;
use Carbon\Carbon;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Arr;

class UserScheduleService
{
    /**
     * @var UserScheduleRepository
     */
    protected $userScheduleRepository;

    /**
     * UserScheduleService constructor.
     *
     * @param UserScheduleRepository $userScheduleRepository
     */
    public function __construct(UserScheduleRepository $userScheduleRepository)
    {
        $this->userScheduleRepository = $userScheduleRepository;
    }

    /**
     * Save schedule.
     *
     * @param int   $userId
     * @param array $data
     *
     * @return bool
     * @throws \Exception
     */
    public function saveSchedule(int $userId, array $data): bool
    {
        return $this->userScheduleRepository->insertData($this->getDataSchedules($userId, $data));
    }

    /**
     * Update user schedule.
     *
     * @param int   $userId
     * @param array $data
     *
     * @return bool
     */
    public function updateUser(int $userId, array $data): bool
    {
        try {
            $updated = true;
            $scheduleDeleted = Arr::get($data, 'user_schedule_delete');
            if ($scheduleDeleted) {
                $updated = $this->userScheduleRepository->deleteData($scheduleDeleted);
            }

            if (!$updated) {
                return false;
            }

            foreach (Arr::get($data, 'user_schedule') as $schedule) {
                $schedule = json_decode($schedule, true);
                $this->userScheduleRepository->updateOrCreate([
                    'user_id' => $userId,
                    'identify' => Arr::get($schedule, 'id'),
                    'start_date' => Carbon::parse(Arr::get($schedule, 'start_date')),
                    'end_date' => Carbon::parse(Arr::get($schedule, 'end_date')),
                    'type' => Arr::get($schedule, 'type')
                ]);
            }

            return true;
        } catch (\Exception $e) {
            return false;
        }//end try
    }

    /**
     * Get data schedule.
     *
     * @param int   $userId
     * @param array $data
     *
     * @return array
     * @throws \Exception
     */
    private function getDataSchedules(int $userId, array $data): array
    {
        $schedules= [];
        foreach ($data as $schedule) {
            $schedule = json_decode($schedule, true);
            $schedules[] = [
                'user_id' => $userId,
                'identify' => Arr::get($schedule, 'id'),
                'start_date' => Carbon::parse(Arr::get($schedule, 'start_date')),
                'end_date' => Carbon::parse(Arr::get($schedule, 'end_date')),
                'type' => Arr::get($schedule, 'type'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ];
        }

        return $schedules;
    }
}
