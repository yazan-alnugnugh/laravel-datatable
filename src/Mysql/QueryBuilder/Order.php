<?php


namespace Yazan\DataTable\Mysql\QueryBuilder;


use Illuminate\Support\Facades\DB;

class Order
{
    protected $model;
    protected $request;
    protected $table;

    public function __construct($model, $namespace)
    {
        $this->model = $model;
        $this->namespace = $namespace;
        $this->request = request();
        $this->table = app($this->namespace)->getTable();
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

        $this->model->orderBy(isset($order['column']) ? "{$order['column']}.$this->table" : "$this->table.id", $order['sortDir'] ?? 'asc');

    }

    public function relational($order)
    {
        $table = $order['table'];
        $column = $order['column'];
        $foreignKey = $order['foreign_key'] ?? '';
        $primary = $order['primary'] ?? 'id';
        $modelTable = app($this->namespace)->getTable();
        $subQuery = DB::table($table)->select($column)->whereColumn("$table.$foreignKey", "$modelTable.$primary");


        $this->model->orderBy($subQuery, $order['sortDir'] ?? 'asc');


    }

}
