<?php

class User
{
    private $id;
    private $email;
    private $hashedPassword;
    private $description;
    private $isActive;

    
    public function __construct($id = -1, $email = "", $hashedPassword = "", $description = "", $isActive = false)
    {
        $this->id = $id;
        $this->email = $email;
        $this->hashedPassword = $hashedPassword;
        $this->description = $description;
        $this->isActive = $isActive;
    }
    
    public function getId()
    {
        return $this->id;
    }
    
    public function getEmail()
    {
        return $this->email;
    }
    
    public function setEmail($email)
    {
        $this->email = $email;
    }
    
    public function getHashedPassword()
    {
        return $this->hashedPassword;
    }
    
    public function setPassword($password)
    {
        $this->hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    }
    
    public function getDescription()
    {
        return $this->description;
    }
    
    public function setDescription($description)
    {
        $this->description = $description;
    }
    
    public function isUserActive()
    {
        return $this->isActive;
    }
    
    public function activate()
    {
        $this->isActive = true;
    }
    
    public function deactivate()
    {
        $this->isActive = false;
    }
    
    public function verifyPassword($password)
    {
        return password_verify($password, $this->hashedPassword);
    }

    public function save(mysqli $conn)
    {
        if (-1 === $this->id) {
            $query = "INSERT INTO users (email, hashedPassword, description, is_active)"
                . "VALUES ('{$this->email}', '{$this->hashedPassword}', '{$this->description}', '{$this->isActive}',)";
            $result = $conn->query($query);
            
            if(true === $result) {
                $this->id = $conn->insert_id;
                
                return true;
            } else {
                return false;
            }
        } else {
            $query = "UPDATE users SET "
                . "email = {$this->email}"
                . "hashedPassword = {$this->hashedPassword}"
                . "description = {$this->description}"
                . "is_active = {$this->isActive}"
                . "WHERE id={$this->id}";
            
            $result = $conn->query($query);
            
            return $result;
        }
    }

    public static function logIn(mysqli $conn, $email, $password)
    {
        $email = $conn->real_escape_string($email);
        $query = "SELECT * FROM users WHERE email='$email'";
        $result = $conn->query($query);
        if (true === $result) {
            if (1 == $result->num_rows) {
                $row = $result->fetch_assoc();
            } else {
                return false;
            }

            $user = new User(
                $row['id'],
                $row['email'],
                $row['hashed_password'],
                $row['descriprion'],
                $row['is_active']
            );

                return $user;
        }
    }

    public static function getAllUsers(mysqli $conn)
    {
        $query = 'SELECT * FROM users';
        
        $result = $conn->query($query);
        
        if (!$result) {
            die('Error: ' .$conn->error);
        }
        
        $users = [];
        
        foreach ($result as $user) {
            $userObj = new User(
                $user['id'],
                $user['email'],
                $user['hashed_password'],
                $user['descriprion'],
                $user['is_active']
            );
            
            $users[] = $userObj;
        }
        
        return $users;
    }
    
    public static function getUser(mysqli $conn, $id)
    {
        $id = $conn->real_escape_string($id);
        
        $query = "SELECT * FROM users WHERE id = $id";
        
        $result = $conn->query($query);
        
        if (!$result) {
            die('Error: ' . $conn->error);
        }
        
        if ($result->num_rows === 1) {
            $row = $result->fetch_assoc();
        } else {
            return null;
        }
        
        $user = new User(
            $row['id'],
            $row['email'],
            $row['hashed_password'],
            $row['descriprion'],
            $row['is_active']
            );
        
        return $user;
    }
}