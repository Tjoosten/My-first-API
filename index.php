<?php

  /**
   * --------------------------
   * @package My First Api
   * @author Tim Joosten
   * @license MIT License
   * @since 2015
   * --------------------------
   **/
  require 'vendor/autoload.php';

  use Joosten\Api\functions\Errors;
  use Joosten\Api\functions\Misc;
  $api    = new \Slim\Slim(array(
              'templates.path' => 'src/views',
              'log.enabled'    => true,
              'debug'          => true
            ));

  $errors = new Errors($api);
  $misc   = new Misc($api);
  $mysqli = new mysqli('localhost','root','2fU3g5Yn','sn1145_scouts');

  $api->notFound($errors->notFound());

  $api->get('/', $misc->frontPage());

  $api->get('/help', function() use($api) {
    if (php_sapi_name() == "cli") {
        echo '{"error": "CLI not supported"}';
    } else {
        $variables = [
          'title' => 'API | Help',
        ];

        $api->render('/help.php', $variables);
    }
  });

  $api->get('/get/users', function() use ($mysqli) {
    $query = $mysqli->query('SELECT * FROM users')
                    ->fetch_array(MYSQLI_ASSOC);

    if (count($query) == 0) {
        echo '{"error": "Could not get results from the database"}';
    } elseif (count($query) > 0) {
        echo '{"users": ' . json_encode($query) . '}';
    }
  });

  $api->get('/get/users/:id', function($id) use ($mysqli) {
    $query = $mysqli->query('SELECT * FROM users WHERE id = '. $id .'')
                    ->fetch_array(MYSQLI_ASSOC);

    if (count($query) == 0) {
        echo '{"error": "Could not get results from the database"}';
    } elseif(count($query) > 0) {
        echo '{"users": ' . json_encode($query) . '}';
    }
  });

  $api->delete('/delete/users/:id', function($id) use ($mysqli) {

  });

  // Bootstrap the API.
  $api->run();
