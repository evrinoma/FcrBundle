<?php

namespace Evrinoma\FcrBundle\Manager;

use Evrinoma\FcrBundle\Exception\FcrProxyException;
use Evrinoma\FcrBundle\Dto\FcrApiDtoInterface;
use Evrinoma\FcrBundle\Exception\FcrNotFoundException;
use Evrinoma\FcrBundle\Model\Fcr\FcrInterface;
use Evrinoma\FcrBundle\Repository\FcrQueryRepositoryInterface;
use Evrinoma\UtilsBundle\Rest\RestInterface;
use Evrinoma\UtilsBundle\Rest\RestTrait;

final class QueryManager implements QueryManagerInterface, RestInterface
{
    use RestTrait;

//region SECTION: Fields
    private FcrQueryRepositoryInterface $repository;
//endregion Fields

//region SECTION: Constructor
    public function __construct(FcrQueryRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }
//endregion Constructor

//region SECTION: Public
    /**
     * @param FcrApiDtoInterface $dto
     *
     * @return array
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
     * @throws FcrProxyException
     */
    public function proxy(FcrApiDtoInterface $dto): FcrInterface
    {
        try {
            if ($dto->hasId()) {
                $fcr = $this->repository->proxy($dto->getId());
            } else {
                throw new FcrProxyException("Id value is not set while trying get proxy object");
            }
        } catch (FcrProxyException $e) {
            throw $e;
        }

        return $fcr;
    }
//endregion Public

//region SECTION: Getters/Setters
    public function getRestStatus(): int
    {
        return $this->status;
    }

    /**
     * @param FcrApiDtoInterface $dto
     *
     * @return FcrInterface
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
//endregion Getters/Setters
}