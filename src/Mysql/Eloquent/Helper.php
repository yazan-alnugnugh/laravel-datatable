<?php


namespace Yazan\DataTable\Mysql\Eloquent;


trait Helper
{
    public function isMapping()
    {
        return method_exists($this, 'reMapping');
    }

    public function resultHandling()
    {
        return $this->isMapping() ?$this->model : $this->model->toArray();
    }


}
