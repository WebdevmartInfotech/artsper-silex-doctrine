<?php

namespace Artsper\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class for handling routes related to artwork
 */
class Artwork {

  private $request;
  private $app;
  private $em;
  private $response;

  /**
   * Method for setting class variables
   * @param Request $request
   * @param Application $app
   */
  private function init(Request $request, Application $app) {
    $this->em = $app['orm.em'];
    $this->request = $request;
    $this->app = $app;
    $this->response = array();
  }

  /**
   * Method for handling artwork addition
   * @param Request $request
   * @param Application $app
   * @return JsonResponse
   */
  public function add(Request $request, Application $app) {
    $this->init($request, $app);
    $params = $this->request->request->all();
    $constraint = $this->getConstraint('add');
    $errors = $app['validator']->validate($params, $constraint);
    if(count($errors) > 0) {
      $this->response['success'] = 0;
      $this->response['error'] = array();
      foreach($errors as $error) {
        $path = preg_replace("/(\[|\])/i", '', $error->getPropertyPath());
        $this->response['error'][$path] = $error->getMessage();
      }
      return $this->app->json($this->response, 400);
    }

    try {

      $artwork_id = $this->save($params);
      $this->response['success'] = 1;
      $this->response['artwork_id'] = $artwork_id;
      return $app->json($this->response, 201);
    } catch(\Artsper\Exception\EntityNotFoundException $e) {

      $this->response['success'] = 0;
      $this->response['error'] = $e->getMessage();
      return $this->app->json($this->response, 404);
    }
  }

  /**
   * Method for handling artwork editing
   * @param Request $request
   * @param Application $app
   * @return JsonResponse
   */
  public function edit(Request $request, Application $app) {
    $this->init($request, $app);
    $params = $this->request->request->all();
    $constraint = $this->getConstraint('edit');
    $errors = $app['validator']->validate($params, $constraint);
    if(count($errors) > 0) {
      $this->response['success'] = 0;
      $this->response['error'] = array();
      foreach($errors as $error) {
        $path = preg_replace("/(\[|\])/i", '', $error->getPropertyPath());
        $this->response['error'][$path] = $error->getMessage();
      }
      return $this->app->json($this->response, 400);
    }

    try {

      $artwork_id = $this->save($params);
      $this->response['success'] = 1;
      $this->response['artwork_id'] = $artwork_id;
      return $app->json($this->response, 200);
    } catch(\Artsper\Exception\EntityNotFoundException $e) {

      $this->response['success'] = 0;
      $this->response['error'] = $e->getMessage();
      return $this->app->json($this->response, 404);
    }
  }

  /**
   * Method for handling artwork deletion
   * @param Request $request
   * @param Application $app
   * @return JsonResponse
   */
  public function del(Request $request, Application $app) {
    $this->init($request, $app);
    $params = $this->request->request->all();
    $constraint = $this->getConstraint('del');
    $errors = $app['validator']->validate($params, $constraint);
    if(count($errors) > 0) {
      $this->response['success'] = 0;
      $this->response['error'] = array();
      foreach($errors as $error) {
        $path = preg_replace("/(\[|\])/i", '', $error->getPropertyPath());
        $this->response['error'][$path] = $error->getMessage();
      }
      return $this->app->json($this->response, 400);
    }

    try {
      $artwork = $this->getArtwork($params['artwork_id']);
      $this->em->remove($artwork);
      $this->em->flush();
      $this->response['success'] = 1;
      return $app->json($this->response, 200);
    } catch(\Artsper\Exception\EntityNotFoundException $e) {

      $this->response['success'] = 0;
      $this->response['error'] = $e->getMessage();
      return $this->app->json($this->response, 404);
    }
  }

  /**
   * Method for handling artwork search
   * @param Request $request
   * @param Application $app
   * @return JsonResponse
   */
  public function search(Request $request, Application $app) {
    $this->init($request, $app);
    $params = $this->request->request->all();
    $conditions = array();
    if(isset($params['category_id']) && $params['category_id']) {
      $conditions['category'] = $this->getCategory($params['category_id']);
    }
    $orders = array();
    $allowed_orders = array('ASC', 'DESC');
    if(isset($params['order']) && in_array(strtoupper($params['order']), $allowed_orders)) {
      $orders['price'] = strtoupper($params['order']);
    }
    $per_page = isset($params['per_page']) && $params['per_page'] ? (int)$params['per_page'] : 60;
    $page = isset($params['page']) && $params['page'] ? (int)$params['page'] : 1;
    $offset = ($page - 1) * $per_page;
    $repo = $this->em->getRepository('Artsper\Entity\Artwork');
    $artworks = $repo->findBy($conditions, $orders);
    $paginated_artworks = array_slice($artworks, $offset, $per_page);
    $this->response['success'] = 1;
    $this->response['artworks'] = array();
    foreach($paginated_artworks as $partwork) {
      $this->response['artworks'][] = $partwork->get();
    }
    $this->response['current_page'] = $page;
    $this->response['total_pages'] = ceil(count($artworks) / $per_page);
    $this->response['total_artworks'] = count($artworks);
    return $this->app->json($this->response, 200);
  }

