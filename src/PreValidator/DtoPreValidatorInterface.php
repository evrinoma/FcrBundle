<?php

declare(strict_types=1);

/*
 * This file is part of the package.
 *
 * (c) Nikolay Nikolaev <evrinoma@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Evrinoma\FcrBundle\PreValidator;

use Evrinoma\FcrBundle\Dto\FcrApiDtoInterface;
use Evrinoma\FcrBundle\Exception\FcrInvalidException;

interface DtoPreValidatorInterface
{
    /**
     * @param FcrApiDtoInterface $dto
     *
     * @throws FcrInvalidException
     */
    public function onPost(FcrApiDtoInterface $dto): void;

    /**
     * @param FcrApiDtoInterface $dto
     *
     * @throws FcrInvalidException
     */
    public function onPut(FcrApiDtoInterface $dto): void;

    /**
     * @param FcrApiDtoInterface $dto
     *
     * @throws FcrInvalidException
     */
    public function onDelete(FcrApiDtoInterface $dto): void;
}
