<?php


namespace Evrinoma\FcrBundle\Validator;


use Evrinoma\FcrBundle\Entity\Fcr\BaseFcr;
use Evrinoma\UtilsBundle\Validator\AbstractValidator;
use Symfony\Component\Validator\Validator\ValidatorInterface;

final class FcrValidator extends AbstractValidator
{

    /**
     * @var string|null
     */
    protected static ?string $entityClass = BaseFcr::class;


    /**
     * @param ValidatorInterface $validator
     * @param string             $entityClass
     */
    public function __construct(ValidatorInterface $validator, string $entityClass)
    {
        parent::__construct($validator, $entityClass);
    }

}