<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
class CreateSocialAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('social_accounts', function (Blueprint $table) {
            $table->unsignedInteger('user_id');
            $table->string("provider");
            $table->string("provider_user_id");
            $table->timestamps();

            //chaque user peut avoir un seul compte google+ et un seul compte facebook etc
            $table->unique(['user_id', 'provider']);
            
            $table->foreign("user_id")->references("id")->on("users")->onDelete('cascade');
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('social_accounts');
    }
}