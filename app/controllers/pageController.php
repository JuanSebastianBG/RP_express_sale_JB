<?php
class PageController {

    public function __construct(PDO $conn) {

    }

    // Vista inicio
    public function home(){
        $title = "Inicio";
        $content = __DIR__ . "/../views/pages/home.view.php";

        require_once(__DIR__ . "/../views/layouts/app.layout.php");
    }
    
    // Vista login

    // Vista register

    // Vista recover_password

    // Vista reset_password

    // Vista producto

    // Vista vendedor

    // Vista dasboards


    // Funcion para crear links
    public function buildQueryString($add = [], $remove = [])
    {
        $queryString = '?';
        foreach ($_GET as $key => $param) {
            if (!in_array($key, $remove) && !array_key_exists($key, $add)) {
                $queryString .= $key . '=' . $param . '&';
            }
        }
        foreach ($add as $key => $param) {
            $queryString .= $key . '=' . $param . '&';
        }
        return rtrim($queryString, '&');
    }
}