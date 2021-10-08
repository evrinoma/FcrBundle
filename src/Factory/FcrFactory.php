<?php

namespace Evrinoma\FcrBundle\Factory;

use Evrinoma\FcrBundle\Dto\FcrApiDtoInterface;
use Evrinoma\FcrBundle\Entity\Fcr\BaseFcr;
use Evrinoma\FcrBundle\Model\Fcr\FcrInterface;

class FcrFactory implements FcrFactoryInterface
{
//region SECTION: Fields
    private static string $entityClass = BaseFcr::class;

    public function __construct(string $entityClass)
    {
        self::$entityClass = $entityClass;
    }
//endregion Fields

//region SECTION: Public
    /**
     * @param FcrApiDtoInterface $dto
     *
     * @return FcrInterface
     */
    public function create(FcrApiDtoInterface $dto): FcrInterface
    {
        /** @var BaseFcr $fcr */
        $fcr = new self::$entityClass;

        $fcr
            ->setDescription($dto->getDescription())
            ->setId($dto->getId())
            ->setCreatedAt(new \DateTimeImmutable())
            ->setActiveToActive();

        return $fcr;
    }
//endregion Public
}