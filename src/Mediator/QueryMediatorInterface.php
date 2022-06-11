<?php

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
     * @param QueryBuilder              $builder
     *
     * @return mixed
     */
    public function createQuery(FcrApiDtoInterface $dto, QueryBuilder $builder):void;


    /**
     * @param FcrApiDtoInterface $dto
     * @param QueryBuilder              $builder
     *
     * @return array
     */
    public function getResult(FcrApiDtoInterface $dto, QueryBuilder $builder): array;
}