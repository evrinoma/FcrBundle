<?php


namespace Evrinoma\FcrBundle\Constraint\Property;

use Evrinoma\UtilsBundle\Constraint\Property\ConstraintInterface;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\NotNull;

final class Description implements ConstraintInterface
{
//region SECTION: Getters/Setters
    public function getConstraints(): array
    {
        return [
            new NotBlank(),
            new NotNull()
        ];
    }

    public function getPropertyName(): string
    {
        return 'description';
    }
//endregion Getters/Setters
}