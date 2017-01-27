<?php

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;

/**
 * Route for adding artwork
 */
$app->post('/artwork/add', 'Artsper\Controller\Artwork::add');

/**
 * Route for editing artwork
 */
$app->post('/artwork/edit', 'Artsper\Controller\Artwork::edit');

/**
 * Route for deleting artwork
 */
$app->post('/artwork/del', 'Artsper\Controller\Artwork::del');

/**
 * Route for searching artworks
 */
$app->post('/artwork/search', 'Artsper\Controller\Artwork::search');

/**
 * Before middleware to handle json body of request
 */
$app->before(function(Request $request, Application $app) {
  if(0 === strpos($request->headers->get('Content-Type'), 'application/json')) {
    $data = json_decode($request->getContent(), true);
    $request->request->replace(is_array($data) ? $data : array());
  } else {
    $response = array(
      'success' => 0,
      'error' => 'Content-Type header must be set to application/json'
    );
    return $app->json($response, 400);
  }
});

return $app;
