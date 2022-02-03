<?php

namespace Evrinoma\FcrBundle\Dto;

use Evrinoma\DtoBundle\Dto\AbstractDto;
use Evrinoma\DtoBundle\Dto\DtoInterface;
use Evrinoma\DtoCommon\ValueObject\Mutable\ActiveTrait;
use Evrinoma\DtoCommon\ValueObject\Mutable\DescriptionTrait;
use Evrinoma\DtoCommon\ValueObject\Mutable\IdTrait;
use Symfony\Component\HttpFoundation\Request;

class FcrApiDto extends AbstractDto implements FcrApiDtoInterface
{
    use IdTrait, DescriptionTrait, ActiveTrait;

//region SECTION: Dto
    public function toDto(Request $request): DtoInterface
    {
        $class = $request->get(DtoInterface::DTO_CLASS);

        if ($class === $this->getClass()) {
            $active      = $request->get(FcrApiDtoInterface::ACTIVE);
            $id          = $request->get(FcrApiDtoInterface::ID);
            $description = $request->get(FcrApiDtoInterface::DESCRIPTION);

            if ($active) {
                $this->setActive($active);
            }
            if ($id) {
                $this->setId($id);
            }
            if ($description) {
                $this->setDescription($description);
            }
        }

        return $this;
    }
//endregion SECTION: Dto
}