<?php
  namespace Joosten\Api\functions;

  Class Misc {

    protected $api;

    function __construct($api) {
      $this->api = $api;
    }

    public function frontPage() {
      if (php_sapi_name() == "cli") {
        echo '{"Info": "This highly trained monkey is working"}';
      } else {
        $variables = [
          'Title'    => ' API | Home'
        ];

        $this->api->render('/home.php', $variables);
      }
    }
  }
