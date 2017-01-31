<?php

namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class ServicePage
 * @ORM\Entity
 * @ORM\Table(name="service_pages")
 */
class ServicePage
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column()
     */
    private $slug;

    /**
     * @var string
     * @ORM\Column()
     */
    private $title;

    /**
     * @var string
     * @ORM\Column(name="keywords", type="text", length=1000)
     */
    private $keywords;

    /**
     * @var string
     * @ORM\Column(name="description", type="text", length=1000)
     */
    private $description;

    /**
     * @var string
     * @ORM\Column()
     */
    private $pageTitle;

    /**
     * @var string
     * @ORM\Column()
     */
    private $pageSecondaryTitle;

    /**
     * @var string
     * @ORM\Column(name="page_content", type="text", length=10000)
     */
    private $pageContent;

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
     * Set slug
     *
     * @param string $slug
     *
     * @return ServicePage
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return ServicePage
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
     * Set keywords
     *
     * @param string $keywords
     *
     * @return ServicePage
     */
    public function setKeywords($keywords)
    {
        $this->keywords = $keywords;

        return $this;
    }

    /**
     * Get keywords
     *
     * @return string
     */
    public function getKeywords()
    {
        return $this->keywords;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return ServicePage
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set pageTitle
     *
     * @param string $pageTitle
     *
     * @return ServicePage
     */
    public function setPageTitle($pageTitle)
    {
        $this->pageTitle = $pageTitle;

        return $this;
    }

    /**
     * Get pageTitle
     *
     * @return string
     */
    public function getPageTitle()
    {
        return $this->pageTitle;
    }

    /**
     * Set pageSecondaryTitle
     *
     * @param string $pageSecondaryTitle
     *
     * @return ServicePage
     */
    public function setPageSecondaryTitle($pageSecondaryTitle)
    {
        $this->pageSecondaryTitle = $pageSecondaryTitle;

        return $this;
    }

    /**
     * Get pageSecondaryTitle
     *
     * @return string
     */
    public function getPageSecondaryTitle()
    {
        return $this->pageSecondaryTitle;
    }

    /**
     * Set pageContent
     *
     * @param string $pageContent
     *
     * @return ServicePage
     */
    public function setPageContent($pageContent)
    {
        $this->pageContent = $pageContent;

        return $this;
    }

    /**
     * Get pageContent
     *
     * @return string
     */
    public function getPageContent()
    {
        return $this->pageContent;
    }
}
