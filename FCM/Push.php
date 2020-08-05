<?php

class Push {

    private $title;
    private $message;
    private $image;
    private $fbs_type;

    function __construct() {
        
    }

    function setTitle($title) {
        $this->title = $title;
    }

    function setMessage($message) {
        $this->message = $message;
    }

    function setImage($image) {
        $this->image = $image;
    }

    function setFbs_type($fbs_type) {
        $this->fbs_type = $fbs_type;
    }

    
    public function getPush() {
        $res = array();
        $res['data']['title'] = $this->title;
        $res['data']['message'] = $this->message;
        $res['data']['image'] = $this->image;
        $res['data']['timestamp'] = date('Y-m-d G:i:s');
        $res['data']['fbs_type'] = $this->fbs_type;
        return $res;
    }

}
