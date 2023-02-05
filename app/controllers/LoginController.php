<?php

class LoginController extends Controller {
    public function index()
    {
        require_once __DIR__ . "/../views/login.php"; 
    }

    public function authenticate()
    {

    }
}