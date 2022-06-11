<?php

declare(strict_types=1);

/*
 * This file is part of the package.
 *
 * (c) Nikolay Nikolaev <evrinoma@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Evrinoma\FcrBundle\DependencyInjection\Compiler\Constraint\Property;

use Evrinoma\FcrBundle\Validator\FcrValidator;
use Evrinoma\UtilsBundle\DependencyInjection\Compiler\AbstractConstraint;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;

class FcrPass extends AbstractConstraint implements CompilerPassInterface
{
    public const FCR_CONSTRAINT = 'evrinoma.fcr.constraint.property';

    protected static string $alias = self::FCR_CONSTRAINT;
    protected static string $class = FcrValidator::class;
    protected static string $methodCall = 'addPropertyConstraint';
}
