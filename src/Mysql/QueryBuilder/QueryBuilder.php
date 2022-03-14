<?php


namespace Yazan\DataTable\Mysql\QueryBuilder;


use Illuminate\Support\Facades\DB;

trait QueryBuilder
{
    use Helper;

    protected $request;
    protected $namespace;
    public function __construct()
    {
        $this->request = request();
        $this->namespace = $this->model;
        $this->model = app($this->namespace)->getTable();


        if(!isset($this->searchColumns) || !count($this->searchColumns)){

            $this->searchColumns = [
               "$this->model.id",
            ];
        }

    }

    protected function create()
    {

        $this->model = DB::table($this->model);

    }


    protected function columns()
    {
      if(isset($this->columns) && count($this->columns)) $this->model->select(...$this->columns);
    }

    protected function join(){

        if(isset($this->join) && count($this->join))

        foreach ($this->join as $key => $value):
            $this->model->join($key, ...$value);
        endforeach;

    }


    protected function search()
    {
        if(empty($this->request->search)) return;

        $search = new Search($this->model);
        $search->normal($this->searchColumns);


    }

    protected function select()
    {
        if(empty($this->request->select) ) return;

        $select = new Select($this->model);

        foreach($this->request->select as $selectInput):


            if(!empty($selectInput) && !empty($selectInput['value'])) $select->{$selectInput['type']}($selectInput);


        endforeach;



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


    }

    protected function orderBy()
    {
        $order = new Order($this->model, $this->namespace);
        $order->{$this->request->sort['type'] ?? 'normal'}($this->request->sort);
    }

    protected function paginate()
    {
        return $this->model = $this->model->paginate($this->request->perPage);

    }
    protected function mapping(callable $callback)
    {
        $this->model = $this->model->toArray();


        $data = array_map(function($value) use (&$callback){


            return $callback((Array)$value);

        }, $this->model['data']);


        $this->model['data'] = $data;




    }

    public function render()
    {

        $this->create();
        $this->columns();
        $this->join();
        $this->search();
        $this->select();
        $this->orderBy();
        $this->paginate();

        if($this->isMapping()) $this->reMapping();


        return $this->resultHandling();
    }

}
