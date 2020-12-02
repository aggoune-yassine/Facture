<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->integer('structure_id')->nullable();

           
            $table->integer('facture_id')->unsigned()->index();
            $table->integer('commande_id')->nullable();
            $table->integer('budget_id')->unsigned();
            $table->text('description');
            $table->unsignedInteger('date_achat');
            $table->double('unit_price',14,2)->unsigned();
            $table->string('file',100)->nullable();
            $table->string('structure',10)->nullable();

          //  $table->integer('qty')->unsigned();
           
          
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
        Schema::dropIfExists('products');
    }
}
