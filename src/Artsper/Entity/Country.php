<?php

namespace Artsper\Entity;

/**
 * Country
 *
 * @Table(name="country")
 * @Entity()
 */
class Country {

  /**
   * @Column(name="id", type="integer")
   * @Id
   * @GeneratedValue(strategy="IDENTITY")
   */
  private $id;

  /**
   * @Column(name="lbl_fr", type="string", length=100, nullable=false)
   */
  private $lbl_fr;
  
  /**
   * @Column(name="lbl_en", type="string", length=100, nullable=false)
   */
  private $lbl_en;
  
  /**
   * @Column(name="url_fr", type="string", length=100, nullable=false)
   */
  private $url_fr;
  
  /**
   * @Column(name="url_en", type="string", length=100, nullable=false)
   */
  private $url_en;
  
  
  
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
   * Set lbl_fr
   * @param string $lbl
   * @return \Artsper\Entity\Country
   */
  public function setLblFr($lbl) {
    $this->lbl_fr = $lbl;
    return $this;
  }
  
  /**
   * Get lbl_fr
   * @return string
   */
  public function getLblFr() {
    return $this->lbl_fr;
  }
  
  /**
   * Set lbl_en
   * @param string $lbl
   * @return \Artsper\Entity\Country
   */
  public function setLblEn($lbl) {
    $this->lbl_en = $lbl;
    return $this;
  }
  
  /**
   * Get lbl_en
   * @return string
   */
  public function getLblEn() {
    return $this->lbl_en;
  }
  
  /**
   * Set url_fr
   * @param string $url
   * @return \Artsper\Entity\Country
   */
  public function setUrlFr($url) {
    $this->url_fr = $url;
    return $this;
  }
  
  /**
   * Get url_fr
   * @return string
   */
  public function getUrlFr() {
    return $this->url_fr;
  }
  
  /**
   * Set url_en
   * @param string $url
   * @return \Artsper\Entity\Country
   */
  public function setUrlEn($url) {
    $this->url_fr = $url;
    return $this;
  }
  
  /**
   * Get url_en
   * @return string
   */
  public function getUrlEn() {
    return $this->url_en;
  }
  
  
  
  
  

}
