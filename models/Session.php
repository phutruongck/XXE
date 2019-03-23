<?php
class Session
{
    public function send($id_user) {
        $_SESSION['ID_USER'] = $id_user;
    }

    public function start() {
        session_start();
    }

    public function get() {
        if(isset($_SESSION['ID_USER'])) {
            $id_user = $_SESSION['ID_USER'];
        }
        else {
            $id_user = '';
        }
        return $id_user;
    }

    public function destroy() {
        session_destroy();
    }
}
?>