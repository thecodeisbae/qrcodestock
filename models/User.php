<?php
    
    namespace thecodeisbae\Model;
    use Illuminate\Database\Eloquent\Model as Eloquent;

    class User extends Eloquent
    {
        protected $guarded = [];
        protected $primaryKey = "user_id";

    }