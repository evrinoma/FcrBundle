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

namespace Evrinoma\FcrBundle\Dto\Preserve;

use Evrinoma\DtoCommon\ValueObject\Preserve\ActiveTrait;
use Evrinoma\DtoCommon\ValueObject\Preserve\DescriptionTrait;
use Evrinoma\DtoCommon\ValueObject\Preserve\IdTrait;

trait FcrApiDtoTrait
{
    use ActiveTrait;
    use DescriptionTrait;
    use IdTrait;
}
