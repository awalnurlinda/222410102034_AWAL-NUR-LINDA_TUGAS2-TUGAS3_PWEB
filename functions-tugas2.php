<?php
function admin_login_form() {
    include 'view/admin-panel/admin-login.php';
}

function admin_login_save($username, $password) {
    $valid_login = validasi($username, $password);
    if ($valid_login) {
        header("Location: dashboard.php");
        exit();
    }
    else {
        echo "Proses Login Gagal. Silahkan Periksa Kembali Username dan Password Anda.";
    }
    function validasi($username, $password) {
        $db = new mysqli("localhost", "username", "password", "database_name");
        if ($db->connect_error) {
            die("Connection failed: " . $db->connect_error);
        }
        $username = $db->real_escape_string($username);
        $password = $db->real_escape_string($password);
        $query = "SELECT * FROM user WHERE username = '$username'";
        $result = $db->query($query);
        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            if (password_verify($password, $user['password'])) {
            return true;
            }
            else {
            return false;
            }
        }
        else {
        return false;
        }
        $db->close();
    }
}

function admin_dashboard() {
    include 'view/admin-panel/admin-dashboard.php';
}

function customer_login_form() {
    include 'view/forms/customer-login.php';
}

function customer_login_save($username, $password) {
    $valid_login = validasi($username, $password);
    if ($valid_login) {
        header("Location: dashboard.php");
        exit();
    }
    else {
        echo "Proses Login Gagal. Silahkan Periksa Kembali Username dan Password Anda.";
    }
    function validasi($username, $password) {
        $db = new mysqli("localhost", "username", "password", "database_name");
        if ($db->connect_error) {
            die("Connection failed: " . $db->connect_error);
        }
        $username = $db->real_escape_string($username);
        $password = $db->real_escape_string($password);
        $query = "SELECT * FROM user WHERE username = '$username'";
        $result = $db->query($query);
        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            if (password_verify($password, $user['password'])) {
            return true;
            }
            else {
            return false;
            }
        }
        else {
        return false;
        }
        $db->close();
    }
}

function customer_register_form() {
    include 'view/forms/customer-register.php';
}

function customer_register_save($username, $password, $email) {
    $success = register($username, $password, $email);
    if ($success) {
        header("Location: login.php?status=success");
        exit();
    } else {
        echo "Proses Registrasi Gagal. Silahkan Coba Kembali.";
    }
    function register($username, $password, $email) {
        $db = new mysqli("localhost", "username", "password", "database_name");
        if ($db->connect_error) {
            die("Connection failed: " . $db->connect_error);
        }
        $username = $db->real_escape_string($username);
        $second_password = scnd_password($password, PASSWORD_DEFAULT);
        $email = $db->real_escape_string($email);
        $query = "INSERT INTO user (username, password, email) VALUES ('$username', '$second_password', '$email')";
        if ($db->query($query) === TRUE) {
            $db->close();
            return true;
        }
        else {
            echo "Error: " . $query . "<br>" . $db->error;
            $db->close();
            return false;
        }
    }        
}

function customer_profile() {
    include 'view/forms/customer-profile.php';
}

function customer_profile_edited($customer_id, $second_username, $second_email) {
    $success = edit($customer_id, $second_username, $second_email);
    if ($success) {
        header("Location: profile.php?action=edited");
        exit();
    } else {
        echo "Proses Edit Profil Gagal. Silahkan Coba Kembali.";
    }
    function edit($customer_id, $second_username, $second_email) {
        $db = new mysqli("localhost", "username", "password", "nama_database");
        if ($db->connect_error) {
            die("Connection failed: " . $db->connect_error);
        }
        $customer_id = $db->real_escape_string($customer_id);
        $second_username = $db->real_escape_string($second_username);
        $second_email = $db->real_escape_string($second_email);
        $query = "UPDATE user SET username = '$second_username', email = '$second_email' WHERE id = '$customer_id'";
        if ($db->query($query) === TRUE) {
            $db->close();
            return true;
        } else {
            echo "Error: " . $query . "<br>" . $db->error;
            $db->close();
            return false;
        }
    }
}

function home_index() {
    include 'view/shop/home.php';
}

function item_index() {
    include 'view/shop/home.php';
}

function item_show($id) {
    include 'view/shop/item.php';
}

function cart_index() {
    include 'view/shop/cart.php';
}

function order_index() {
    include 'view/shop/home.php';
}

function order_show($id) {
    include 'view/shop/order.php';
}

function contact_index() {
    include 'view/shop/contact.php';
}

function user_logout() {
    session_start();
    session_unset();
    session_destroy();
    header("Location: login.php?status=logged_out");
    exit();
}
?>