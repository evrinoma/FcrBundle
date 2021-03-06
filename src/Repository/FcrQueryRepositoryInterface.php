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

use Doctrine\ORM\ORMException;
use Evrinoma\FcrBundle\Dto\FcrApiDtoInterface;
use Evrinoma\FcrBundle\Exception\FcrNotFoundException;
use Evrinoma\FcrBundle\Exception\FcrProxyException;
use Evrinoma\FcrBundle\Model\Fcr\FcrInterface;

interface FcrQueryRepositoryInterface
{
    /**
     * @param FcrApiDtoInterface $dto
     *
     * @return array
     *
     * @throws FcrNotFoundException
     */
    public function findByCriteria(FcrApiDtoInterface $dto): array;

    /**
     * @param      $id
     * @param null $lockMode
     * @param null $lockVersion
     *
     * @return FcrInterface
     *
     * @throws FcrNotFoundException
     */
    public function find($id, $lockMode = null, $lockVersion = null): FcrInterface;

    /**
     * @param string $id
     *
     * @return FcrInterface
     *
     * @throws FcrProxyException
     * @throws ORMException
     */
    public function proxy(string $id): FcrInterface;
}
