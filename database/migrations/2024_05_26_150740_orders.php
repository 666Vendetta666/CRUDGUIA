<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id'); // llave primaria de pedidos
            $table->bigInteger('client_id')->unsigned(); // llave forenea con relacion id clientes
            $table->string('items', 40);
            $table->string('brands', 40);
            $table->string('image')->nullable();
            $table->string('amounts', 40);
            $table->integer('prices');
            $table->timestamps();
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade'); // creacion llave foreanea en clientes con id 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
