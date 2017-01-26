<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\ParameterBag;

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
