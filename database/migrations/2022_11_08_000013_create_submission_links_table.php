<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubmissionLinksTable extends Migration
{
    public function up()
    {
        Schema::create('submission_links', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('link');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
