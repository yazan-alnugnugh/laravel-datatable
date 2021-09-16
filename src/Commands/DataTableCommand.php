<?php

namespace Yazan\DataTable\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class DataTableCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:data-grid {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new Data Grid class' ;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        $content = "<?php


namespace App\DataGrid;

use Yazan\DataTable\DataGrid;

class {$this->argument('name')} extends DataGrid
{

    public \$model = \"\";


}
";
        if(!File::isDirectory('app/DataGrid')) File::makeDirectory('app/DataGrid');





        if(File::exists("app/DataGrid/{$this->argument('name')}.php")){

            $this->error('this file is exist');
        }else{
            File::put("app/DataGrid/{$this->argument('name')}.php", $content);
        }
//

//        return 'hello';
    }
}
