<?php

class Game_Guid {
    public $guid;
    
     function __construct() {
        $this->generate();
    }
    
    public function __toString() {
        return $this->guid;
    }
    
    protected function generate() {
        $this->guid = sprintf('%04X%04X-%04X-%04X-%04X-%04X%04X%04X', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));
    }
}

