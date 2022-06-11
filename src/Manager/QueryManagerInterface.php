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

namespace Evrinoma\FcrBundle\Manager;

use Evrinoma\FcrBundle\Dto\FcrApiDtoInterface;
use Evrinoma\FcrBundle\Exception\FcrNotFoundException;
use Evrinoma\FcrBundle\Exception\FcrProxyException;
use Evrinoma\FcrBundle\Model\Fcr\FcrInterface;

interface QueryManagerInterface
{
    /**
     * @param FcrApiDtoInterface $dto
     *
     * @return array
     *
     * @throws FcrNotFoundException
     */
    public function criteria(FcrApiDtoInterface $dto): array;

    /**
     * @param FcrApiDtoInterface $dto
     *
     * @return FcrInterface
     *
     * @throws FcrNotFoundException
     */
    public function get(FcrApiDtoInterface $dto): FcrInterface;

    /**
     * @param FcrApiDtoInterface $dto
     *
     * @return FcrInterface
     *
     * @throws FcrProxyException
     */
    public function proxy(FcrApiDtoInterface $dto): FcrInterface;
}
