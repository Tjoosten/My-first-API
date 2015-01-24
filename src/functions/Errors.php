<?php
  namespace Joosten\Api\functions;

  Class Errors {
    public function notFound() {
      return $api->render('404.php');
    }
  }
