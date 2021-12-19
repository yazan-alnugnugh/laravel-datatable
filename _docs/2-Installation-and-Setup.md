## Table of contents

  1. [Introduction](1-introduction.md)
  2. [Installation and Setup](2-Installation-and-Setup.md)
  3. [Configuration](3-Configuration.md)
  4. [Usage](4-Usage.md)
  5. [Donations](https://github.com/yazan-alnugnugh/laravel-datatable/blob/master/_docs/Donations/crypto/index.md)



## Requirements

* [Vue.js](https://vuejs.org/)  => 2.x
* [Laravel](http://laravel.com/docs/) => 7.x
* [Tailwind](https://tailwindcss.com/) => 1.*


## Installation


for install and setup them we will work on the server-side and client-side , using few steps 
## server side 

#### step 1
```bash
composer require yazan/laravel-datatable
```
#### step 2 

create grid class 
```bash
php artisan make:grid-class exampleGrid
```

## clint side

#### step 1 
```bash
npm i @yazan.alnughnugh/vue-datatable
```
#### step 2 
```javascript
// app/resources/js/app.js

 Vue.component('data-table', require('@yazan.alnughnugh/vue-datatable').default);
```
