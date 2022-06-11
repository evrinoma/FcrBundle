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

namespace Evrinoma\FcrBundle\Tests\Functional\Helper;

use PHPUnit\Framework\Assert;

trait BaseFcrTestTrait
{
    protected function assertGet(string $id): array
    {
        $find = $this->get($id);
        $this->testResponseStatusOK();

        $this->checkResult($find);

        return $find;
    }

    protected function createFcr(): array
    {
        $query = static::getDefault();

        return $this->post($query);
    }

    protected function createFcrDuplicateId(): array
    {
        $query = static::getDefault(['id' => '48']);

        return $this->post($query);
    }

    protected function createFcrDuplicateDescription(): array
    {
        $query = static::getDefault(['description' => 'kzkt']);

        return $this->post($query);
    }

    protected function createConstraintBlankId(): array
    {
        $query = static::getDefault(['id' => '']);

        return $this->post($query);
    }

    protected function createConstraintBlankDescription(): array
    {
        $query = static::getDefault(['description' => '']);

        return $this->post($query);
    }

    protected function checkResult($entity): void
    {
        Assert::assertArrayHasKey('data', $entity);
        Assert::assertArrayHasKey('id', $entity['data']);
        Assert::assertArrayHasKey('description', $entity['data']);
        Assert::assertArrayHasKey('active', $entity['data']);
    }
}
