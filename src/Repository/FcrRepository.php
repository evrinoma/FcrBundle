<?php

namespace Evrinoma\FcrBundle\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\ORMException;
use Doctrine\ORM\ORMInvalidArgumentException;
use Doctrine\Persistence\ManagerRegistry;
use Evrinoma\FcrBundle\Dto\FcrApiDtoInterface;
use Evrinoma\FcrBundle\Exception\FcrProxyException;
use Evrinoma\FcrBundle\Exception\FcrCannotBeSavedException;
use Evrinoma\FcrBundle\Exception\FcrNotFoundException;
use Evrinoma\FcrBundle\Mediator\QueryMediatorInterface;
use Evrinoma\FcrBundle\Model\Fcr\FcrInterface;

class FcrRepository extends ServiceEntityRepository implements FcrRepositoryInterface
{
//region SECTION: Fields
    private QueryMediatorInterface $mediator;
//endregion Fields

//region SECTION: Constructor
    /**
     * @param ManagerRegistry        $registry
     * @param string                 $entityClass
     * @param QueryMediatorInterface $mediator
     */
    public function __construct(ManagerRegistry $registry, string $entityClass, QueryMediatorInterface $mediator)
    {
        parent::__construct($registry, $entityClass);
        $this->mediator = $mediator;
    }
//endregion Constructor

//region SECTION: Public
    /**
     * @param FcrInterface $fcr
     *
     * @return bool
     * @throws FcrCannotBeSavedException
     * @throws ORMException
     */
    public function save(FcrInterface $fcr): bool
    {
        try {
            $this->getEntityManager()->persist($fcr);
        } catch (ORMInvalidArgumentException $e) {
            throw new FcrCannotBeSavedException($e->getMessage());
        }

        return true;
    }

    /**
     * @param FcrInterface $fcr
     *
     * @return bool
     */
    public function remove(FcrInterface $fcr): bool
    {
        $fcr
            ->setUpdatedAt(new \DateTimeImmutable())
            ->setActiveToDelete();

        return true;
    }
//endregion Public

//region SECTION: Find Filters Repository
    /**
     * @param FcrApiDtoInterface $dto
     *
     * @return array
     * @throws FcrNotFoundException
     */
    public function findByCriteria(FcrApiDtoInterface $dto): array
    {
        $builder = $this->createQueryBuilder($this->mediator->alias());

        $this->mediator->createQuery($dto, $builder);

        $fcrs = $this->mediator->getResult($dto, $builder);

        if (count($fcrs) === 0) {
            throw new FcrNotFoundException("Cannot find fcr by findByCriteria");
        }

        return $fcrs;
    }

    /**
     * @param      $id
     * @param null $lockMode
     * @param null $lockVersion
     *
     * @return mixed
     * @throws FcrNotFoundException
     */
    public function find($id, $lockMode = null, $lockVersion = null): FcrInterface
    {
        /** @var FcrInterface $fcr */
        $fcr = parent::find($id);

        if ($fcr === null) {
            throw new FcrNotFoundException("Cannot find fcr with id $id");
        }

        return $fcr;
    }

    /**
     * @param string $id
     *
     * @return FcrInterface
     * @throws FcrProxyException
     * @throws ORMException
     */
    public function proxy(string $id): FcrInterface
    {
        $em = $this->getEntityManager();

        $fcr = $em->getReference($this->getEntityName(), $id);

        if (!$em->contains($fcr)) {
            throw new FcrProxyException("Proxy doesn't exist with $id");
        }

        return $fcr;
    }
//endregion Find Filters Repository
}