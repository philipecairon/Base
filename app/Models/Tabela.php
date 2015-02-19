<?php
    class Tabela extends ActiveRecord\Model{

        public static function record($args){
            self::create($args);
        }

        public static function delet($exemplo_id){
            $exemplo=self::find($exemplo_id);
            $exemplo->delete();
        }

    }