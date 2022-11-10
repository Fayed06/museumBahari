<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderTicketsTable extends Migration
{
    public function up()
    {
        Schema::create('order_tickets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('email');
            $table->integer('jumlah_tiket');
            $table->date('tanggal_pemesanan');
            $table->boolean('valid')->default(0)->nullable();
            $table->string('status_tiket')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
