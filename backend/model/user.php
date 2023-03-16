<?php
class User
{
    protected $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function createUser($psw, $nickname)
    {
        $sql = "INSERT INTO `user` (pw, nickname, active)
                VALUES (?, ?, 1);";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('ss', $psw, $nickname);
        return $stmt->execute();
    }

    public function login($nickname, $psw)
    {
        $sql = sprintf("SELECT id FROM `user` WHERE nickname = '%s' AND pw = '%s';",
        $this->conn->real_escape_string($nickname), $psw);

        return $this->conn->query($sql);
    }

    public function getUser($id)
    {
        $sql = "SELECT id, nickname FROM `user` WHERE id = ". $this->conn->real_escape_string($id) .";";

        return $this->conn->query($sql);
    }

    public function getArchiveUsers()
    {
        $sql = "SELECT id, nickname FROM `user`";

        return $this->conn->query($sql);
    }

    public function getActiveUsers()
    {
        $sql = "SELECT id, nickname FROM `user` WHERE active = 1";

        return $this->conn->query($sql);
    }

    public function deleteUser($id)
    {
        $sql = "UPDATE `user`
                SET active = 0
                WHERE id = ?";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('i', $id);
        if ($stmt->execute() && $stmt->affected_rows > 0)
            return $stmt;
        else
            return "";
    }

    public function activeteUser($id)
    {
        $sql = "UPDATE `user`
                SET active = 1
                WHERE id = ?";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('i', $id);
        if ($stmt->execute() && $stmt->affected_rows > 0)
            return $stmt;
        else
            return "";
    }
}
?>