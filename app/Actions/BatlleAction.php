<?php

namespace App\Actions;

use App\Models\PlayerCharModel;
use App\Models\SetInteractiveElementModel;
use Illuminate\Support\Collection;

class BatlleAction
{

    public static function playerVsGroup(PlayerCharModel &$player, Collection &$collection) {
        $roll = array_sum([rand(1,8), rand(1,8)]);
        $result = $roll + $player->attackBase();
        $history = new Collection();
        $collection = $collection->map(function(SetInteractiveElementModel $element) use (&$result, &$history) {
            if($element->intLife < 1)
                return $element;

            if($result < 1)
                return $element;

            $history->add('GO: ' . $result);
            static::decrement($result, $element->intDefense);
            $history->add('DEF: ' . $result);
            if($result < 1)
                return $element;

            $life = $element->intLife;
            $element->intLife = $result > $life ? 0 : $life - $result;
            static::decrement($result, $life);
            $history->add('REDUCE: ' . $result);

            return $element;
        });
        echo $history->toJson() . PHP_EOL;
        echo $collection->where('intLife', '>', 0)->pluck('intLife')->values()->toJson() . PHP_EOL;
        echo 'result:' . $result . PHP_EOL;
        $intAttack = $collection->where('intLife', '>', 0)->pluck('intAttack')->sum();
        $player->defense($intAttack, $result);
        echo 'Player life:' . $player->intLife . PHP_EOL;

    }

    public static function decrement(int &$result, int $sub) {
        $result = $sub > $result ? 0 : $result - $sub;
    }
}
