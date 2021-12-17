<?php


namespace Evrinoma\FcrBundle\Dto\Preserve;


interface FcrApiDtoInterface
{
//region SECTION: Getters/Setters
    /**
     * @param string $active
     */
    public function setActive(string $active): void;

    /**
     * @param int|null $id
     */
    public function setId(?int $id): void;

    /**
     * @param string $description
     */
    public function setDescription(string $description): void;
//endregion Getters/Setters
}