<?php


namespace Evrinoma\FcrBundle\Constraint;

use Evrinoma\UtilsBundle\Constraint\ConstraintInterface;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\NotNull;

final class Id implements ConstraintInterface
{
//region SECTION: Getters/Setters
    public function getConstraints(): array
    {
        return [
            new NotBlank(),
            new NotNull(),
        ];
    }

    public function getPropertyName(): string
    {
        return 'id';
    }
//endregion Getters/Setters
}