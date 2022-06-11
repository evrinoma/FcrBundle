<?php

namespace Evrinoma\FcrBundle\Model\Fcr;

use Doctrine\ORM\Mapping as ORM;
use Evrinoma\UtilsBundle\Entity\ActiveTrait;
use Evrinoma\UtilsBundle\Entity\CreateUpdateAtTrait;
use Evrinoma\UtilsBundle\Entity\DescriptionTrait;
use Evrinoma\UtilsBundle\Entity\IdTrait;

/**
 * @ORM\MappedSuperclass
 * @ORM\Table(uniqueConstraints={
 *     @ORM\UniqueConstraint(name="idx_id", columns={"id"}),
 *     @ORM\UniqueConstraint(name="idx_description", columns={"description"})
 *     }
 * )
 */
abstract class AbstractFcr implements FcrInterface
{
    use IdTrait, CreateUpdateAtTrait, ActiveTrait, DescriptionTrait;


    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\Column(name="id", type="integer")
     */
    protected $id;
    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255, nullable=true)
     */
    protected string $description;


    /**
     * @param int|null $id
     *
     * @return FcrInterface
     */
    public function setId(?int $id): FcrInterface
    {
        $this->id = $id;

        return $this;
    }

}