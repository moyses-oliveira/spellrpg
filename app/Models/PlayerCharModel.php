<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class PlayerChar
 *
 * @property int $id
 * @property int $acc
 * @property string $chrName
 * @property string|null $documentImage
 * @property string $chrOrder
 * @property int $intBody
 * @property int $intSoul
 * @property int $intInstinct
 * @property int $intMind
 * @property int $intSocial
 * @property int $intAttackBonus
 * @property int $intDefenseBonus
 * @property int $intDamageAbsorption
 * @property int $intDamageBonus
 * @property Carbon|null $dttDeleted
 *
 * @property Collection|PlayerCharAction[] $player_char_actions
 * @property Collection|PlayerCharBackground[] $player_char_backgrounds
 * @property Collection|PlayerCharEquipment[] $player_char_equipments
 * @property Collection|PlayerCharSkill[] $player_char_skills
 *
 * @package App\Models
 */
class PlayerCharModel extends Model
{
    use HasFactory;
	protected $table = 'player_char';
	public $timestamps = false;

	protected $casts = [
		'acc' => 'int',
		'intBody' => 'int',
		'intSoul' => 'int',
		'intInstinct' => 'int',
		'intMind' => 'int',
		'intSocial' => 'int',
		'intAbsMod' => 'int',
		'intDmgMod' => 'int',
		'dttDeleted' => 'date'
	];

	protected $fillable = [
		'acc',
		'chrName',
		'documentImage',
		'chrOrder',
		'intBody',
		'intSoul',
		'intInstinct',
		'intMind',
		'intSocial',
		'intAbsMod',
		'intDmgMod',
		'dttDeleted'
	];

    public $intLife = 50;

    public function attackBase():int {
        return $this->intBody;
    }

    public function defense(int $enemyAtack, int $roll) {
        $dmg = $enemyAtack  - $roll;
        if($dmg < 1)
            return;

        $this->intLife -= $dmg;
    }
//
//	public function player_char_actions()
//	{
//		return $this->hasMany(PlayerCharAction::class, 'fkChar');
//	}
//
//	public function player_char_backgrounds()
//	{
//		return $this->hasMany(PlayerCharBackground::class, 'fkChar');
//	}
//
//	public function player_char_equipments()
//	{
//		return $this->hasMany(PlayerCharEquipment::class, 'fkChar');
//	}
//
//	public function player_char_skills()
//	{
//		return $this->hasMany(PlayerCharSkill::class, 'fkChar');
//	}
}
