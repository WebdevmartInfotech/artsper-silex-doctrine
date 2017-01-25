<?php

namespace Artsper\Entity;

/**
 * Artwork
 *
 * @Table(name="artwork")
 * @Entity()
 */
class Artwork {

  /**
   * @Column(name="id", type="integer")
   * @Id
   * @GeneratedValue(strategy="IDENTITY")
   */
  private $id;

  /**
   * @Column(name="title", type="string", length=100, nullable=false)
   */
  private $title;

  /**
   * @Column(name="biography", type="text", nullable=true)
   */
  private $biography;

  /**
   * @Column(name="year", type="integer", nullable=false)
   */
  private $year;

  /**
   * @Column(name="price", type="float", nullable=false)
   */
  private $price;

  /**
   * @Column(name="certificated", type="boolean", options={"default":0})
   */
  private $certificated;

  /**
   * @Column(name="framed", type="boolean", options={"default":0})
   */
  private $framed;

  /**
   * @Column(name="numbered", type="boolean", options={"default":0})
   */
  private $numbered;
  
  /**
   * @Column(name="width", type="float", nullable=false)
   */
  private $width;
  
  /**
   * @Column(name="height", type="float", nullable=false)
   */
  private $height;
  
  /**
   * @Column(name="length", type="float", nullable=false)
   */
  private $length;

  /**
   * Artist
   * @ManyToOne(targetEntity="Artist")
   * @JoinColumn(name="artist_id", referencedColumnName="id") 
   */
  private $artist;

  /**
   * Category
   * @ManyToOne(targetEntity="Category")
   * @JoinColumn(name="category_id", referencedColumnName="id") 
   */
  private $category;

  /**
   * Gallery
   * @ManyToOne(targetEntity="Gallery")
   * @JoinColumn(name="gallery_id", referencedColumnName="id") 
   */
  private $gallery;

  /**
   * __construct
   */
  function __construct() {
    
  }

  /*
   * Get id
   * @return integer
   */
  public function getId() {
    return $this->id;
  }
  
  /**
   * Set title
   * @param string $title
   * @return \Artsper\Entity\Artwork
   */
  public function setTitle($title) {
    $this->title = $title;
    return $this;
  }
  
  /**
   * Get title
   * @return string
   */
  public function getTitle() {
    return $this->title;
  }

  /**
   * Set biography
   * @param string $biography
   * @return \Artsper\Entity\Artwork
   */
  public function setBiography($biography) {
    $this->biography = $biography;
    return $this;
  }
  
  /**
   * Get biography
   * @return string
   */
  public function getBiography() {
    return $this->biography;
  }
  
  /**
   * Set year
   * @param integer $year
   * @return \Artsper\Entity\Artwork
   */
  public function setYear($year) {
    $this->year = $year;
    return $this;
  }
  
  /**
   * Get year
   * @return integer
   */
  public function getYear() {
    return $this->year;
  }
  
  /**
   * Set price
   * @param float $price
   * @return \Artsper\Entity\Artwork
   */
  public function setPrice($price) {
    $this->price = $price;
    return $this;
  }
  
  /**
   * Get price
   * @return float
   */
  public function getPrice() {
    return $this->price;
  }
  
  /**
   * Set certificated
   * @param bool $certificated
   * @return \Artsper\Entity\Artwork
   */
  public function setCertificated($certificated) {
    $this->certificated = (bool)$certificated;
    return $this;
  }
  
  /**
   * Get certificated
   * @return bool
   */
  public function getCertificated() {
    return (bool)$this->certificated;
  }
  
  /**
   * Set framed
   * @param bool $framed
   * @return \Artsper\Entity\Artwork
   */
  public function setFramed($framed) {
    $this->framed = (bool)$framed;
    return $this;
  }
  
  /**
   * Get framed
   * @return bool
   */
  public function getFramed() {
    return (bool)$this->framed;
  }
  
  /**
   * Set numbered
   * @param bool $numbered
   * @return \Artsper\Entity\Artwork
   */
  public function setNumbered($numbered) {
    $this->numbered = (bool)$numbered;
    return $this;
  }
  
  /**
   * Get numbered
   * @return bool
   */
  public function getNumbered() {
    return (bool)$this->numbered;
  }
  
  /**
   * Set width
   * @param float $width
   * @return \Artsper\Entity\Artwork
   */
  public function setWidth($width) {
    $this->width = $width;
    return $this;
  }
  
  /**
   * Get width
   * @return float
   */
  public function getWidth() {
    return $this->width;
  }


  /**
   * Set height
   * @param float $height
   * @return \Artsper\Entity\Artwork
   */
  public function setHeight($height) {
    $this->height = $height;
    return $this;
  }
  
  /**
   * Get height
   * @return float
   */
  public function getHeight() {
    return $this->height;
  }
  
  /**
   * Set length
   * @param float $length
   * @return \Artsper\Entity\Artwork
   */
  public function setLength($length) {
    $this->length = $length;
    return $this;
  }
  
  /**
   * Get length
   * @return float
   */
  public function getLength() {
    return $this->length;
  }


  /**
   * Set artist
   * @param \Artsper\Entity\Artist $artist
   * @return \Artsper\Entity\Artwork
   */
  public function setArtist($artist) {
    $this->artist = $artist;
    return $this;
  }

  /**
   * Get artist
   * @return \Artsper\Entity\Artist
   */
  public function getArtist() {
    return $this->artist;
  }
  
  /**
   * Set category
   * @param \Artsper\Entity\Category $category
   * @return \Artsper\Entity\Artwork
   */
  public function setCategory($category) {
    $this->category = $category;
    return $this;
  }

  /**
   * Get category
   * @return \Artsper\Entity\Category
   */
  public function getCategory() {
    return $this->category;
  }
  
  /**
   * Set gallery
   * @param \Artsper\Entity\Gallery $gallery
   * @return \Artsper\Entity\Artwork
   */
  public function setGallery($gallery) {
    $this->gallery = $gallery;
    return $this;
  }

  /**
   * Get gallery
   * @return \Artsper\Entity\Gallery
   */
  public function getGallery() {
    return $this->gallery;
  }

  /**
   * Get all info as array
   * @return array
   */
  public function get() {
    return array(
      'id' => $this->getId(),
      'artist' => $this->getArtist()->get(),
      'category' => $this->getCategory()->get(),
      'gallery' => $this->getGallery()->get(),
    );
  }

}
