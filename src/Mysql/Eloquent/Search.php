<?php


namespace Yazan\DataTable\Mysql\Eloquent;


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

            $this->model->Where($column, 'like', '%'.$this->request->search.'%');

        endforeach;

        return $this;

    }

    public function relational($relations)
    {
        $search = $this->request->search;
        foreach ($relations as $relation => $columns):

                $this->model->orWhereHas($relation, function ($query) use ($columns, $search) {

                    foreach ($columns as $column):
                        $query->Where( $column, $search);
                    endforeach;

                });

        endforeach;

    }

    public function translatable($columns)
    {

        if(empty($this->request->search)) return;

        foreach ($columns as $column):

            $this->model->OrWhereTranslationLike($column, '%'.$this->request->search.'%');

        endforeach;

        return $this;

    }

}
