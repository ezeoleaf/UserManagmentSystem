<?php
session_start();
class Session {

    public function destroy() {
        $_SESSION = array();
        session_destroy();
    }

    public function set($key, $val) {
        $_SESSION[$key] = $val;
    }

    public function get($key) {
        return $_SESSION[$key];
    }
    
    public function isLogged() {
        $arr = array();
        $isLogged = true;
        if(!isset($_SESSION['id'])) {
            $isLogged = false;
        } else {
            if(empty($_SESSION['id'])) {
                $isLogged = false;
            }
        }

        if(!$isLogged) {
            $this->destroy();
        }

        $arr['success'] = $isLogged;

        return $arr;
    }
} 

?>