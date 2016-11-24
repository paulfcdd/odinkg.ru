<?php
namespace OdinKgBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\ Entity
 * @ORM\ Table(name="pages")
 */
class Page
{
	/**
	 * @ORM\ Column(type="integer")
	 * @ORM\ Id
	 * @ORM\ GeneratedValue(strategy="AUTO")
	 */
	private $id;

	/**
	 * @ORM\Column(type="string", length=255)\
	 */
	private $pattern;

	/**
	 * @ORM\Column(type="string", length=255)\
	 */
	private $routeName;

	/**
	 * @ORM\Column(type="string", length=255)\
	 */
	private $pageName;

	/**
	 * @ORM\Column(type="string", length=255)\php
	 */
	private $title;

	/**
	 * @ORM\Column(type="string", length=255)\
	 */
	private $description;

	/**
	 * @ORM\Column(type="text")\
	 */
	private $keywords;

	/**
	 * @ORM\Column(type="boolean", length=1)\
	 */
	private $showInTop;

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
     * Set pattern
     *
     * @param string $pattern
     *
     * @return Page
     */
    public function setPattern($pattern)
    {
        $this->pattern = $pattern;

        return $this;
    }

    /**
     * Get pattern
     *
     * @return string
     */
    public function getPattern()
    {
        return $this->pattern;
    }

    /**
     * Set routeName
     *
     * @param string $routeName
     *
     * @return Page
     */
    public function setRouteName($routeName)
    {
        $this->routeName = $routeName;

        return $this;
    }

    /**
     * Get routeName
     *
     * @return string
     */
    public function getRouteName()
    {
        return $this->routeName;
    }

    /**
     * Set pageName
     *
     * @param string $pageName
     *
     * @return Page
     */
    public function setPageName($pageName)
    {
        $this->pageName = $pageName;

        return $this;
    }

    /**
     * Get pageName
     *
     * @return string
     */
    public function getPageName()
    {
        return $this->pageName;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Page
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
     * Set description
     *
     * @param string $description
     *
     * @return Page
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
     * Set keywords
     *
     * @param string $keywords
     *
     * @return Page
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
     * Set showInTop
     *
     * @param boolean $showInTop
     *
     * @return Page
     */
    public function setShowInTop($showInTop)
    {
        $this->showInTop = $showInTop;

        return $this;
    }

    /**
     * Get showInTop
     *
     * @return boolean
     */
    public function getShowInTop()
    {
        return $this->showInTop;
    }
}
