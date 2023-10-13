<?php


namespace Yazan\DataTable\Mysql\QueryBuilder;


trait Helper
{
    public function isMapping()
    {
        return method_exists($this, 'reMapping');
    }

    public function isCustomQuery()
    {
        return method_exists($this, 'setCustomQuery');
    }

    public function resultHandling()
    {
        return $this->isMapping() ?$this->model : $this->model->toArray();
    }


}
