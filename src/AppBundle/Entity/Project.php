<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Traits\ImageTrait;
use Doctrine\ORM\Mapping as ORM;

class Project
{
    use ImageTrait;

    private $id;
}