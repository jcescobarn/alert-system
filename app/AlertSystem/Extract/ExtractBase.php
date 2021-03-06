<?php

namespace App\AlertSystem\Extract;

use App\AlertSystem\Connection\SearchTableInExternalStaticConnection;
use App\AlertSystem\Traits\StorageServerTrait;
use Carbon\Carbon;

class ExtractBase
{
    use StorageServerTrait,SearchTableInExternalStaticConnection;

    /**
     * @var string
     */
    protected $connection;
    /**
     * @var string
     */
    protected $stationTable;
    /**
     * @var array
     */
    public $data = [];
    /**
     * @var bool
     */
    public $dataExistence = false;
    /**
     * @var Carbon
     */
    protected $initDateTime;
    /**
     * @var Carbon
     */
    protected $finalDateTime;

    /**
     * AcquisitionServerExtract constructor.
     * @param string $connection
     * @param string $stationTable
     * @param Carbon $initDateTime
     * @param Carbon $finalDateTime
     */
    public function __construct(string $connection, string $stationTable,Carbon $initDateTime, Carbon $finalDateTime)
    {
        $this->stationTable = $stationTable;
        $this->initDateTime = $initDateTime;
        $this->finalDateTime = $finalDateTime;

        $this->connection =  $this->searchStaticConnection($connection,$stationTable);
    }

    public function validateTheLastData(){
        $value = $this->countDataToExtract(
            $this->connection,
            $this->stationTable,
            $this->initDateTime->format('Y-m-d'),
            $this->initDateTime->format('h:i:s'),
            $this->finalDateTime->format('Y-m-d'),
            $this->finalDateTime->format('h:i:s')
        );

        if ($value >= 2){ $this->dataExistence = true; }
    }

    public function extractData(){
        $this->data = $this->gatExternalData(
            $this->connection,
            $this->stationTable,
            $this->initDateTime->format('Y-m-d'),
            $this->initDateTime->format('h:i:s'),
            $this->finalDateTime->format('Y-m-d'),
            $this->finalDateTime->format('h:i:s')
        );
    }
}