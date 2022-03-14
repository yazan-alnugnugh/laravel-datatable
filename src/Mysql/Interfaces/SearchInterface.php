<?php


namespace Yazan\DataTable\Mysql\Interfaces;


interface SearchInterface
{
    /**
     * @return mixed
     */
      public function normal();

      public function relational();

      public function translatable();

}
