<?php

namespace App\Repositories\Administrator;

use App\Repositories\RepositoriesContract;
use DB;
use Rinvex\Repository\Repositories\EloquentRepository;
use App\Entities\Administrator\Alert;

class AlertRepository extends EloquentRepository implements RepositoriesContract
{
    /**
     * @var string
     */
    protected $repositoryId = 'rinvex.repository.uniqueid';
    /**
     * @var string
     */
    protected $model = Alert::class;

    // The new method from alert-system TODO

    /**
     * @return mixed
     */
    protected function queryBuilder()
    {
        return DB::connection('administrator')->table('alert');
    }

    /**
     * @param $alertCode
     * @return mixed
     */

   public function getLevelAlert($alertCode)
   {
      return $this->queryBuilder()
                ->select('alert.id','alert.code','level_alert.*')
                ->join('level_alert','level_alert.alert_id','=','alert.id')
                ->where('alert.code','=',$alertCode)
                ->orderBy('level_alert.level','DESC')
                ->get();
    }

    /**
     * @return mixed
     */
    public function getAlerts()
    {
        return $this->select('*')->where('active','=',true)->get()->toArray();
    }

    /**
     * @param array $codes
     * @return mixed
     */
    public function getAlertsWhereIn(array $codes)
    {
        return $this->select('*')->where('active','=',true)->whereIn('code',$codes)->get()->toArray();
    }

}