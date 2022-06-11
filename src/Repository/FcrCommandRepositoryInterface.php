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

namespace Evrinoma\FcrBundle\Repository;

use Evrinoma\FcrBundle\Exception\FcrCannotBeRemovedException;
use Evrinoma\FcrBundle\Exception\FcrCannotBeSavedException;
use Evrinoma\FcrBundle\Model\Fcr\FcrInterface;

interface FcrCommandRepositoryInterface
{
    /**
     * @param FcrInterface $fcr
     *
     * @return bool
     *
     * @throws FcrCannotBeSavedException
     */
    public function save(FcrInterface $fcr): bool;

    /**
     * @param FcrInterface $fcr
     *
     * @return bool
     *
     * @throws FcrCannotBeRemovedException
     */
    public function remove(FcrInterface $fcr): bool;
}
