<?php

namespace Evrinoma\FcrBundle\Manager;

use Evrinoma\FcrBundle\Dto\FcrApiDtoInterface;
use Evrinoma\FcrBundle\Exception\FcrCannotBeCreatedException;
use Evrinoma\FcrBundle\Exception\FcrCannotBeRemovedException;
use Evrinoma\FcrBundle\Exception\FcrCannotBeSavedException;
use Evrinoma\FcrBundle\Exception\FcrInvalidException;
use Evrinoma\FcrBundle\Exception\FcrNotFoundException;
use Evrinoma\FcrBundle\Factory\FcrFactoryInterface;
use Evrinoma\FcrBundle\Mediator\CommandMediatorInterface;
use Evrinoma\FcrBundle\Model\Fcr\FcrInterface;
use Evrinoma\FcrBundle\Repository\FcrCommandRepositoryInterface;
use Evrinoma\UtilsBundle\Rest\RestInterface;
use Evrinoma\UtilsBundle\Rest\RestTrait;
use Evrinoma\UtilsBundle\Validator\ValidatorInterface;

final class CommandManager implements CommandManagerInterface, RestInterface
{
    use RestTrait;


    private FcrCommandRepositoryInterface $repository;
    private ValidatorInterface            $validator;
    private FcrFactoryInterface           $factory;
    private CommandMediatorInterface      $mediator;


    /**
     * @param ValidatorInterface            $validator
     * @param FcrCommandRepositoryInterface $repository
     * @param FcrFactoryInterface           $factory
     */
    public function __construct(ValidatorInterface $validator, FcrCommandRepositoryInterface $repository, FcrFactoryInterface $factory, CommandMediatorInterface $mediator)
    {
        $this->validator  = $validator;
        $this->repository = $repository;
        $this->factory    = $factory;
        $this->mediator   = $mediator;
    }


    /**
     * @param FcrApiDtoInterface $dto
     *
     * @return FcrInterface
     * @throws FcrInvalidException
     * @throws FcrCannotBeCreatedException
     * @throws FcrCannotBeSavedException
     */
    public function post(FcrApiDtoInterface $dto): FcrInterface
    {
        $fcr = $this->factory->create($dto);

        $this->mediator->onCreate($dto, $fcr);

        $errors = $this->validator->validate($fcr);

        if (count($errors) > 0) {

            $errorsString = (string)$errors;

            throw new FcrInvalidException($errorsString);
        }

        $this->repository->save($fcr);

        return $fcr;
    }

    /**
     * @param FcrApiDtoInterface $dto
     *
     * @return FcrInterface
     * @throws FcrInvalidException
     * @throws FcrNotFoundException
     * @throws FcrCannotBeSavedException
     */
    public function put(FcrApiDtoInterface $dto): FcrInterface
    {
        try {
            $fcr = $this->repository->find($dto->getId());
        } catch (FcrNotFoundException $e) {
            throw $e;
        }

        $this->mediator->onUpdate($dto, $fcr);

        $errors = $this->validator->validate($fcr);

        if (count($errors) > 0) {

            $errorsString = (string)$errors;

            throw new FcrInvalidException($errorsString);
        }

        $this->repository->save($fcr);

        return $fcr;
    }

    /**
     * @param FcrApiDtoInterface $dto
     *
     * @throws FcrCannotBeRemovedException
     * @throws FcrNotFoundException
     */
    public function delete(FcrApiDtoInterface $dto): void
    {
        try {
            $fcr = $this->repository->find($dto->getId());
        } catch (FcrNotFoundException $e) {
            throw $e;
        }
        $this->mediator->onDelete($dto, $fcr);
        try {
            $this->repository->remove($fcr);
        } catch (FcrCannotBeRemovedException $e) {
            throw $e;
        }
    }


    public function getRestStatus(): int
    {
        return $this->status;
    }

}