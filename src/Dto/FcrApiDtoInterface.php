<?php

namespace Evrinoma\FcrBundle\Dto;

use Evrinoma\DtoCommon\ValueObject\ActiveInterface;
use Evrinoma\DtoCommon\ValueObject\DescriptionInterface;
use Evrinoma\DtoCommon\ValueObject\IdInterface;
use Evrinoma\DtoBundle\Dto\DtoInterface;

interface FcrApiDtoInterface extends DtoInterface, IdInterface, ActiveInterface, DescriptionInterface
{

}