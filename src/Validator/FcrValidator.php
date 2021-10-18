<?php


namespace Evrinoma\FcrBundle\Validator;


use Evrinoma\FcrBundle\Entity\Fcr\BaseFcr;
use Evrinoma\UtilsBundle\Validator\AbstractValidator;

final class FcrValidator extends AbstractValidator
{
//region SECTION: Fields
    /**
     * @var string|null
     */
    protected static ?string $entityClass = BaseFcr::class;
//endregion Fields

//region SECTION: Constructor
    /**
     * ContractorValidator constructor.
     */
    public function __construct(string $entityClass)
    {
        parent::__construct($entityClass);
    }
//endregion Constructor
}