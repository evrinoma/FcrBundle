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
use Evrinoma\FcrBundle\Repository\FcrQueryRepositoryInterface;
use Evrinoma\UtilsBundle\Rest\RestInterface;
use Evrinoma\UtilsBundle\Rest\RestTrait;

final class QueryManager implements QueryManagerInterface, RestInterface
{
    use RestTrait;

    private FcrQueryRepositoryInterface $repository;

    public function __construct(FcrQueryRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param FcrApiDtoInterface $dto
     *
     * @return array
     *
     * @throws FcrNotFoundException
     */
    public function criteria(FcrApiDtoInterface $dto): array
    {
        try {
            $fcr = $this->repository->findByCriteria($dto);
        } catch (FcrNotFoundException $e) {
            throw $e;
        }

        return $fcr;
    }

    /**
     * @param FcrApiDtoInterface $dto
     *
     * @return FcrInterface
     *
     * @throws FcrProxyException
     */
    public function proxy(FcrApiDtoInterface $dto): FcrInterface
    {
        try {
            if ($dto->hasId()) {
                $fcr = $this->repository->proxy($dto->idToString());
            } else {
                throw new FcrProxyException('Id value is not set while trying get proxy object');
            }
        } catch (FcrProxyException $e) {
            throw $e;
        }

        return $fcr;
    }

    public function getRestStatus(): int
    {
        return $this->status;
    }

    /**
     * @param FcrApiDtoInterface $dto
     *
     * @return FcrInterface
     *
     * @throws FcrNotFoundException
     */
    public function get(FcrApiDtoInterface $dto): FcrInterface
    {
        try {
            $fcr = $this->repository->find($dto->getId());
        } catch (FcrNotFoundException $e) {
            throw $e;
        }

        return $fcr;
    }
}
