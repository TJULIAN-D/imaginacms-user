<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UserAddAuditstampInAllTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
  
      Schema::table('roles', function (Blueprint $table) {
        $table->dropUnique('slug');
        $table->unique(['slug', 'organization_id']);
        $table->auditStamps();
      });
  
      Schema::table('users', function (Blueprint $table) {
        $table->dropUnique('email');
        $table->unique(['email', 'organization_id']);
        $table->auditStamps();
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
