<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade')
                ->comment('Define the user who opened the ticket');

            $table->unsignedBigInteger('property_id');
            $table->foreign('property_id')
                ->references('id')
                ->on('properties')
                ->onDelete('cascade')
                ->onUpdate('cascade')
                ->comment('Define the property');

            $table->unsignedBigInteger('assigned_landlord_id');
            $table->foreign('assigned_landlord_id')
                ->references('id')
                ->on('landlords')
                ->onDelete('cascade')
                ->onUpdate('cascade')
                ->comment('Define the landlord user assigned to the ticket');

            $table->string('title');

            $table->string('description' , 500);

            $table->tinyInteger('status')
                    ->default(0)
                    ->comment('0 : open , 1 : solved , 2 : closed , 3 : canceled ');

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
        Schema::dropIfExists('ticket');
    }
}
