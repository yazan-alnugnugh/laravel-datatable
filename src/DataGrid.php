<?php


namespace Yazan\DataTable;




 abstract class DataGrid
{

     protected $model;
     protected $searchColumns = ['id'];
     protected $relationAble = true;
     protected $request;
     protected $with = [];
     protected $isMapping = false;

     public function __construct()
     {
        $this->request = request();

     }

    protected function create()
    {
        $this->model = $this->model::query();
        return $this;
    }

    protected function with(){
         if(count($this->with))$this->model->with($this->with);
    }


     protected function search()
    {

        if(empty($this->request->search)) return;

        foreach ($this->searchColumns as $column):

            $this->model->orWhere($column, 'like', '%'.$this->request->search.'%');

        endforeach;

        return $this;

    }

     protected function relations()
    {
        if(!$this->relationAble) return;
        if(!empty($this->request->relations) )
            foreach($this->request['relations'] as $relation):

               if(!empty($relation) && !empty($relation['value']))
                $this->model->whereHas($relation['relation'], function ($query) use ($relation) {
                    $query->Where( 'id', $relation['value'] );
                });

            endforeach;


        return $this;


    }

     protected function orderBy()
    {

        $this->model->orderBy($this->request->sort['column'] ?? 'id', $this->request->sort['sortDir'] ?? 'asc');
        return $this;
    }

     protected function paginate()
    {
        return $this->model = $this->model->paginate($this->request->perPage);

    }
    protected function mapping(callable $callback)
    {
        $this->model = $this->model->toArray();
        $data = array_map(function($value) use (&$callback){


            return $callback($value);

        }, $this->model['data']);


        $this->model['data'] = $data;


    }

    public function render()
    {
        $this->create();
        $this->with();
        $this->search();
        $this->relations();
        $this->orderBy();
        $this->paginate();
        if($this->isMapping) $this->reMapping();


        return $this->isMapping ?$this->model : $this->model->toArray();
    }









}
