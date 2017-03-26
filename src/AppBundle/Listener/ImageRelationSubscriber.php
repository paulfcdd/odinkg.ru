<?php

namespace AppBundle\Listener;

use AppBundle\Entity\Image;
use AppBundle\Entity\Traits\ImageTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LifecycleEventArgs;

class ImageRelationSubscriber implements EventSubscriber
{
    public function getSubscribedEvents()
    {
        return ['postLoad'];
    }

    public function postLoad(LifecycleEventArgs $eventArgs) {

        if(!in_array(ImageTrait::class, class_uses($eventArgs->getObject()))) {
            return;
        }

        $result = $eventArgs->getEntityManager()->createQueryBuilder()
            ->select('i')
            ->from(Image::class, 'i')
            ->where('i.foreignKey = :id')
            ->andWhere('i.entity = :entity')
            ->setParameter('id', $eventArgs->getObject()->getId())
            ->setParameter('entity', get_class($eventArgs->getObject()))
            ->getQuery()
            ->getResult();

        $eventArgs->getObject()->setImages(new ArrayCollection($result));
    }
}