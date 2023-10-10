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

    public function translatable($select)
    {
        $this->model->where($select['searchColumn'], $select['value']);

    }

    public function relational($select)
    {


        $this->model->where($select['searchColumn'], $select['value']);


    }

    public function translatableRelations($select)
    {

        $this->model->WhereHas($select['relation'], function ($query) use ($select) {

            $query->whereTranslation($select['searchColumn'] ?? 'id', $select['value']);

         });

    }

}
