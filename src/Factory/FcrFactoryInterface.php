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

namespace Evrinoma\FcrBundle\Factory;

use Evrinoma\FcrBundle\Dto\FcrApiDtoInterface;
use Evrinoma\FcrBundle\Model\Fcr\FcrInterface;

interface FcrFactoryInterface
{
    /**
     * @param FcrApiDtoInterface $dto
     *
     * @return FcrInterface
     */
    public function create(FcrApiDtoInterface $dto): FcrInterface;
}
