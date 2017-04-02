<?php

namespace AppBundle\Service;


use Doctrine\ORM\EntityManager;

class Crudable
{
    /** @var EntityManager $em */
    protected $em;

    /**
     * Crudable constructor.
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->em = $entityManager;
    }


}