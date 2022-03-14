<?php


namespace Yazan\DataTable\Mysql\QueryBuilder;


class Search
{
    protected $model;
    protected $request;

    public function __construct($model)
    {
        $this->model = $model;
        $this->request = request();
    }

    public function normal($columns)
    {

        if(empty($this->request->search)) return;

        foreach ($columns as $column):

            $this->model->orWhere($column, 'like', '%'.$this->request->search.'%');

        endforeach;


    }


}
