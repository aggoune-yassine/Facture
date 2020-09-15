<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFacturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('factures', function (Blueprint $table) {
            $table->id();
            $table->string('facture_code')->unique();
            $table->integer('user_id')->unsigned()->index();
            $table->integer('fournisseur_id')->unsigned()->index();
            $table->string('piece_depence')->unique();

            $table->string('description');
            $table->date('date');
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
        Schema::dropIfExists('factures');
    }
}
