<?php

namespace Evrinoma\FcrBundle\DependencyInjection\Compiler\Constraint\Property;

use Evrinoma\FcrBundle\Validator\FcrValidator;
use Evrinoma\UtilsBundle\DependencyInjection\Compiler\AbstractConstraint;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;

class FcrPass extends AbstractConstraint implements CompilerPassInterface
{
    public const FCR_CONSTRAINT = 'evrinoma.fcr.constraint.property';

    protected static string $alias      = self::FCR_CONSTRAINT;
    protected static string $class      = FcrValidator::class;
    protected static string $methodCall = 'addPropertyConstraint';
}