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
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->boolean('admin')->default(false);
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });




        DB::table('users')->insert(
            [
                [
                    'name' => 'Badr Azougagh',
                    'email' => 'badr.azougagh@example.com',
                    'admin' => true,
                    'password' => Hash::make('admin1234'),
                    'created_at' => now(),
                    'email_verified_at' => now()
                ],
                [
                    'name' => 'Steffe Pans',
                    'email' => 'steffe.pans@example.com',
                    'admin' => true,
                    'password' => Hash::make('admin1234'),
                    'created_at' => now(),
                    'email_verified_at' => now()
                ],
                [
                    'name' => 'Brent Verlinden',
                    'email' => 'brent.verlinden@example.com',
                    'admin' => true,
                    'password' => Hash::make('admin1234'),
                    'created_at' => now(),
                    'email_verified_at' => now()
                ],
                [
                    'name' => 'Rutger Stessens',
                    'email' => 'rutger.stessens@example.com',
                    'admin' => false,
                    'password' => Hash::make('user1234'),
                    'created_at' => now(),
                    'email_verified_at' => now()
                ]
            ]
        );




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
