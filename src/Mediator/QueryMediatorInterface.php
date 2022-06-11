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

namespace Evrinoma\FcrBundle\Mediator;

use Doctrine\ORM\QueryBuilder;
use Evrinoma\FcrBundle\Dto\FcrApiDtoInterface;

interface QueryMediatorInterface
{
    /**
     * @return string
     */
    public function alias(): string;

    /**
     * @param FcrApiDtoInterface $dto
     * @param QueryBuilder       $builder
     *
     * @return mixed
     */
    public function createQuery(FcrApiDtoInterface $dto, QueryBuilder $builder): void;

    /**
     * @param FcrApiDtoInterface $dto
     * @param QueryBuilder       $builder
     *
     * @return array
     */
    public function getResult(FcrApiDtoInterface $dto, QueryBuilder $builder): array;
}
