<?php


namespace Yazan\DataTable\Mysql\Eloquent;


trait Eloquent
{
    use Helper;

    protected $request;
    protected $namespace;




    public function __construct()
    {
        $this->request = request();
        $this->namespace = $this->model;

        if(!isset($this->searchColumns) || !count($this->searchColumns)){

            $this->searchColumns = [
                'normal' => ['id'],
            ];
        }



    }






    protected function create()
    {
        $this->model = $this->model::query();
    }

    protected function with(){
        if(isset($this->with) && count($this->with))$this->model->with($this->with);
    }


    protected function search()
    {
        if(empty($this->request->search)) return;

         $search = new Search($this->model);
        foreach ($this->searchColumns as $type => $columns):
            $search->{$type}($columns);
        endforeach;

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
        return $this->model = $this->model->paginate($this->request->perPage, isset($this->columns) && count($this->columns) ? $this->columns  : '*');

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
        $this->select();
        $this->orderBy();
        $this->paginate();
        if($this->isMapping()) $this->reMapping();


        return $this->resultHandling();
    }


}
