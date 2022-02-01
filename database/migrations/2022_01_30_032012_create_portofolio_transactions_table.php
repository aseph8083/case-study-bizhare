<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePortofolioTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('portofolio_transactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('portofolio_id')->index('portofolio_id_foreign');
            $table->integer('amount')->length(50);
            $table->integer('business_id')->index('business_id_foreign');
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
        Schema::dropIfExists('portofolio_transactions');
    }
}
