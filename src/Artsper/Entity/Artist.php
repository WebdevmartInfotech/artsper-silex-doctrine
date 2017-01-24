<?php

namespace Artsper\Entity;

/**
 * Artist
 *
 * @Table(name="artist")
 * @Entity()
 */
class Artist {

  /**
   * @Column(name="id", type="integer")
   * @Id
   * @GeneratedValue(strategy="IDENTITY")
   */
  private $id;

  /**
   * @Column(name="firstname", type="string", length=255, nullable=false)
   */
  private $firstname;
  
  /**
   * @Column(name="lastname", type="string", length=255, nullable=false)
   */
  private $lastname;
  
  /**
   * @Column(name="birthday", type="integer")
   */
  private $birthday;
  
  /**
   * @Column(name="biography", type="text")
   */
  private $biography;
  
  /**
   * Country
   * @ManyToOne(targetEntity="Country")
   * @JoinColumn(name="country_id", referencedColumnName="id") 
   */
  private $country;
  
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
   * Set firstname
   * @param string $firstname
   * @return \Artsper\Entity\Artist
   */
  public function setFirstname($firstname) {
    $this->firstname = $firstname;
    return $this;
  }
  
  /**
   * Get firstname
   * @return string
   */
  public function getFirstname() {
    return $this->firstname;
  }
  
  /**
   * Set lastname
   * @param string $lastname
   * @return \Artsper\Entity\Artist
   */
  public function setLastname($lastname) {
    $this->lastname = $lastname;
    return $this;
  }
  
  /**
   * Get lastname
   * @return string
   */
  public function getLastname() {
    return $this->lastname;
  }
  
  /**
   * Set birthday
   * @param string $birthday
   * @return \Artsper\Entity\Artist
   */
  public function setBirthday($birthday) {
    $this->birthday = $birthday;
    return $this;
  }
  
  /**
   * Get birthday
   * @return integer
   */
  public function getBirthday() {
    return $this->birthday;
  }
  
  /**
   * Set biography
   * @param string $biography
   * @return \Artsper\Entity\Artist
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
   * Get country
   * @return \Artsper\Entity\Country
   */
  public function getCountry() {
    return $this->country;
  }
  
  

}
