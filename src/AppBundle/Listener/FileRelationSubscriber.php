<?php

namespace AppBundle\Listener;

use AppBundle\Entity\File;
use AppBundle\Entity\Traits\FileTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LifecycleEventArgs;

class FileRelationSubscriber implements EventSubscriber
{
    public function getSubscribedEvents()
    {
        return ['postLoad'];
    }

    public function postLoad(LifecycleEventArgs $eventArgs) {

        if(!in_array(FileTrait::class, class_uses($eventArgs->getObject()))) {
            return;
        }

        $result = $eventArgs->getEntityManager()->createQueryBuilder()
            ->select('f')
            ->from(File::class, 'f')
            ->where('f.foreignKey = :id')
            ->andWhere('f.entity = :entity')
            ->setParameter('id', $eventArgs->getObject()->getId())
            ->setParameter('entity', get_class($eventArgs->getObject()))
            ->getQuery()
            ->getResult();

        $eventArgs->getObject()->setImages(new ArrayCollection($result));

    }
}