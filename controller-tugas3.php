<?php
class RoleController {
    static function getRoles($id) {
        $roles = []; 
        if ($id == 1) {
            $roles[] = "Admin";
        } elseif ($id == 2) {
            $roles[] = "Customer";
        }
        else {
        }
        header('Content-Type: application/json');
        echo json_encode($roles);
    }
}
?>