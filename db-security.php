<?php
  

    function findByUsernameOrEmail($username, $email)
    {
        $db = connexion();
        $sql = "SELECT * FROM user WHERE email = :email OR username = :username";
        $stmt = $db->prepare($sql);
        $stmt->execute([
            ":username" => $username,
            ":email"    => $email
        ]);
        return $stmt->fetch();
    }

    function insertUser($username, $email, $hash)
    {
        $db = connexion();
        $sql = "INSERT INTO user (username, email, password) VALUES (:u, :e, :p)";
        $stmt = $db->prepare($sql);
        return $stmt->execute([
            ":u" => $username,
            ":e" => $email,
            ":p" => $hash
        ]);
    }