<?php

class Auth extends Model {

    public static function isAuth() {
        $auth = new Auth();

        if (isset($_SERVER['PHP_AUTH_USER'])) {
            $stmt = $auth->conn->prepare("SELECT * FROM Users WHERE login=:login AND pass=:pass");
            $stmt->execute([':login'=>$_SERVER['PHP_AUTH_USER'], ':pass'=>$_SERVER['PHP_AUTH_PW']]);

            if ($stmt->rowCount() > 0) return true;
        }

        header('WWW-Authenticate: Basic realm="Backend"');
        Server::errCode(401);
        return false;
    }
}
