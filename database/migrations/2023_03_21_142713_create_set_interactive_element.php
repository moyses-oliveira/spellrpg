<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSetInteractiveElement extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('set_npc');
        Schema::dropIfExists('set_interactive_element');
        Schema::create('set_interactive_element', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('acc');
            $table->char('chrType', 31);
            $table->char('chrName', 127);
            $table->char('documentImage', 255)->nullable();
            $table->char('chrElementType', 31);
            $table->tinyInteger('intAttack');
            $table->tinyInteger('intDefense');
            $table->tinyInteger('intAbsMod');
            $table->tinyInteger('intDmgMod');
            $table->tinyInteger('intLife');
            $table->date('dttDeleted')->nullable(true);
        });

        Schema::create('set_npc', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('acc');
            $table->unsignedInteger('fkIE');
            $table->tinyInteger('intBody');
            $table->tinyInteger('intSoul');
            $table->tinyInteger('intInstinct');
            $table->tinyInteger('intMind');
            $table->tinyInteger('intSocial');

            $table->foreign('fkIE')
                ->references('id')
                ->on('set_interactive_element');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    }
}
