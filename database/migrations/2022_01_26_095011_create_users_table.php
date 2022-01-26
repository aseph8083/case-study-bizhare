<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 100);
            $table->string('username', 50);
            $table->string('email', 50);
            $table->enum('role',array('admin','investor'));
            $table->string('religion',50);
            $table->string('phone',20);
            $table->enum('sex',array('Laki-Laki','Perempuan'));
            $table->string('work',100);
            $table->text('address',65535);
            $table->string('password',100);
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
        Schema::dropIfExists('users');
    }
}
