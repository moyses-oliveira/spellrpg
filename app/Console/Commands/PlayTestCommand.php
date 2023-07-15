<?php

namespace App\Console\Commands;

use App\Actions\BatlleAction;
use App\Models\PlayerCharModel;
use App\Models\SetInteractiveElementModel;
use Illuminate\Console\Command;
use Illuminate\Support\Collection;

class PlayTestCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'play:test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $collection = new Collection();
        for($i=0;$i<5;$i++):
            $collection->add(SetInteractiveElementModel::find(1));
        endfor;
        /** @var PlayerCharModel $player */
        $player = PlayerCharModel::find(6);
        $count = 0;
        while ($player->intLife > 0 && $collection->sum('intLife') > 0 && $count < 20):
            $count++;
            echo '# RODADA ' . $count . PHP_EOL;
            BatlleAction::playerVsGroup($player, $collection);
        endwhile;

        return 0;
    }
}
