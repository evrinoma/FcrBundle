<?php


namespace Evrinoma\FcrBundle\Dto\Preserve;

trait FcrApiDtoTrait
{
//region SECTION: Getters/Setters
    /**
     * @param string $active
     */
    public function setActive(string $active): void
    {
        parent::setActive($active);
    }

    /**
     * @param int|null $id
     */
    public function setId(?int $id): void
    {
        parent::setId($id);
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        parent::setDescription($description);
    }

//endregion Getters/Setters
}