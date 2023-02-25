<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlayerCharacterSheet extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('player_char', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('acc');
            $table->char('chrName', 127);
            $table->char('documentImage', 255)->nullable();
            $table->char('chrOrder', 31);
            $table->tinyInteger('intStrength');
            $table->tinyInteger('intDexterity');
            $table->tinyInteger('intConstitution');
            $table->tinyInteger('intIntelligence');
            $table->tinyInteger('intWisdom');
            $table->tinyInteger('intCharisma');
        });

        Schema::create('player_char_background', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('acc');
            $table->unsignedInteger('fkChar');
            $table->text('txtMotivation');
            $table->text('txtHistory');
            $table->text('txtBehaviors');
            $table->text('txtWeaknesses');
            $table->text('txtStrengths');
            $table->text('txtAppearance');

            $table->foreign('fkChar')
                ->references('id')
                ->on('player_char');
        });

        Schema::create('player_char_action', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('acc');
            $table->unsignedInteger('fkChar');
            $table->unsignedInteger('fkAction');

            $table->foreign('fkChar')
                ->references('id')
                ->on('player_char');
        });

        Schema::create('player_char_skill', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('acc');
            $table->unsignedInteger('fkChar');
            $table->unsignedInteger('fkSkill');
            $table->tinyInteger('intLevel');

            $table->foreign('fkChar')
                ->references('id')
                ->on('player_char');
        });

        Schema::create('player_char_equipment', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('acc');
            $table->unsignedInteger('fkChar');
            $table->unsignedInteger('fkEquipment');
            $table->tinyInteger('intScale');
            $table->tinyInteger('intStrength');
            $table->tinyInteger('intDexterity');
            $table->tinyInteger('intConstitution');
            $table->tinyInteger('intIntelligence');
            $table->tinyInteger('intWisdom');
            $table->tinyInteger('intCharisma');
            $table->decimal('dcmWeight', 12,3);
            $table->char('documentEffects', 255)->nullable();
            $table->char('documentImage', 255)->nullable();

            $table->foreign('fkChar')
                ->references('id')
                ->on('player_char');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('player_character_sheet');
    }
}
