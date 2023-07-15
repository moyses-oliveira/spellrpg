<?php

namespace App\Console\Commands;

use App\Models\SetInteractiveElementModel;
use Illuminate\Console\Command;

class MakeEnemyCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:enemy';

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
        $model = new SetInteractiveElementModel();
        $model->fill([
            'acc'=>1,
            'chrType'=>'',
            'chrName'=>'Goblin',
            'documentImage'=>null,
            'chrElementType'=>'',
            'intAttack'=>2,
            'intDefense'=>2,
            'intAbsMod'=>0,
            'intDmgMod'=>0,
            'intLife'=>10
        ]);
        $model->save();
    }


}
