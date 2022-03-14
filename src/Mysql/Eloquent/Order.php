<?php


namespace Yazan\DataTable\Mysql\Eloquent;


use Illuminate\Support\Facades\DB;

class Order
{
    protected $model;
    protected $request;

    public function __construct($model, $namespace)
    {
        $this->model = $model;
        $this->namespace = $namespace;
        $this->request = request();
    }

    /*
        * select: {
        * Admins: {
        * type: relational
        * table: "admins",
        * foreign_key: created_by,
        * value: 1,
        * },
        * Places: {
        * type: normal
        * column:'id'
        * value: 1
        * }
        * }
        * */

    public function normal($order)
    {

        $this->model->orderBy($order['column'] ?? 'id', $order['sortDir'] ?? 'asc');

    }

    public function relational($order)
    {
        $table = $order['table'];
        $column = $order['column'];
        $foreignKey = $order['foreign_key'] ?? '';
        $modelTable = app($this->namespace)->getTable();
        $subQuery = DB::table($table)->select($column)->whereColumn("$table.id", "$modelTable.$foreignKey");


        $this->model->orderBy($subQuery, $order['sortDir'] ?? 'asc');


    }

    public function translatable($order)
    {

        $this->model->orderByTranslation($order['column'] ?? 'id', $order['sortDir'] ?? 'asc');

    }
}
