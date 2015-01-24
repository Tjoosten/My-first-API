<?php
  namespace Joosten\Api\functions;

  Class Errors {
    
    protected $api;
    
    __construct($api) {
      $this->api = $api;  
    }
    
    public function notFound() {
      return $this->api->render('404.php');
    }
  }
