## Table of contents

  1. [Introduction](1-introduction.md)
  2. [Installation and Setup](2-Installation-and-Setup.md)
  3. [Configuration](3-Configuration.md)
  4. [Usage](4-Usage.md)
  5. [Donations](https://github.com/yazan-alnugnugh/laravel-datatable/blob/master/_docs/Donations/crypto/index.md)


## Configuration

## 1- client side


### props datatable components

#### config
```html
// resources/posts/index.blade.php

    <data-table
              :config="{
                url: `/posts/all?page=1`,
                toolbar:{
                    show: true,
                    delete: {
                        url: `posts/destroy/all`
                        show: `true`
                    }
                },
        
              }"
    ></data-table>

```

| Name | Type | Default | Description  
| --- | --- | --- | --- |
| `url ` | String | "/" | (required) json data url |
| `toolbar` | Object | {} |  to setup toolbar |
| `toolbar.show` | Bool | true | to disable or enable toolbar |
| `toolbar.delete` | Object | {} | to add delete all option to toolbar |
| `toolbar.delete.url` | String | '/' | to set delete all url |
| `toolbar.delete.show` | Bool | true | to disable or enable delete button |
| `search` | Object | {} | to setup search input |
| `search.show` | Bool | true | disable or enable the feature |


#### perPage
```html
// resources/posts/index.blade.php

    <data-table
      :perPage="{
               show: true,
               counts: [5,10, 25, 50, 100, 250],
           }"
    ></data-table>

```

| Name | Type | Default | Description  
| --- | --- | --- | --- |
| `perPage` | Object | {} | to add rows count per page |
| `perPage.show` | Bool | true | disable or enable the feature |
| `perPage.count` | Array | [10, 25, 50, 100, 250] | to add rows counts you want to appear on a page |



#### filters
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
                                                                     |

| Name | Type | Default | Description  
| --- | --- | --- | --- |
| `filters` | Object | {} | Add filters data |
| `filters.selection` | Object | {} | the object contains all filter selection data |
| `filters.selection.show` | Bool | true | to disable or enable selection filter |
| `filters.selection.data` | Object | {} | the object is array contains all select input options |
| `filters.selection.data.label` | String | '' | name appears beside select input |
| `filters.selection.data.relation` | String | '' | relation name you will get it |
| `filters.selection.data.column` | String | '' | column name you will get it |
| `filters.selection.data.rows` | Json | [{}] | all rows from the database as JSON |



**columns**
```html
// resources/posts/index.blade.php

    <data-table
                   :columns="[
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
                  
                      ]
                      "
    ></data-table>
```

| Name | Type | Default | Description  
| --- | --- | --- | --- |
| `label ` | String | '' |  table column head name |
| `column` | String | '' |  database column name |
| `show` | Bool | true | to add toolbar config |
| `sort` | Object | {} | is responsible for sort column |
| `sort.sortable` | Bool | true | disable or enable sorting  |
| `sort.sortColumn` | String | '' | column name for sorting |
| `sort.sortDir` | String | asc | sort direction for first sorting |
