<?php
    
use Illuminate\Database\Capsule\Manager as Capsule;
    

    
Capsule::schema()->create('users', function ($table) 
{    
    $table->increments('user_id');
    $table->string('user_firstname');
    $table->string('user_lastname');
    $table->string('user_email');
    $table->string('user_password');
    $table->timestamps();
    
});
