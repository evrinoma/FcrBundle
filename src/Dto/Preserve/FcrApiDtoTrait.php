<?php


namespace Evrinoma\FcrBundle\Dto\Preserve;

trait FcrApiDtoTrait
{
//region SECTION: Getters/Setters
    /**
     * @param string $active
     *
     * @return self
     */
    public function setActive(string $active): self
    {
        return parent::setActive($active);
    }

    /**
     * @param int|null $id
     *
     * @return self
     */
    public function setId(?int $id): self
    {
        return parent::setId($id);
    }

    /**
     * @param string $description
     *
     * @return self
     */
    public function setDescription(string $description): self
    {
        return parent::setDescription($description);
    }

//endregion Getters/Setters
}