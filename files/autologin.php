<?php

class Autologin
{
    function loginFormField($name, $heading, $value)
    {

        if ($name == "username" && !empty($_GET["username"])) {
            return "<input type='hidden' name='auth[username]' value='" . $_GET["username"] . "'>";
        }

        if ($name == "password" && !empty($_GET["password"])) {
            session_start();

            $_SESSION["_password"] = $_GET["password"];

            // delete the password from the URL
            $uri = $_SERVER['REQUEST_URI'];
            $uri = preg_replace('/&password=[^&]*/', '', $uri);
            $uri = preg_replace('/\?password=[^&]*/', '', $uri);
            header("Location: " . $uri);
        }

        if ($name == "password" && !empty($_SESSION["_password"])) {
            return "<input type='hidden' name='auth[password]' value='" . $_SESSION["_password"] . "'>";
        }
        if ($name == "db" && !empty($_GET["db"])) {
            return "<input type='hidden' name='auth[db]' value='" . $_GET["db"] . "'>";
        }

        if ($name == "server" && !empty($_GET["server"])) {
            return "<input type='hidden' name='auth[server]' value='" . $_GET["server"] . "'>";
        }

        if ($name == "driver" && !empty($_GET["driver"])) {
            return "<input type='hidden' name='auth[driver]' value='" . $_GET["driver"] . "'>";
        }
    }

    function loginForm()
    {
        if (empty($_GET["username"]) || empty($_GET["server"]) || empty($_GET["driver"]) || (empty($_GET["password"]) && empty($_SESSION["_password"]))) {
            echo "<h4>Missing parameters</h4><p>Return to database detail and try again.</p>";
            return true;
        }
        echo "<script " . nonce() . ">window.addEventListener('DOMContentLoaded', (event) => document.querySelector('#content > form').submit());</script>";
        echo "<h4>Logging in...</h4>";
    }
}

return new Autologin();
