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

//region SECTION: Private
    /**
     * @param int $id
     */
    protected function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @param string $description
     */
    protected function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * @param string $active
     */
    protected function setActive(string $active): void
    {
        $this->active = $active;
    }
//endregion Private

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