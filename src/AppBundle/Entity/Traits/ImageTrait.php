<?php

namespace AppBundle\Entity\Traits;

use AppBundle\Entity\Image;
use Doctrine\Common\Collections\ArrayCollection;

trait ImageTrait
{
    /**
     * @var ArrayCollection
     */
    private $images;

    /**
     * @param Image $image
     * @return $this
     */
    public function addImage(Image $image)
    {
        if(!$this->images->contains($image)) {
            $this->images->add($image);
        }

        return $this;
    }

    /**
     * Remove $image from collection
     *
     * @param Image $image
     * @return $this
     */
    public function removeImage(Image $image) {
        if($this->images->contains($image)) {
            $this->images->remove($image);
        }

        return $this;
    }

    /**
     * @param ArrayCollection $collection
     * @return $this
     */
    public function setImages(ArrayCollection $collection) {
        $this->images = $collection;

        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getImages() {
        return $this->images;
    }

    /**
     * @return $this
     */
    public function clearImages() {
        $this->images->clear();

        return $this;
    }

}