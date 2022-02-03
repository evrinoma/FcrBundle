<?php


namespace Evrinoma\FcrBundle\Dto\Preserve;


use Evrinoma\DtoCommon\ValueObject\Mutable\ActiveInterface;
use Evrinoma\DtoCommon\ValueObject\Mutable\DescriptionInterface;
use Evrinoma\DtoCommon\ValueObject\Mutable\IdInterface;

interface FcrApiDtoInterface extends IdInterface, ActiveInterface, DescriptionInterface
{
}