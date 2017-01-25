<?php

namespace Artsper\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class for handling routes related to artwork
 */
class Artwork {

  private $request;
  private $app;
  private $em;

  public function add(Request $request, Application $app) {
    $this->em = $app['orm.em'];
    $this->request = $request;
    $this->app = $app;
    
    $response = array();

    try {
      
      // New artwork instance
      $artwork = new \Artsper\Entity\Artwork();
      
      // Populating artwork instance
      $artwork->setTitle($this->getTitle());
      $artwork->setBiography($this->getBiography());
      $artwork->setYear($this->getYear());
      $artwork->setPrice($this->getPrice());
      $artwork->setCertificated($this->getCertificated());
      $artwork->setFramed($this->getFramed());
      $artwork->setNumbered($this->getNumbered());
      $artwork->setArtist($this->getArtist());
      $artwork->setCategory($this->getCategory());
      $artwork->setGallery($this->getGallery());
      $artwork->setWidth($this->getWidth());
      $artwork->setHeight($this->getHeight());
      $artwork->setLength($this->getLength());
      
      // Saving artwork instance
      $this->em->persist($artwork);
      $this->em->flush();
      
      $response['success'] = 1;
      $response['artwork_id'] = $artwork->getId();
      
      return $app->json($response, 201);
      
    } catch(\Artsper\Exception\ValidationException $e) {
      
      $response['success'] = 0;
      $response['error'] = $e->getMessage();
      return $this->app->json($response);
      
    } catch(\Artsper\Exception\EntityNotFoundException $e) {
      
      $response['success'] = 0;
      $response['error'] = $e->getMessage();
      return $this->app->json($response, 404);
    }
  }

  /**
   * Get title from request
   * @return mixed
   */
  private function getTitle() {
    return $this->getField('title', 'Title must be provided');
  }

  /**
   * Get biography from request
   * @return mixed
   */
  private function getBiography() {
    return $this->getField('biography', 'Biography must be provided', false);
  }

  /**
   * Get year from request
   * @return mixed
   */
  private function getYear() {
    return $this->getField('year', 'Year must be provided');
  }

  /**
   * Get price from request
   * @return mixed
   */
  private function getPrice() {
    return $this->getField('price', 'Price must be provided');
  }
  
  /**
   * Get width from request
   * @return mixed
   */
  private function getWidth() {
    return $this->getField('width', 'Width must be provided');
  }
  
  /**
   * Get height from request
   * @return mixed
   */
  private function getHeight() {
    return $this->getField('height', 'Height must be provided');
  }
  
  /**
   * Get length from request
   * @return mixed
   */
  private function getLength() {
    return $this->getField('length', 'Length must be provided');
  }

  /**
   * Get certificated from request
   * @return mixed
   */
  private function getCertificated() {
    return $this->getField('certificated', '', false) ? : 0;
  }

  /**
   * Get framed from request
   * @return mixed
   */
  private function getFramed() {
    return $this->getField('framed', '', false) ? : 0;
  }

  /**
   * Get numbered from request
   * @return mixed
   */
  private function getNumbered() {
    return $this->getField('numbered', '', false) ? : 0;
  }

  /**
   * Get artist
   * @return \Artsper\Entity\Artist
   * @throws \Artsper\Exception\EntityNotFoundException
   */
  private function getArtist() {
    $artist_id = $this->getArtistId();
    $artist = $this->em->find('Artsper\Entity\Artist', $artist_id);
    if(!$artist) {
      throw new \Artsper\Exception\EntityNotFoundException('Artist not found');
    }
    return $artist;
  }

  /**
   * Get artist_id from request
   * @return mixed
   */
  private function getArtistId() {
    return $this->getField('artist_id', 'Artist must be provided');
  }

  /**
   * Get category
   * @return \Artsper\Entity\Category
   * @throws \Artsper\Exception\EntityNotFoundException
   */
  private function getCategory() {
    $category_id = $this->getCategoryId();
    $category = $this->em->find('Artsper\Entity\Category', $category_id);
    if(!$category) {
      throw new \Artsper\Exception\EntityNotFoundException('Category not found');
    }
    return $category;
  }

  /**
   * Get category_id from request
   * @return mixed
   */
  private function getCategoryId() {
    return $this->getField('category_id', 'Category must be provided');
  }

  /**
   * Get gallery
   * @return \Artsper\Entity\Gallery
   * @throws \Artsper\Exception\EntityNotFoundException
   */
  private function getGallery() {
    $gallery_id = $this->getGalleryId();
    $gallery = $this->em->find('Artsper\Entity\Gallery', $gallery_id);
    if(!$gallery) {
      throw new \Artsper\Exception\EntityNotFoundException('Gallery not found');
    }
    return $gallery;
  }

  /**
   * Get gallery_id from request
   * @return mixed
   */
  private function getGalleryId() {
    return $this->getField('gallery_id', 'Gallery must be provided');
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
