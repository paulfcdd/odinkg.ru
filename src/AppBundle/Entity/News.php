<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Traits\ImageTrait;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class News
 * @package AppBundle\Entity
 * @ORM\Entity
 * @ORM\Table(name="news")
 */
class News
{
    use ImageTrait;

    /**
     * @ORM\Id
     * @ORM\Column(name="id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \DateTime
     * @ORM\Column(name="date_created", type="datetime")
     */
    private $dateCreated;

    /**
     * @var \DateTime
     * @ORM\Column(name="date_updated", type="datetime", nullable=true)
     */
    private $dateUpdated;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="news")
     * @ORM\JoinColumn(name="author", referencedColumnName="id")
     */
    private $author;

    /**
     * @var string
     * @ORM\Column(name="content", type="string", length=2000)
     */
    private $content;

    /**
     * @var \DateTime
     * @ORM\Column(name="date_removed", type="datetime", nullable=true)
     */
    private $dateRemoved;

    /**
     * @var string
     * @ORM\Column()
     */
    private $title;

    public function __construct()
    {
        $this->dateCreated = new \DateTime();
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
     * Set dateCreated
     *
     * @param \DateTime $dateCreated
     *
     * @return News
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
     * @return News
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
     * Set author
     *
     * @param integer $author
     *
     * @return News
     */
    public function setAuthor($author)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get author
     *
     * @return integer
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Set content
     *
     * @param string $content
     *
     * @return News
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return News
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
     * Set dateRemoved
     *
     * @param \DateTime $dateRemoved
     *
     * @return News
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
}
