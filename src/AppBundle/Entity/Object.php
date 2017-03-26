<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity
 * @ORM\Table(name="object")
 */
class Object
{

    const TYPE = [
        'house' => 1,
        'plot' => 2
    ];

    const SALE_TYPE = [
        'Продажа' => 1,
        'Аренда' => 2
    ];

    /**
     * @ORM\Id
     * @ORM\Column(name="id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var integer
     * @ORM\Column(type="integer", length = 1)
     */
    private $type;

    /**
     * @var string
     * @ORM\Column(nullable=true)
     */
    private $highway;

    /**
     * @var string
     * @ORM\Column(nullable=true)
     */
    private $location;

    /**
     * @var string
     * @ORM\Column(length=1000, nullable=true)
     */
    private $plotDecription;

    /**
     * @var string
     * @ORM\Column(length=1000)
     */
    private $communications;

    /**
     * @var float
     * @ORM\Column(type="float", name="square", scale=4)
     */
    private $square;

    /**
     * @var float
     * @ORM\Column(type="float", name="price_per_unit", scale=4, nullable=true)
     */
    private $pricePerUnit;

    /**
     * @var float
     * @ORM\Column(type="float", name="total_price", scale=4, nullable=true)
     */
    private $totalPrice;


    /**
     * @var string
     * @ORM\Column()
     */
    private $title;

    /**
     * @var string
     * @ORM\Column(length=1000)
     */
    private $objectDescription;

    /**
     * @var string
     * @ORM\Column()
     */
    private $contactName;

    /**
     * @var string
     * @ORM\Column()
     */
    private $contactPhone;

    /**
     * @var string
     * @ORM\Column()
     */
    private $contactEmail;

    /**
     * @var \DateTime
     *
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(name="date_created", type="datetime")
     */
    private $dateCreated;

