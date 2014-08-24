<?php
/**
 * Description of User
 *
 * @author peter.pekarovic
 */
class Application_Model_User extends Game_Model_Database {
    
    const COL_ID_USER = 'id_user';
    const COL_NICKNAME = 'nickname';
    const COL_EMAIL = 'email';
    const COL_PASSWORD = 'password';
    const COL_PASSWORD_SALT = 'password_salt';
    const COL_ROLE = 'role';
    const COL_DATE_CREATED = 'date_created';
    const COL_LANGUAGE = 'language';
    
    public function __construct() {
        $this->storage = new Application_Model_DbTable_User();
        $this->modelName = 'User';
    }
    
    public function getNickname() {
        if(!isset($this->data[self::COL_NICKNAME])) {
            throw new Game_Model_Exception('Model: ' . $this->modelName . ' - '. self::COL_NICKNAME . ' not set');
        }
        
        return $this->data[self::COL_NICKNAME];
    }
    
    public function setNickname($nickname) {
        $this->data[self::COL_NICKNAME] = $nickname;
    }
    
    public function getIdUser() {
        if(!isset($this->data[self::COL_ID_USER])) {
            throw new Game_Model_Exception('Model: ' . $this->modelName . ' - '.self::COL_ID_USER . ' not set');
        }
        
        return $this->data[self::COL_ID_USER];
    }
    
    public function setIdUser($idUser) {
        $this->data[self::COL_ID_USER] = $idUser;
    }
    
    public function getEmail() {
        if(!isset($this->data[self::COL_EMAIL])) {
            throw new Game_Model_Exception('Model: ' . $this->modelName . ' - '. self::COL_EMAIL . ' not set');
        }
        
        return $this->data[self::COL_EMAIL];
    }
    
    public function setEmail($email) {
        $this->data[self::COL_EMAIL] = $email;
    }
    
    public function getPassword() {
        if(!isset($this->data[self::COL_PASSWORD])) {
            throw new Game_Model_Exception('Model: ' . $this->modelName . ' - '. self::COL_PASSWORD . ' not set');
        }
        
        return $this->data[self::COL_PASSWORD];
    }
    
    public function setPassword($password) {
        $this->data[self::COL_PASSWORD] = $password;
    }
    
    public function getPasswordSalt() {
        if(!isset($this->data[self::COL_PASSWORD_SALT])) {
            throw new Game_Model_Exception('Model: ' . $this->modelName . ' - '. self::COL_PASSWORD_SALT . ' not set');
        }
        
        return $this->data[self::COL_PASSWORD_SALT];
    }
    
    public function setPasswordSalt($passwordSalt) {
        $this->data[self::COL_PASSWORD_SALT] = $passwordSalt;
    }
    
    public function setRole($role) {
        $this->data[self::COL_ROLE] = $role;
    }
    
    public function getRole() {
        if(!isset($this->data[self::COL_ROLE])) {
            throw new Game_Model_Exception('Model: ' . $this->modelName . ' - '. self::COL_ROLE . ' not set');
        }
        
        return $this->data[self::COL_ROLE];
    }
    
    public function setDateCreated($dateCreated) {
        $this->data[self::COL_DATE_CREATED] = $dateCreated;
    }
    
    public function getDateCreated() {
        if(!isset($this->data[self::COL_DATE_CREATED])) {
            throw new Game_Model_Exception('Model: ' . $this->modelName . ' - '. self::COL_DATE_CREATED . ' not set');
        }
        
        return $this->data[self::COL_DATE_CREATED];
    }
    
    public function setLanguage($language) {
        $this->data[self::COL_LANGUAGE] = $language;
    }
    
    public function getLanguage() {
        if(!isset($this->data[self::COL_LANGUAGE])) {
            throw new Game_Model_Exception('Model: ' . $this->modelName . ' - '. self::COL_LANGUAGE . ' not set');
        }
        
        return $this->data[self::COL_LANGUAGE];
    }
    
}
