<?php

namespace App\Repositories\AlertSystem;

use App\Entities\Administrator\AlertFlood;
use App\Repositories\RepositoriesContract;
use Rinvex\Repository\Repositories\EloquentRepository;

class FloodRepository extends EloquentRepository implements RepositoriesContract
{
    /**
     * @var string
     */
    protected $repositoryId = 'rinvex.repository.uniqueid';
    /**
     * @var string
     */
    protected $model = AlertFlood::class;

    /**
     * @return mixed
     */
    public  function createShowcase(){
        return new $this->model;
    }

    /**
     * @param int $stationId
     * @param string $date
     * @return mixed
     */
    public function getUltimateDate(int $stationId, string $date)
    {
        return $this->select('*')
                    ->where('station','=',$stationId)
                    ->where('date_execution','<', $date)
                    ->orderBy('date_execution', 'desc')
                    ->first();
    }

    /**
     * @param int $stationId
     * @param string $dateOne
     * @param string $dateTwo
     * @return mixed
     */
    public function getBetweenData(int $stationId,string $dateOne,string $dateTwo)
    {
        return $this->selectRaw('date_execution, a10_value as value')
                //->selectRaw('station , a10_value as value, alert , avg_recovered , dif_previous_a10 as dif_previous, num_not_change_alert, change_alert, alert_decrease, alert_increase, alert_increase, error, date_execution, date_initial, date_final, comment')
                ->where('station','=',$stationId)
                ->whereBetween('date_execution',[$dateOne,$dateTwo])
                ->orderBy('date_execution')
                ->get()
                ->toArray();
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getAlert(int $id){
        return $this->select('*')->where('id','=',$id)->first();
    }
}