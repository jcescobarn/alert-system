<?php

namespace App\Repositories\Administrator;

use App\Repositories\RepositoriesContract;
use Rinvex\Repository\Repositories\EloquentRepository;
use App\Entities\Administrator\Variable;

class VariableRepository extends EloquentRepository implements RepositoriesContract
{
    /**
     * @var string
     */
    protected $repositoryId = 'rinvex.repository.uniqueid';
    /**
     * @var string
     */
    protected $model = Variable::class;
}