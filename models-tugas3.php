<?php
require_once 'conn.php';

class Students {
    static function selectById($id) {
        global $conn; 
        $statement = $conn->prepare("SELECT * FROM students WHERE id = $id");
        $statement->bind_param("i", $id);
        $statement->execute();
        $result = $statement->get_result();
        $student = $result->fetch_assoc();
        $statement->close();
        return $student;
    }
    static function selectWhere($clause) {
        global $conn;
        $statement = $conn->prepare("SELECT * FROM students WHERE $clause");
        $statement->execute();
        $result = $statement->get_result();
        $students = $result->fetch_all(MYSQLI_ASSOC);
        $statement->close();
        return $students;
    }
    static function updateById($id, $name, $email, $role_fk) {
        global $conn;
        $statement = $conn->prepare("UPDATE students SET name = $name, email = $email, role_fk = $role_fk WHERE id = $id");
        $statement->bind_param("ssii", $name, $email, $role_fk, $id);
        $statement->execute();
        $statement->close();
    }
    static function updateWhere($clause, $name, $email, $role_fk) {
        global $conn; 
        $statement = $conn->prepare("UPDATE students SET name = $name, email = $email, role_fk = $role_fk WHERE $clause");
        $statement->bind_param("ssi", $name, $email, $role_fk);
        $statement->execute();
        $statement->close();
    }
    static function deleteById($id) {
        global $conn;
        $statement = $conn->prepare("DELETE FROM students WHERE id = $id");
        $statement->bind_param("i", $id);
        $statement->execute();
        $statement->close();
    }
    static function deleteWhere($clause) {
        global $conn;
        $statement = $conn->prepare("DELETE FROM students WHERE $clause");
        $statement->execute();
        $statement->close();
    }
}
?>