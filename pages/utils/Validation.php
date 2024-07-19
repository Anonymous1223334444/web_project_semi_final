<?php
    class Validation{
        static function clean($str) {
            $str = trim($str);
            $str = stripcslashes($str);
            $str = htmlspecialchars($str);
            return $str;
        }

        static function prenom($str) {
            $prenom_regex = "/^([a-zA-Z' ]+)$/";
            if(preg_match($prenom_regex, $str)) {
                return true;
            } else return false;
            
        }

        static function titre($str) {
            $prenom_regex = "/^[a-zA-Z0-9 ]+$/";
            if(preg_match($prenom_regex, $str)) {
                return true;
            } else return false;
            
        }

        static function categorie($str) {
            $prenom_regex = "/^([a-zA-Z' ]+)$/";
            if(preg_match($prenom_regex, $str)) {
                return true;
            } else return false;
            
        }

        static function desc($str) {
            $prenom_regex = "/^([a-zA-Z' ]+)$/";
            if(preg_match($prenom_regex, $str)) {
                return true;
            } else return false;
            
        }

        static function isInteger($str) {
            $integer_regex = "/^-?\d+$/";
            if (preg_match($integer_regex, $str)) {
                return true;
            } else {
                return false;
            }
        }

        static function nom($str) {
            $nom_regex = "/^([a-zA-Z' ]+)$/";
            if(preg_match($nom_regex, $str)) {
                return true;
            } else return false;
            
        }

        static function email($str) {
            if(filter_var($str, FILTER_VALIDATE_EMAIL)) {
                return true;
            } else return false;
            
        }

        static function password($str) {
            $password_regex = "/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#+!@$%^&*-]).{4,}$/";
            if(preg_match($password_regex, $str))
                return true;
            else return false;
            
        }

        static function match($str1, $str2) {
            if($str1 === $str2) {
                return true;
            } else return false;
            
        }
    }
?>