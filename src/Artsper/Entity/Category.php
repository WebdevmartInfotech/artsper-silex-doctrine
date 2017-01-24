<?php

namespace Artsper\Entity;

/**
 * Category
 *
 * @Table(name="category")
 * @Entity()
 */
class Category {

  /**
   * @Column(name="id", type="integer")
   * @Id
   * @GeneratedValue(strategy="IDENTITY")
   */
  private $id;

  /**
   * @Column(name="label", type="string", length=100, nullable=false)
   */
  private $label;
  
  /**
   * @Column(name="seo_url", type="string", length=100, nullable=false)
   */
  private $seo_url;
  
  
  
  /**
   * __construct
   */
  function __construct() {
    
  }
  
  /**
   * Get id
   * @return int
   */
  public function getId() {
    return $this->id;
  }
  
  /**
   * Set label
   * @param string $label
   * @return \Artsper\Entity\Category
   */
  public function setLabel($label) {
    $this->label = $label;
    return $this;
  }
  
  /**
   * Get label
   * @return string
   */
  public function getLabel() {
    return $this->label;
  }
  
  /**
   * Set seo_url
   * @param string $url
   * @return \Artsper\Entity\Category
   */
  public function setSeoUrl($url) {
    $this->seo_url = $url;
    return $this;
  }
  
  /**
   * Get seo_url
   * @return string
   */
  public function getSeoUrl() {
    return $this->seo_url;
  }

}
