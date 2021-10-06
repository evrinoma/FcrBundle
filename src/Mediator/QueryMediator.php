<?php

namespace Evrinoma\FcrBundle\Mediator;

use Doctrine\ORM\QueryBuilder;
use Evrinoma\DtoBundle\Dto\DtoInterface;
use Evrinoma\FcrBundle\Dto\FcrApiDtoInterface;
use Evrinoma\UtilsBundle\Mediator\AbstractQueryMediator;

class QueryMediator extends AbstractQueryMediator implements QueryMediatorInterface
{
//region SECTION: Fields
    protected static string $alias = MediatorInterface::ALIAS_FCR;
//endregion Fields

//region SECTION: Public
    /**
     * @param DtoInterface $dto
     * @param QueryBuilder              $builder
     *
     * @return mixed
     */
    public function createQuery(DtoInterface $dto, QueryBuilder $builder):void
    {
        $alias = $this->alias();

        /** @var $dto FcrApiDtoInterface */
        if ($dto->hasDescription()) {
            $builder
                ->andWhere($alias.'.description = :description')
                ->setParameter('description', $dto->getDescription());
        }

        if ($dto->hasActive()) {
            $builder
                ->andWhere($alias.'.active = :active')
                ->setParameter('active', $dto->getActive());
        }
    }
//endregion Public
}