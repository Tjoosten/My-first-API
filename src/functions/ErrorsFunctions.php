<?php
  namespace Functions\Api\Errors;

  Class ErrorsFunctions {

    protected $api;

    function __construct($api) {
      $this->api = $api;
    }

    public function notFound() {
      return $this->api->render('404.php');
    }
  }
