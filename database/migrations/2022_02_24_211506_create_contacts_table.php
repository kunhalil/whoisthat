<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->integer('company_id')->nullable()->index();
            $table->string('first_name', 25);
            $table->string('last_name', 25);
            $table->string('email', 50)->nullable();
            $table->string('phone', 50)->nullable();
            $table->string('address', 150)->nullable();
            $table->string('town_city', 50)->nullable();
            $table->string('region_county', 50)->nullable();
            $table->string('country_code', 2)->nullable();
            $table->string('post_code', 25)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('contact_notes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('contact_id');
            $table->text('note')->nullable();
            $table->timestamps();

            $table->foreign('contact_id')
                ->references('id')
                ->on('contacts');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contact_notes');
        Schema::dropIfExists('contacts');
    }
};
