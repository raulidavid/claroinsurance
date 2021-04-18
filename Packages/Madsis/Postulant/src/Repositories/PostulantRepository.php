<?php

namespace Madsis\Postulant\Repositories;

use Illuminate\Database\DatabaseManager as DB;
use Illuminate\Container\Container as App;
use Madsis\Core\Eloquent\Repository;
use Madsis\Postulant\Contracts\Postulant;
use Fouladgar\EloquentBuilder\EloquentBuilder;

class PostulantRepository extends Repository {

    /**
     * @var ContadorRepository
     */
    private $contadorRepository;
    /**
     * @var EloquentBuilder
     */
    private $eloquentBuilder;
    /**
     * @var DB
     */
    private $db;

    public function __construct(
        App $app,
        DB $db,
        EloquentBuilder $eloquentBuilder
    ) {
        parent::__construct($app);
        $this->eloquentBuilder = $eloquentBuilder;
        $this->db = $db;
    }

    public function model()
    {
        return Postulant::class;
    }

    public function __call($method, $arguments)
    {
        return $this->model->$method(...$arguments);
    }

    public function filters(array $filters)
    {
        $this->model = $this->eloquentBuilder->setFilterNamespace('Madsis\Core\Filters\Order')->to($this->model, $filters);
        return $this;
    }

}