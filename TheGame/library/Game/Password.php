<?php

/**
 * Description of Password
 *
 * @author peter.pekarovic
 */
class Game_Password {
    protected $password;
    protected $passwordEncrypted;
    protected $salt;
    
     function __construct($password, $salt = NULL) {
        if(is_null($salt)) {
           $guid = new Game_Guid();
           $salt = $guid->getGuid();
        }

        $this->setSalt($salt);
        $this->setPassword($password);
        $this->encrypt();
    }
    
    public function encrypt() {
        $this->passwordEncrypted =  sha1($this->getPassword() . $this->getSalt());
    }
    
    public function setSalt($salt) {
        $this->salt = $salt;
    }
    
    public function getSalt() {
        if(!isset($this->salt)) {
            throw new Game_Exception('Salt not set');
        }
        
        return $this->salt;
    }
    
    public function setPassword($password) {
        $this->password = $password;
    }
    
    public function getPassword() {
        if(!isset($this->password)) {
            throw new Game_Exception('Password not set');
        }
        
        return $this->password;
    }
    
    public function setPasswordEncrypted($passwordEncrypted) {
        $this->passwordEncrypted = $passwordEncrypted;
    }
    
    public function getPasswordEncrypted() {
        if(!isset($this->passwordEncrypted)) {
            throw new Game_Exception('Encrypted Password not set');
        }
        
        return $this->passwordEncrypted;
    }
}
