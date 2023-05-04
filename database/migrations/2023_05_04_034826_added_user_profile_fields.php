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
        Schema::table('users', function (Blueprint $table) {
            $table->text('phoneno')->nullable()->after('email');
            $table->text('address')->nullable()->after('phoneno');
            $table->string('city')->nullable()->after('address');
            $table->string('state')->nullable()->after('city');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
           
                $table->dropColumn('phoneno');
                $table->dropColumn('address');
                $table->dropColumn('city');
                $table->dropColumn('state');
        });
    }
};
