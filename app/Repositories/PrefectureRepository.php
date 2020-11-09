<?php

namespace App\Repositories;

use App\Entities\Area;
use App\Entities\Prefecture;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class PrefectureRepository.
 *
 * @package namespace App\Repositories;
 */
class PrefectureRepository extends BaseRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Prefecture::class;
    }

    public function getAll()
    {
        return Prefecture::with('area')->get()->sortByDesc("created_at");
    }

    public function show($id)
    {
        $prefecture = parent::find($id);
        $area = Area::find($prefecture['area_id']);
        $prefecture['area_name'] = $area->name;
        return $this->parserResult($prefecture);
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
