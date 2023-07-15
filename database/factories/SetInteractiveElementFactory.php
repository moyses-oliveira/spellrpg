<?php

namespace Database\Factories;

use App\Models\SetInteractiveElementModel;
use Illuminate\Database\Eloquent\Factories\Factory;

class SetInteractiveElementFactory extends Factory
{
    protected $model = SetInteractiveElementModel::class;
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
            'chrType'=>'Enemy',
            'chrName'=>'Random',
            'documentImage'=>null,
            'chrElementType'=>'Creature',
            'intAttack'=>10,
            'intDefense'=>10,
            'intAbsMod'=>3,
            'intDmgMod'=>3,
            'intLife'=>100
        ];
    }
}
