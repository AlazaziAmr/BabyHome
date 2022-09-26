<?php

namespace  App\Repositories\Classes;

use App\Repositories\Interfaces\IBaseRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Container\Container as App;

abstract class BaseRepository implements IBaseRepository
{

    /**
     * @var App
     */
    private $app;

    /**
     * @var
     */
    protected $model;

    /**
     * BaseRepository constructor.
     * @param App $app
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function __construct(App $app)
    {
        $this->app = $app;
        $this->makeModel();
    }

    /**
     * Specify Model class name
     *
     * @return mixed
     */
    abstract function model();

    /**
     * @return Model
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function makeModel(): Model
    {
        $model = $this->app->make($this->model());
        return $this->model = $model;
    }

    /**
     * @param array $columns
     * @param array $conditions
     * @return mixed
     * @throws \Exception
     */
    public function fetchAll($with = [], $columns = array('*'))
    {
        $query = $this->model;
        if (!empty($with))
            return $query->with($with)->get($columns);
        else
            return $query->get($columns);
    }

    /**
     * @param array $payload
     * @return mixed
     */
    public function create($payload)
    {
        return $this->model->create($payload);
    }

    /**
     * @param array $payload
     * @param $id
     * @param string $attribute
     * @return mixed
     */
    public function update(array $payload, $id, $attribute = "id")
    {
        return $this->model->where($attribute, '=', $id)->update($payload);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        return $this->model->destroy($id);
    }


    /**
     * @param $attribute
     * @param $value
     * @param array $columns
     * @return mixed
     */
    public function findBy($attribute, $value, $columns = array('*'))
    {
        return $this->model->where($attribute, '=', $value)->first($columns);
    }
}
