<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class SetInteractiveElement
 *
 * @property int $id
 * @property int $acc
 * @property string $chrType
 * @property string $chrName
 * @property string|null $documentImage
 * @property string $chrElementType
 * @property int $intAttack
 * @property int $intDefense
 * @property int $intAbsMod
 * @property int $intDmgMod
 * @property int $intLife
 * @property Carbon|null $dttDeleted
 *
 * @package App\Models
 */
class SetInteractiveElementModel extends Model
{
	protected $table = 'set_interactive_element';
	public $timestamps = false;

	protected $casts = [
		'acc' => 'int',
		'intAttack' => 'int',
		'intDefense' => 'int',
		'intAbsMod' => 'int',
		'intDmgMod' => 'int',
		'intLife' => 'int',
		'dttDeleted' => 'date'
	];

	protected $fillable = [
		'acc',
		'chrType',
		'chrName',
		'documentImage',
		'chrElementType',
		'intAttack',
		'intDefense',
		'intAbsMod',
		'intDmgMod',
		'intLife',
		'dttDeleted'
	];
}
