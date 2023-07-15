<?php

namespace Database\Factories;

use App\Models\PlayerCharModel;
use Illuminate\Database\Eloquent\Factories\Factory;

class PlayerCharFactory extends Factory
{
    protected $model = PlayerCharModel::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        $attr = range(0,4);
        shuffle($attr);
        return [
            'acc'=>1,
            'chrName'=>$this->faker->name(),
            'documentImage'=>null,
            'chrOrder'=>'Terrenos',
            'intBody'=>$attr[0],
            'intSoul'=>$attr[1],
            'intInstinct'=>$attr[2],
            'intMind'=>$attr[3],
            'intSocial'=>$attr[4],
            'intAbsMod'=>0,
            'intDmgMod'=>0
        ];
    }
}
