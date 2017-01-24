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
   * @Column(name="year", type="integer", nullable=true)
   */
  private $year;
  
  /**
   * @Column(name="price", type="float", nullable=true)
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

}
