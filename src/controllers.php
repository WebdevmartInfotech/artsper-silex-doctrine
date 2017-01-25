<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\ParameterBag;


$app->post('/find', function(Request $request) use ($app) {
  // Route for search functionalities
});

/**
 * Route for adding artwork
 */
$app->post('/artwork/add', 'Artsper\Controller\Artwork::add');


/*
 * Before middleware to handle json body of request
 */
$app->before(function(Request $request) {
  if(0 === strpos($request->headers->get('Content-Type'), 'application/json')) {
    $data = json_decode($request->getContent(), true);
    $request->request->replace(is_array($data) ? $data : array());
  } else {
    
  }
});

return $app;
