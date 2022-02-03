<?php

namespace Evrinoma\FcrBundle\Dto;

use Evrinoma\DtoBundle\Dto\DtoInterface;
use Evrinoma\DtoCommon\ValueObject\Immutable\ActiveInterface;
use Evrinoma\DtoCommon\ValueObject\Immutable\DescriptionInterface;
use Evrinoma\DtoCommon\ValueObject\Immutable\IdInterface;

interface FcrApiDtoInterface extends DtoInterface, IdInterface, ActiveInterface, DescriptionInterface
{

}