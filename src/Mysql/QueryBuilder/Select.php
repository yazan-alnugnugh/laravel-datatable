<?php


namespace Yazan\DataTable\Mysql\QueryBuilder;


class Select
{
    protected $model;
    protected $request;

    public function __construct($model)
    {
        $this->model = $model;
        $this->request = request();
    }

    /*
        * select: {
        * Admins: {
        * type: relational
        * relation: "createdBy",
        * value: 1,
        * },
        * Places: {
        * type: normal
        * column:'id'
        * value: 1
        * }
        * }
        * */

    public function normal($select)
    {

            $this->model->where($select['searchColumn'], $select['value']);

    }

    public function relational($select)
    {


        $this->model->where($select['searchColumn'], $select['value']);


    }

    public function translatable($select)
    {
        $this->model->where($select['searchColumn'], $select['value']);

    }

}
