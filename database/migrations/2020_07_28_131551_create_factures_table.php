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
            $table->string('paye');
            $table->integer('user_id')->unsigned()->index();
            $table->integer('fournisseur_id')->unsigned()->index();

            $table->string('Piece_depense')->unique()->nullable();
            $table->string('facture')->unique()->nullable();
         
            $table->string('Bon_de_livraison')->unique()->nullable();
            $table->string('Ordre_de_service')->unique()->nullable();
            $table->string('Bon_de_commande')->unique()->nullable();
            $table->string('Caution')->unique()->nullable();
            $table->string('Pv_reception_provisoire')->unique()->nullable();
            $table->string('Pv_de_reception')->unique()->nullable();
            $table->string('Contrat')->unique()->nullable();
            $table->string('proforma')->unique()->nullable();

          

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
