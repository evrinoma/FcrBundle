<?php

namespace Evrinoma\FcrBundle\Entity\Fcr;

use Doctrine\ORM\Mapping as ORM;
use Evrinoma\FcrBundle\Model\Fcr\AbstractFcr;

/**
 * @ORM\Table(name="fcr")
 * @ORM\Entity()
 */
class BaseFcr extends AbstractFcr
{
}