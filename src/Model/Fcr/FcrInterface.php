<?php

namespace Evrinoma\FcrBundle\Model\Fcr;

use Evrinoma\UtilsBundle\Entity\ActiveInterface;
use Evrinoma\UtilsBundle\Entity\CreateUpdateAtInterface;
use Evrinoma\UtilsBundle\Entity\IdInterface;

interface FcrInterface extends ActiveInterface, CreateUpdateAtInterface, IdInterface
{
}