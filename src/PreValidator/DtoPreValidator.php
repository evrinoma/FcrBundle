<?php

namespace Evrinoma\FcrBundle\PreValidator;

use Evrinoma\DtoBundle\Dto\DtoInterface;
use Evrinoma\FcrBundle\Dto\FcrApiDtoInterface;
use Evrinoma\FcrBundle\Exception\FcrInvalidException;
use Evrinoma\UtilsBundle\PreValidator\AbstractPreValidator;

class DtoPreValidator extends AbstractPreValidator implements DtoPreValidatorInterface
{

//region SECTION: Public
    public function onPost(DtoInterface $dto): void
    {
    }

    public function onPut(DtoInterface $dto): void
    {
        $this->check($dto);
    }

    public function onDelete(DtoInterface $dto): void
    {
        $this->check($dto);
    }
//endregion Public

//region SECTION: Private
    private function check(DtoInterface $dto): void
    {
        /** @var FcrApiDtoInterface $dto */
        if (!$dto->hasId()) {
            throw new FcrInvalidException('The Dto has\'t ID or class invalid');
        }
    }
//endregion Private
}