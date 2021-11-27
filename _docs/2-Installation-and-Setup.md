## Table of contents

  1. [Introduction](1-introduction.md)
  2. [Installation and Setup](2-Installation-and-Setup.md)
  3. [Configuration](3-Configuration.md)
  4. [Usage](4-Usage.md)




## Installation

There is two-step to install packages

## server side 

step 1
```bash
composer require yazan/laravel-datatable
```
step 2 

create grid class 
```bash
php artisan make:grid-class exampleGrid
```

## clint side

step 1 
```bash
npm i @yazan.alnughnugh/vue-datatable
```
step 2 
```javascript
// app/resources/js/app.js

 Vue.component('data-table', require('@yazan.alnughnugh/vue-datatable').default);
```
