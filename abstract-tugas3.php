<?php
require_once 'config/config.php';
require_once 'config/conn.php';
require_once 'controller/functions.php';
require_once 'model/models.php';
require_once 'controller/student_controller.php';
require_once 'controller/role_controller.php';
abstract class basic {
    protected $conn;
    public function __construct($conn) {
        $this->conn = $conn;
    }
    abstract public function selectById($id);
    abstract public function selectWhere($clause);
    abstract public function updateById($id, $name, $email, $role_fk);
    abstract public function updateWhere($clause, $name, $email, $role_fk);
    abstract public function deleteById($id);
    abstract public function deleteWhere($clause);
}
class studentmodel extends basic {
    public function __construct($conn) {
        parent::__construct($conn);
    }
    public function selectById($id){
        $statement = $this->conn->prepare("SELECT * FROM students WHERE id = $id");
        $statement->bind_param("i", $id);
        $statement->execute();
        $result = $statement->get_result();
        $student = $result->fetch_assoc();
        $statement->close();
        return $student;
    }
    public function selectWhere($clause){
        $statement = $this->conn->prepare("SELECT * FROM students WHERE $clause");
        $statement->execute();
        $result = $statement->get_result();
        $student = $result->fetch_all(MYSQL_ASSOC);
        $statement->close();
        return $students;
    }
    public function updateById($id, $name, $email, $role_fk){
        $statement = $this->conn->prepare("UPDATE students SET name = $name, email = $email, role_fk = $email WHERE id = $email");
        $statement->bind_param("ssii", $name, $email, $role_fk, $id);
        $statement->execute();
        $statement->close();
    }
    public function updateWhere($clause, $name, $email, $role_fk){
        $statement = $this->conn->prepare("UPDATE students SET name = $name, email = $email, role_fk = $role_fk WHERE $clause");
        $statement->bind_param("ssii", $name, $email, $role_fk);
        $statement->execute();
        $statement->close();
    }
    public function deleteById($id){
        $stmt = $this->conn->prepare("DELETE FROM students WHERE id = $id");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();
    }
    public function deleteWhere($clause){
        $stmt = $this->conn->prepare("DELETE FROM students WHERE $clause");
        $stmt->execute();
        $stmt->close();
    }
}