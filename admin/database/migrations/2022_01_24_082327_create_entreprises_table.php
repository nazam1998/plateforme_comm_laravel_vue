<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEntreprisesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entreprises', function (Blueprint $table) {
            $table->unsignedBigInteger('tva')->unique();
            $table->string('nom');
            $table->string('activite');
            $table->string('adresse');
            $table->string('ville');
            $table->bigInteger('numero');
            $table->integer('code_postal');
            $table->string('email_contact')->nullable();
            $table->string('nom_contact')->nullable();
            $table->bigInteger('numero_contact')->nullable();
            $table->foreignId('user_id')->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('entreprises');
    }
}
