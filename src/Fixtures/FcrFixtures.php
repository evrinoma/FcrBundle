<?php

namespace Evrinoma\FcrBundle\Fixtures;

use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Evrinoma\FcrBundle\Entity\Fcr\BaseFcr;
use Evrinoma\TestUtilsBundle\Fixtures\AbstractFixture;

class FcrFixtures extends AbstractFixture implements FixtureGroupInterface, OrderedFixtureInterface
{
//region SECTION: Fields
    protected static array $data = [
        ['id' => 48, 'description' => 'ite', 'active' => 'a', 'created_at' => '2008-10-23 10:21:50'],
        ['id' => 10001, 'description' => 'kzkt', 'active' => 'a', 'created_at' => '2015-10-23 10:21:50'],
        ['id' => 90, 'description' => 'c2m', 'active' => 'a', 'created_at' => '2020-10-23 10:21:50'],
        ['id' => 1001, 'description' => 'kzkt2', 'active' => 'd', 'created_at' => '2015-10-23 10:21:50'],
        ['id' => 49, 'description' => 'nvr', 'active' => 'b', 'created_at' => '2010-10-23 10:21:50'],
        ['id' => 50, 'description' => 'nvr2', 'active' => 'd', 'created_at' => '2010-10-23 10:21:50'],
        ['id' => 51, 'description' => 'nvr3', 'active' => 'd', 'created_at' => '2011-10-23 10:21:50'],
    ];

    protected static string $class = BaseFcr::class;
//endregion Fields

//region SECTION: Private
    /**
     * @param ObjectManager $manager
     *
     * @return $this
     * @throws \Exception
     */
    protected function create(ObjectManager $manager): self
    {
        $short = self::getReferenceName();
        $i     = 0;

        foreach (static::$data as $record) {
            $entity = new BaseFcr();
            $entity
                ->setId($record['id'])
                ->setDescription($record['description'])
                ->setCreatedAt(new \DateTimeImmutable($record['created_at']))
                ->setActive($record['active']);
            $this->addReference($short.$i, $entity);
            $manager->persist($entity);
            $i++;
        }

        return $this;
    }
//endregion Private

//region SECTION: Getters/Setters
    public static function getGroups(): array
    {
        return [
            FixtureInterface::FCR_FIXTURES,
        ];
    }

    public function getOrder()
    {
        return 0;
    }
}