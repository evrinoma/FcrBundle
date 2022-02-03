<?php


namespace Evrinoma\FcrBundle\Dto\Preserve;

use Evrinoma\DtoBundle\Dto\DtoInterface;

trait FcrApiDtoTrait
{
//region SECTION: Getters/Setters
    /**
     * @param string $active
     *
     * @return DtoInterface
     */
    public function setActive(string $active): DtoInterface
    {
        return parent::setActive($active);
    }

    /**
     * @param int|null $id
     *
     * @return DtoInterface
     */
    public function setId(?int $id): DtoInterface
    {
        return parent::setId($id);
    }

    /**
     * @param string $description
     *
     * @return DtoInterface
     */
    public function setDescription(string $description): DtoInterface
    {
        return parent::setDescription($description);
    }

//endregion Getters/Setters
}