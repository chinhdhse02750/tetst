<?php
namespace App\Services;

use App\Entities\News;
use App\Helpers\Constants;
use App\Repositories\NewsRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class NewsService
{
    protected $newsRepository;

    public function __construct(
        NewsRepository $newsRepository
    ) {
        $this->newsRepository = $newsRepository;
    }

    public function getNews()
    {
        $currentTime = date_format(Carbon::now(), 'Y-m-d H:i:s');

        return News::orderBy('order', 'asc')
            ->where('active', '=', Constants::DEFAULT_ACTIVE)
            ->where(function ($q) use ($currentTime) {
                $q->where('end_time', '>', $currentTime)
                    ->orWhereNull('end_time');
            })
            ->where(function ($q) use ($currentTime) {
                $q->where('start_time', '<=', $currentTime)
                    ->orWhereNull('start_time');
            })
            ->get();
    }
}
