<?php


namespace App\Repositories\Interfaces;

interface IBaseRepository
{

    /**
     * @return Model
     */
    public function makeModel();

    /**
     * @param  mixed $with
     * @return void
     */
    public function fetchAll($with = [], $columns = array('*'));

    public function pagination($with = [], $columns = array('*'));

    /**
     * @param array $payload
     * @return mixed
     */
    public function create($payload);

    /**
     * @param array $payload
     * @param $id
     * @param string $attribute
     * @return mixed
     */
    public function update(array $payload, $id, $attribute = "id");

    /**
     * @param $id
     * @return void
     */
    public function delete($id);

    /**
     * @param $attribute
     * @param $value
     * @param array $columns
     * @return mixed
     */
    public function findBy($attribute, $value, $columns = array('*'));
}
