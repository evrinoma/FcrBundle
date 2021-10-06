<?php

namespace Evrinoma\FcrBundle\Model\Fcr;

use Evrinoma\UtilsBundle\Entity\ActiveTrait;
use Evrinoma\UtilsBundle\Entity\CreateUpdateAtTrait;
use Evrinoma\UtilsBundle\Entity\IdTrait;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\MappedSuperclass
 * @ORM\Table(uniqueConstraints={
 *     @ORM\UniqueConstraint(name="idx_sys_id", columns={"sys_id"}),
 *     @ORM\UniqueConstraint(name="idx_description_id", columns={"description"})
 *     }
 * )
 */
abstract class AbstractFcr implements FcrInterface
{
    use IdTrait, CreateUpdateAtTrait, ActiveTrait;

//region SECTION: Fields
    /**
     * @var int
     *
     * @ORM\Column(name="sys_id", type="integer")
     */
    protected int $sysId;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255, nullable=true)
     */
    protected string $description;
//endregion Fields

//region SECTION: Getters/Setters
    /**
     * @return int
     */
    public function getSysId(): int
    {
        return $this->sysId;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param int $sysId
     *
     * @return FcrInterface
     */
    public function setSysId(int $sysId): FcrInterface
    {
        $this->sysId = $sysId;

        return $this;
    }

    /**
     * @param string $description
     *
     * @return FcrInterface
     */
    public function setDescription(string $description): FcrInterface
    {
        $this->description = $description;

        return $this;
    }
//endregion Getters/Setters
}