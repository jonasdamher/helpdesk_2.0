<?php

declare(strict_types=1);
 
class Menu
{

    public static function check(): bool
    {
        return isset($_SESSION) && isset($_SESSION['menu']);
    }

    public static function active(string $controller, string $action = 'index'): string
    {
        if ($_GET['controller'] != $controller || $_GET['action'] != $action) {
            return '';
        }
        return 'active';
    }
}