  /**
   * Insert or update artwork entry
   * @param array $params
   * @return integer Id of artwork
   */
  private function save($params) {
    $artwork = (isset($params['artwork_id']) && $params['artwork_id']) ? $this->getArtwork($params['artwork_id']) : new \Artsper\Entity\Artwork();
    $artwork->setTitle($params['title']);
    $artwork->setBiography($params['biography']);
    $artwork->setYear($params['year']);
    $artwork->setPrice($params['price']);
    $artwork->setCertificated($params['certificated']);
    $artwork->setFramed($params['framed']);
    $artwork->setNumbered($params['numbered']);
    $artwork->setArtist($this->getArtist($params['artist_id']));
    $artwork->setCategory($this->getCategory($params['category_id']));
    $artwork->setGallery($this->getGallery($params['gallery_id']));
    $artwork->setWidth($params['width']);
    $artwork->setHeight($params['height']);
    $artwork->setLength($params['length']);
    $this->em->persist($artwork);
    $this->em->flush();
    return $artwork->getId();
  }

  /**
   * Set validation constraints for add/edit/del actions
   * @param string $action
   * @return \Symfony\Component\Validator\Constraints\Collection
   */
  private function getConstraint($action = 'add') {
    if($action == 'add' || $action == 'edit') {
      $collection = array(
        'title' => new Assert\NotBlank(),
        'biography' => new Assert\NotBlank(),
        'year' => array(new Assert\NotBlank(), new Assert\Type("integer"), new Assert\Length(array('min' => 4, 'max' => 4))),
        'price' => array(new Assert\NotBlank(), new Assert\Type("float")),
        'certificated' => array(new Assert\NotBlank(), new Assert\Type("integer"), new Assert\Length(array('min' => 0, 'max' => 1))),
        'framed' => array(new Assert\NotBlank(), new Assert\Type("integer"), new Assert\Length(array('min' => 0, 'max' => 1))),
        'numbered' => array(new Assert\NotBlank(), new Assert\Type("integer"), new Assert\Length(array('min' => 0, 'max' => 1))),
        'width' => array(new Assert\NotBlank(), new Assert\Type("float")),
        'height' => array(new Assert\NotBlank(), new Assert\Type("float")),
        'length' => array(new Assert\NotBlank(), new Assert\Type("float")),
        'artist_id' => array(new Assert\NotBlank(), new Assert\Type("integer")),
        'category_id' => array(new Assert\NotBlank(), new Assert\Type("integer")),
        'gallery_id' => array(new Assert\NotBlank(), new Assert\Type("integer")),
      );
    } else if($action == 'del') {
      $collection = array();
    }
    if($action == 'edit' || $action == 'del') {
      $collection['artwork_id'] = array(new Assert\NotBlank(), new Assert\Type("integer"), new Assert\Range(array('min' => 1)));
    }
    return new Assert\Collection($collection);
  }

  /**
   * Get artist
   * @param integer $artist_id
   * @return \Artsper\Entity\Artist
   * @throws \Artsper\Exception\EntityNotFoundException
   */
  private function getArtist($artist_id) {
    $artist = $this->em->find('Artsper\Entity\Artist', $artist_id);
    if(!$artist) {
      throw new \Artsper\Exception\EntityNotFoundException('Artist not found');
    }
    return $artist;
  }

  /**
   * Get category
   * @param integer $category_id
   * @return \Artsper\Entity\Category
   * @throws \Artsper\Exception\EntityNotFoundException
   */
  private function getCategory($category_id) {
    $category = $this->em->find('Artsper\Entity\Category', $category_id);
    if(!$category) {
      throw new \Artsper\Exception\EntityNotFoundException('Category not found');
    }
    return $category;
  }

  /**
   * Get gallery
   * @param integer $gallery_id
   * @return \Artsper\Entity\Gallery
   * @throws \Artsper\Exception\EntityNotFoundException
   */
  private function getGallery($gallery_id) {
    $gallery = $this->em->find('Artsper\Entity\Gallery', $gallery_id);
    if(!$gallery) {
      throw new \Artsper\Exception\EntityNotFoundException('Gallery not found');
    }
    return $gallery;
  }

  /**
   * 
   * @param integer $artwork_id
   * @return \Artsper\Entity\Artwork
   * @throws \Artsper\Exception\EntityNotFoundException
   */
  private function getArtwork($artwork_id) {
    $artwork = $this->em->find('Artsper\Entity\Artwork', $artwork_id);
    if(!$artwork) {
      throw new \Artsper\Exception\EntityNotFoundException('Artwork not found');
    }
    return $artwork;
  }

  /**
   * Get field value from request
   * @param string $field Fieldname
   * @param string $message Error message
   * @param bool $required Whether the field is required
   * @return mixed
   * @throws \Artsper\Exception\ValidationException
   */
  private function getField($field, $message = '', $required = true) {
    $value = $this->request->request->get($field);
    if($required && !$value) {
      throw new \Artsper\Exception\ValidationException($message);
    }
    return $value;
  }

}