    /**
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $dateUpdated;

    /**
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $dateRemoved;

    /**
     * @var integer
     * @ORM\Column(type="integer", length = 1)
     */
    private $saleStatus;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="Image", mappedBy="id")
     */
    private $images;

    /**
     * Set id
     *
     * @param integer $id
     *
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

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
     * Set type
     *
     * @param boolean $type
     *
     * @return $this
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return boolean
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set highway
     *
     * @param string $highway
     *
     * @return $this
     */
    public function setHighway($highway)
    {
        $this->highway = $highway;

        return $this;
    }

    /**
     * Get highway
     *
     * @return string
     */
    public function getHighway()
    {
        return $this->highway;
    }

    /**
     * Set location
     *
     * @param string $location
     *
     * @return $this
     */
    public function setLocation($location)
    {
        $this->location = $location;

        return $this;
    }

    /**
     * Get location
     *
     * @return string
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * Set plotDecription
     *
     * @param string $plotDecription
     *
     * @return $this
     */
    public function setPlotDecription($plotDecription)
    {
        $this->plotDecription = $plotDecription;

        return $this;
    }

    /**
     * Get plotDecription
     *
     * @return string
     */
    public function getPlotDecription()
    {
        return $this->plotDecription;
    }

    /**
     * Set communications
     *
     * @param string $communications
     *
     * @return $this
     */
    public function setCommunications($communications)
    {
        $this->communications = $communications;

        return $this;
    }

    /**
     * Get communications
     *
     * @return string
     */
    public function getCommunications()
    {
        return $this->communications;
    }

    /**
     * Set square
     *
     * @param float $square
     *
     * @return $this
     */
    public function setSquare($square)
    {
        $this->square = $square;

        return $this;
    }

    /**
     * Get square
     *
     * @return float
     */
    public function getSquare()
    {
        return $this->square;
    }

    /**
     * Set pricePerUnit
     *
     * @param float $pricePerUnit
     *
     * @return $this
     */
    public function setPricePerUnit($pricePerUnit)
    {
        $this->pricePerUnit = $pricePerUnit;

        return $this;
    }

    /**
     * Get pricePerUnit
     *
     * @return float
     */
    public function getPricePerUnit()
    {
        return $this->pricePerUnit;
    }

    /**
     * Set totalPrice
     *
     * @param float $totalPrice
     *
     * @return $this
     */
    public function setTotalPrice($totalPrice)
    {
        $this->totalPrice = $totalPrice;

        return $this;
    }

    /**
     * Get totalPrice
     *
     * @return float
     */
    public function getTotalPrice()
    {
        return $this->totalPrice;
    }

    /**
     * Set objectDescription
     *
     * @param string $objectDescription
     *
     * @return $this
     */
    public function setObjectDescription($objectDescription)
    {
        $this->objectDescription = $objectDescription;

        return $this;
    }

    /**
     * Get objectDescription
     *
     * @return string
     */
    public function getObjectDescription()
    {
        return $this->objectDescription;
    }

    /**
     * Set contactName
     *
     * @param string $contactName
     *
     * @return $this
     */
    public function setContactName($contactName)
    {
        $this->contactName = $contactName;

        return $this;
    }

    /**
     * Get contactName
     *
     * @return string
     */
    public function getContactName()
    {
        return $this->contactName;
    }

    /**
     * Set contactPhone
     *
     * @param string $contactPhone
     *
     * @return $this
     */
    public function setContactPhone($contactPhone)
    {
        $this->contactPhone = $contactPhone;

        return $this;
    }

    /**
     * Get contactPhone
     *
     * @return string
     */
    public function getContactPhone()
    {
        return $this->contactPhone;
    }

    /**
     * Set contactEmail
     *
     * @param string $contactEmail
     *
     * @return $this
     */
    public function setContactEmail($contactEmail)
    {
        $this->contactEmail = $contactEmail;

        return $this;
    }

    /**
     * Get contactEmail
     *
     * @return string
     */
    public function getContactEmail()
    {
        return $this->contactEmail;
    }

    /**
     * Set dateCreated
     *
     * @param \DateTime $dateCreated
     *
     * @return $this
     */
    public function setDateCreated($dateCreated)
    {
        $this->dateCreated = $dateCreated;

        return $this;
    }

    /**
     * Get dateCreated
     *
     * @return \DateTime
     */
    public function getDateCreated()
    {
        return $this->dateCreated;
    }

    /**
     * Set dateUpdated
     *
     * @param \DateTime $dateUpdated
     *
     * @return $this
     */
    public function setDateUpdated($dateUpdated)
    {
        $this->dateUpdated = $dateUpdated;

        return $this;
    }

    /**
     * Get dateUpdated
     *
     * @return \DateTime
     */
    public function getDateUpdated()
    {
        return $this->dateUpdated;
    }

    /**
     * Set dateRemoved
     *
     * @param \DateTime $dateRemoved
     *
     * @return $this
     */
    public function setDateRemoved($dateRemoved)
    {
        $this->dateRemoved = $dateRemoved;

        return $this;
    }

    /**
     * Get dateRemoved
     *
     * @return \DateTime
     */
    public function getDateRemoved()
    {
        return $this->dateRemoved;
    }

    /**
     * Set saleStatus
     *
     * @param boolean $saleStatus
     *
     * @return $this
     */
    public function setSaleStatus($saleStatus)
    {
        $this->saleStatus = $saleStatus;

        return $this;
    }

    /**
     * Get saleStatus
     *
     * @return boolean
     */
    public function getSaleStatus()
    {
        return $this->saleStatus;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return string
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param int $typeId
     * @return mixed
     */
    public function getTypeById(int $typeId)
    {
        return array_search($typeId, self::TYPE);
    }

    /**
     * @param int $saleId
     * @return mixed
     */
    public function getSaleStatusById(int $saleId)
    {
        return array_search($saleId, self::SALE_TYPE);
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->images = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add image
     *
     * @param \AppBundle\Entity\Image $image
     *
     * @return Object
     */
    public function addImage(\AppBundle\Entity\Image $image)
    {
        $this->images[] = $image;

        return $this;
    }

    /**
     * Remove image
     *
     * @param \AppBundle\Entity\Image $image
     */
    public function removeImage(\AppBundle\Entity\Image $image)
    {
        $this->images->removeElement($image);
    }

    /**
     * Get images
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getImages()
    {
        return $this->images;
    }
}
