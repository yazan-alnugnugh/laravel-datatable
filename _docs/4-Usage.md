## Table of contents

  1. [Introduction](1-introduction.md)
  2. [Installation and Setup](2-Installation-and-Setup.md)
  3. [Configuration](3-Configuration.md)
  4. [Usage](4-Usage.md)
        * [Basic Usage](#Basic-Usage)
        * [relation include](#relation-include)
        * [Searching](#Searching)
        * [Sorting](#Sorting)
        * [Selection filter](#Selection-filter-for-relations)
        * [Data mapping](#Data-mapping)
        * [Action buttons](#Action-buttons)
        * [Delete](#Delete)
        * [Delete All](#Delete-All)
  5. [Donations](https://github.com/yazan-alnugnugh/laravel-datatable/blob/master/_docs/Donations/crypto/index.md)
        
        

## Usage

## Basic Usage

### **server side**

#### step 1 

create grid class 
```bash
php artisan make:grid-class exampleGrid
```

#### step 2 
Start use Grid Class
and add model namespace to ``` $model ``` property

```php
// app/DataGrid/PostGrid.php

<?php


namespace App\DataGrid;

use Yazan\DataTable\DataGrid;

class PostGrid extends DataGrid
{

    public $model = "App\Models\Post";


}

```

#### step 3 

Make an instance from PostGrid class and return the collection

```php
// app/Http/Controller/PostController.php

public function all(Request $request)
{ 
  $posts = (new PostGrid())->render();
    
  return ['success' => true, 'collection' => $posts];

}

```


### **client side**
#### step 1 

use the data-table component in your blade

```html
// resources/posts/index.blade.php

    <data-table
        :config="{
        url: `/posts/all?page=1`,
            },
        }"
        :columns="[
        {
        label: 'ID',
        column: 'id',
        show: true,
            sort:{
              sortable: false,
              sortColumn: 'id',

            },

       },
        {
        label: 'Title',
        column: 'title',
         show: true,
            sort:{
             sortable: true,
             sortColumn: 'title',
             sortDir: 'asc',
            },
       },
       {
        label: 'CreatedAt',
        column: 'created_at',
        show: true,
             sort:{
                sortable: true,
                sortColumn: 'created_at',
                sortDir: 'asc',
             },
       },
       {
        label: 'UpdatedAt',
        column: 'updated_at',
        show: true,
             sort:{
                sortable: true,
                sortColumn: 'updated_at',
                sortDir: 'asc',
             },
       },
        ]
        "

    ></data-table>

```

## relation include

### **server side**

#### step 1 

add ``` $relationAble``` and ``` $with``` properties to start insert relation columns to table 

````php
// app/DataGrid/PostGrid.php

   public $relationAble = true;
   protected $with = ['admin'];
````
after that we need to [remapping data](#Data-mapping) To determine which relation column we want to add to data-table

### **client side**
#### step 1 
add relation column to columns prop
```html
// resources/posts/index.blade.php

    <data-table
        :columns="[
            {
            label: 'Admin',
            column: 'admin',
            show: true,
                sort:{
                 sortable: true,
                 sortColumn: 'title',
                 sortDir: 'asc',
                },
            },
        ]"
    ></data-table>

```


## Searching

### **server side**

to start using search input we will specific columns we want to search within by default search column will be ``id``

add ``` $searchColumns``` property to start use search feature

````php
// app/DataGrid/PostGrid.php

     public $searchColumns = ['id'];
````

## Sorting

### **client side**

to use the sort feature we will add a sort object

there is 3 property inside sort

1- ````sort.sortable```` : if you want to use a column for sorting 

2- ````sort.sortColumn```` : column name for sorting

3- ````sort.sortDir```` : sort direction for the first sorting 
```html
// resources/posts/index.blade.php

    <data-table
        :columns="[
            {
            label: 'Admin',
            column: 'admin',
            show: true,
                sort:{
                 sortable: true,
                 sortColumn: 'title',
                 sortDir: 'asc',
                },
           },
        ]"
    ></data-table>

```

## Per page


### **client side**

to use rows count per page we need to use ````perPage```` prop

1- ````perPage.show````: disable or enable the feature

2- ````perPage.counts````: to add rows counts you want to appear on a page
```html
// resources/posts/index.blade.php

    <data-table
         :perPage="
                {
                 show: true,
                 counts: [10, 25, 50, 100, 250],
                }"
    ></data-table>

```

## Selection filter for relations


### **client side**

to add select input for relation column you will add filters prop as below
```selection``` the object contains all filter selection data
 
 ````show```` to disable or enable selection filter 
 
```data``` the object is array contains all select input options

```label``` name appears beside select input

```relation``` relation name you will get it

```column``` column you will get it 

```rows``` all rows from the database as JSON

```html
// resources/posts/index.blade.php

    <data-table
                :filters="{
                    selection:{
                        show: true,
                        data:[
                            {
                            label: 'Admins',
                            relation: 'createdBy',
                            column: 'first_name',
                            rows: {{json_encode($admins)}}
                            },
                        ]
                    }
               }"
            

    ></data-table>
```

## Data mapping
### **server side**

if you would to restructure data we provide this method for you

in first we will add ```$isMapping``` property equal true
```php
// app/DataGrid/PostGrid.php

   protected $isMapping = true;
```
after that, we will add this method is contains callback 
function return array contain our collection 
```php
// app/DataGrid/PostGrid.php

    protected function reMapping()
        {
            $this->mapping(function($value){
                return [
                    'id' => $value['id'],
                    'title' => $value['title'],
                    'created_at' => $value['created_at'],
                    'updated_at' => $value['updated_at'],
                  
                ];
            });
 
        }
```

## Action buttons

### **server side**

to add action buttons to rows we will use an action array to do that
we can add associative array to action array with two value button structure and visibility true or false

```php
// app/DataGrid/PostGrid.php

    protected function reMapping()
        {
            $this->mapping(function($value){
                return [
                    'id' => $value['id'],
                    'title' => $value['title'],
                    'created_at' => $value['created_at'],
                    'updated_at' => $value['updated_at'],
                    'action' => [
                        'edit' => ['<i data-path="'. route( 'admin.posts.edit', ['post' => $value['id']]).'" class="pathName cursor-pointer hover:text-green-500 far fa-edit"></i>', true],
                    ],
                  
                ];
            });
 
        }
```

## Delete

### **server side**

to use delete action just we can insert our delete button and add 
```delete```class to Html tag and ```data-path``` attribute include path to delete element As shown below 
```php
// app/DataGrid/PostGrid.php

    protected function reMapping()
        {
            $this->mapping(function($value){
                return [
                    'id' => $value['id'],
                    'title' => $value['title'],
                    'created_at' => $value['created_at'],
                    'updated_at' => $value['updated_at'],
                    'action' => [
                        'delete' => ['<i data-route="'. route( 'admin.posts.destroy', ['post' => $value['id']]).'" class="confirm delete cursor-pointer  hover:text-red-500 far fa-trash-alt"></i>', true],

                    ],
                  
                ];
            });
 
        }
```



## Delete All

### **client side**

inside toolbar object will add url property contain our delete all route
```html
// resources/posts/index.blade.php

    <data-table
         :config="{
               toolbar:{
                   show: true,
                   delete: {
                       url: `/posts/destroy/all`
                   }
                },           
         }"   
    ></data-table>

```

### **server side**
in server-side will receive request containing ids 
after that do our delete mission
```php

public function destroyAll(Request $request){

        $list = $request->list;
        $posts = Post::destroy($list);
        return ['success' => true, 'message' => 'posts deleted successfully'];

    }
```
