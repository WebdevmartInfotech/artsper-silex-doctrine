<?php

namespace Artsper\Entity;

/**
 * Gallery
 *
 * @Table(name="gallery")
 * @Entity()
 */
class Gallery {

  /**
   * @Column(name="id", type="integer")
   * @Id
   * @GeneratedValue(strategy="IDENTITY")
   */
  private $id;

  /**
   * @Column(name="name", type="string", length=100, nullable=false)
   */
  private $name;
  
  /**
   * @Column(name="email", type="string", length=255, nullable=false)
   */
  private $email;
  
  
  
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
   * Set name
   * @param string $name
   * @return \Artsper\Entity\Gallery
   */
  public function setName($name) {
    $this->name = $name;
    return $this;
  }
  
  /**
   * Get name
   * @return string
   */
  public function getName() {
    return $this->name;
  }
  
  /**
   * Set email
   * @param string $email
   * @return \Artsper\Entity\Gallery
   */
  public function setEmail($email) {
    $this->email = $email;
    return $this;
  }
  
  /**
   * Get email
   * @return string
   */
  public function getEmail() {
    return $this->email;
  }
  
  /**
   * Get all info as array
   * @return array
   */
  public function get() {
    return array(
      'id' => $this->getId(),
      'name' => $this->getName(),
      'email' => $this->getEmail()
    );
  }

}
