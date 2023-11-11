<?php
require_once 'functions-tugas2.php'; 
$current_path = $_SERVER['REQUEST_URL'];
$path_parts = explode('/', $curren_path);
$action = end($path_parts);

switch ($action) {
    case 'admin':
        if ($_GET['loggedIn'] == 'true') {
            admin_dashboard();
        }
        else {
            admin_login_form();
        }
        break;
    case 'login':
        if ($_GET['status'] == 'true') {
            admin_login_save();
        }
        else {
            admin_login_form();
        }
        break;
    case 'register':
        if ($_GET['action'] == 'save') {
            customer_register_save();
        }     
        else {
            customer_register_form();
        } 
        break;
    case 'profile':
        if ($_GET[action] == 'edited') {
            customer_profile_edited();
        }
        else {
            customer_profile();
        }
        break;
    case 'home':
        home_index();
        break;
    case 'item':
        $id = $_GET['id'];
        if($id) {
            item_show($id);
        }
        else {
            item_index();
        }
        break;
    case 'cart':
        cart_index();
        break;
    case 'order':
        $id = $_GET['id'];
        if ($id) {
            order_show($id);
        }
        else {
            order_index();
        }
        break;
    case 'contact':
        contact_index();
        break;
    case 'logout':
        user_logout();
        break;
    default:
        home_index();
}
?>