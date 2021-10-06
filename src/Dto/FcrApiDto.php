<?php

namespace Evrinoma\FcrBundle\Dto;


use Evrinoma\DtoBundle\Dto\AbstractDto;
use Evrinoma\DtoBundle\Dto\DtoInterface;
use Evrinoma\DtoCommon\ValueObject\ActiveTrait;
use Evrinoma\DtoCommon\ValueObject\DescriptionTrait;
use Evrinoma\DtoCommon\ValueObject\IdTrait;
use Symfony\Component\HttpFoundation\Request;

class FcrApiDto extends AbstractDto implements FcrApiDtoInterface
{
    use IdTrait, DescriptionTrait, ActiveTrait;

//region SECTION: Dto
    public function toDto(Request $request): DtoInterface
    {
        return $this;
    }
//endregion SECTION: Dto
}