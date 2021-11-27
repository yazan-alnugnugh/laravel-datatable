## Table of contents

  1. [Introduction](1-introduction.md)
  2. [Installation and Setup](2-Installation-and-Setup.md)
  3. [Configuration](3-Configuration.md)
  4. [Usage](4-Usage.md)

## Configuration

## client side


**props datatable components**

**config**
```html
// resources/posts/index.blade.php

<x-app-layout>




    <data-table

              :config="{
                url: `/admin/places/all?page=1`,

                toolbar:{
                    show: true,
                    delete: {
                        url: `/${this.lang}/admin/places/destroy/all`
                    }
                },
                perPage: {
                    show: true,
                    counts: [5,10, 25, 50, 100, 250],
                },
                filter:{
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
                }
        
                }"
       

    ></data-table>





</x-app-layout>
}
```
                                                                     |

| Name | Type | Default | Description  
| --- | --- | --- | --- |
| `url ` | String | "/" | json data url |
| `toolbar` | Object | {} | to add toolbar config |
| `toolbar.show` | Object | {} | to disable or enable toolbar |
| `toolbar.delete` | Object | {} | to add toolbar config |
| `toolbar.delete.url` | Object | {} | to add toolbar config |
| `perPage` | Object | {} | to add page rows count config |
| `perPage.show` | Object | {} | disable or enable the feature |
| `perPage.count` | Object | {} | to add rows counts you want to appear on a page |
| `filter` | Object | {} | Add filters data |
| `filter.selection` | Object | {} | the object contains all filter selection data |
| `filter.selection.show` | Object | {} | to disable or enable selection filter |
| `filter.selection.data` | Object | {} | the object is array contains all select input options |
| `filter.selection.data.label` | Object | {} | name appears beside select input |
| `filter.selection.data.relation` | Object | {} | relation name you will get it |
| `filter.selection.data.column` | Object | {} | column you will get it |
| `filter.selection.data.rows` | Object | {} | all rows from the database as JSON |

**columns**
```html
// resources/posts/index.blade.php

<x-app-layout>




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





</x-app-layout>
}
```
                                                               |

| Name | Type | Default | Description  
| --- | --- | --- | --- |
| `label ` | String | '' |  table column head name |
| `column` | String | '' |  database column name |
| `show` | Bool | true | to add toolbar config |
| `sort` | Object | {} | is responsible for sort column |
| `sort.sortable` | Bool | true | if you want to use column for sorting  |
| `sort.sortColumn` | String | '' | column name for sorting |
| `sort.sortDir` | String | asc | sort direction for first sorting |
