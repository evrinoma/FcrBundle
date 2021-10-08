<?php

namespace Evrinoma\FcrBundle\Dto;

use Evrinoma\DtoBundle\Dto\AbstractDto;
use Evrinoma\DtoBundle\Dto\DtoInterface;
use Evrinoma\DtoCommon\ValueObject\ActiveTrait;
use Evrinoma\DtoCommon\ValueObject\DescriptionTrait;
use Evrinoma\DtoCommon\ValueObject\IdTrait;
use Evrinoma\FcrBundle\Model\ModelInterface;
use Symfony\Component\HttpFoundation\Request;

class FcrApiDto extends AbstractDto implements FcrApiDtoInterface
{
    use IdTrait, DescriptionTrait, ActiveTrait;

//region SECTION: Private
    /**
     * @param string $id
     *
     * @return FcrApiDto
     */
    private function setId(string $id): FcrApiDto
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @param string $description
     *
     * @return FcrApiDto
     */
    private function setDescription(string $description): FcrApiDto
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @param string $active
     *
     * @return FcrApiDto
     */
    private function setActive(string $active): FcrApiDto
    {
        $this->active = $active;

        return $this;
    }
//endregion Private

//region SECTION: Dto
    public function toDto(Request $request): DtoInterface
    {
        $class = $request->get(DtoInterface::DTO_CLASS);

        if ($class === $this->getClass()) {
            $active      = $request->get(ModelInterface::ACTIVE);
            $id          = $request->get(ModelInterface::ID);
            $description = $request->get(ModelInterface::DESCRIPTION);

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