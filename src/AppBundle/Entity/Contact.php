<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Contact
 * @package AppBundle\Entity
 * @ORM\Entity
 * @ORM\Table(name="contact")
 */
class Contact
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column()
     */
    private $streetName;

    /**
     * @var string
     * @ORM\Column()
     */
    private $route;

    /**
     * @var string
     * @ORM\Column()
     */
    private $locality;

    /**
     * @var string
     * @ORM\Column()
     */
    private $state;

    /**
     * @var string
     * @ORM\Column()
     */
    private $adminLevel1;

    /**
     * @var string
     * @ORM\Column()
     */
    private $email;

    /**
     * @var string
     * @ORM\Column()
     */
    private $phone1;

    /**
     * @var string
     * @ORM\Column(nullable=true)
     */
    private $phone2;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set streetName
     *
     * @param string $streetName
     *
     * @return Contact
     */
    public function setStreetName($streetName)
    {
        $this->streetName = $streetName;

        return $this;
    }

    /**
     * Get streetName
     *
     * @return string
     */
    public function getStreetName()
    {
        return $this->streetName;
    }

    /**
     * Set route
     *
     * @param string $route
     *
     * @return Contact
     */
    public function setRoute($route)
    {
        $this->route = $route;

        return $this;
    }

    /**
     * Get route
     *
     * @return string
     */
    public function getRoute()
    {
        return $this->route;
    }

    /**
     * Set locality
     *
     * @param string $locality
     *
     * @return Contact
     */
    public function setLocality($locality)
    {
        $this->locality = $locality;

        return $this;
    }

    /**
     * Get locality
     *
     * @return string
     */
    public function getLocality()
    {
        return $this->locality;
    }

    /**
     * Set state
     *
     * @param string $state
     *
     * @return Contact
     */
    public function setState($state)
    {
        $this->state = $state;

        return $this;
    }

    /**
     * Get state
     *
     * @return string
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * Set adminLevel1
     *
     * @param string $adminLevel1
     *
     * @return Contact
     */
    public function setAdminLevel1($adminLevel1)
    {
        $this->adminLevel1 = $adminLevel1;

        return $this;
    }

    /**
     * Get adminLevel1
     *
     * @return string
     */
    public function getAdminLevel1()
    {
        return $this->adminLevel1;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Contact
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set phone1
     *
     * @param string $phone1
     *
     * @return Contact
     */
    public function setPhone1($phone1)
    {
        $this->phone1 = $phone1;

        return $this;
    }

    /**
     * Get phone1
     *
     * @return string
     */
    public function getPhone1()
    {
        return $this->phone1;
    }

    /**
     * Set phone2
     *
     * @param string $phone2
     *
     * @return Contact
     */
    public function setPhone2($phone2)
    {
        $this->phone2 = $phone2;

        return $this;
    }

    /**
     * Get phone2
     *
     * @return string
     */
    public function getPhone2()
    {
        return $this->phone2;
    }
}
