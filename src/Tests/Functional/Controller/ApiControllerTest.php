<?php

namespace Evrinoma\FcrBundle\Tests\Functional\Controller;


use Evrinoma\FcrBundle\Dto\FcrApiDto;
use Evrinoma\FcrBundle\Fixtures\FixtureInterface;
use Evrinoma\FcrBundle\Tests\Functional\CaseTest;
use Evrinoma\TestUtilsBundle\Browser\ApiBrowserTestInterface;
use Evrinoma\TestUtilsBundle\Browser\ApiBrowserTestTrait;
use Evrinoma\TestUtilsBundle\Controller\ApiControllerTestInterface;
use Evrinoma\TestUtilsBundle\Helper\ApiMethodTestInterface;
use Evrinoma\TestUtilsBundle\Helper\ApiMethodTestTrait;
use Evrinoma\TestUtilsBundle\Helper\ResponseStatusTestTrait;
use Evrinoma\UtilsBundle\Model\ActiveModel;

/**
 * @group functional
 */
class ApiControllerTest extends CaseTest implements ApiControllerTestInterface, ApiBrowserTestInterface, ApiMethodTestInterface
{
//region SECTION: Fields
    public const API_GET      = 'evrinoma/api/fcr';
    public const API_CRITERIA = 'evrinoma/api/fcr/criteria';
    public const API_DELETE   = 'evrinoma/api/fcr/delete';
    public const API_PUT      = 'evrinoma/api/fcr/save';
    public const API_POST     = 'evrinoma/api/fcr/create';
//endregion Fields

    use ApiBrowserTestTrait, ApiMethodTestTrait, ResponseStatusTestTrait;

//region SECTION: Protected
//endregion Protected

//region SECTION: Public
    public static function defaultData(): array
    {
        return [
            "id"          => '88',
            "description" => 'kpz',
            "class"       => static::getDtoClass(),
        ];
    }

    public function testPost(): void
    {
        $this->createFcr();
        $this->testResponseStatusCreated();
    }

    public function testCriteriaNotFound(): void
    {
        $find = $this->criteria(["class" => static::getDtoClass(), "active" => "e"]);
        $this->testResponseStatusNotFound();
        $this->assertArrayHasKey('data', $find);

        $find = $this->criteria(["class" => static::getDtoClass(), "id" => 49, "active" => "b", "description" => 'nvr5']);
        $this->testResponseStatusNotFound();
        $this->assertArrayHasKey('data', $find);
    }

    public function testCriteria(): void
    {
        $find = $this->criteria(["class" => static::getDtoClass(), "active" => "a", "id" => 48]);
        $this->testResponseStatusOK();
        $this->assertCount(1, $find['data']);

        $find = $this->criteria(["class" => static::getDtoClass(), "active" => "d"]);
        $this->testResponseStatusOK();
        $this->assertCount(3, $find['data']);

        $find = $this->criteria(["class" => static::getDtoClass(), "active" => "d", "description" => 'nvr']);
        $this->testResponseStatusOK();
        $this->assertCount(2, $find['data']);

        $find = $this->criteria(["class" => static::getDtoClass(), "id" => 49, "active" => "b", "description" => 'nvr']);
        $this->testResponseStatusOK();
        $this->assertCount(1, $find['data']);
    }

    public function testDelete(): void
    {
        $find = $this->assertGet(48);

        $this->assertEquals(ActiveModel::ACTIVE, $find['data']['active']);

        $this->delete(48);
        $this->testResponseStatusAccepted();

        $delete = $this->assertGet(48);

        $this->assertEquals(ActiveModel::DELETED, $delete['data']['active']);
    }

    public function testPut(): void
    {
        $find = $this->assertGet(48);

        $updated = $this->put(static::getDefault(['id' => 48, 'description' => 'ITE_48']));
        $this->testResponseStatusOK();

        $this->assertEquals($find['data']['id'], $updated['data']['id']);
        $this->assertEquals('ITE_48', $updated['data']['description']);
    }

    public function testGet(): void
    {
        $find = $this->assertGet(48);
    }

    public function testGetNotFound(): void
    {
        $response = $this->get(100);
        $this->assertArrayHasKey('data', $response);
        $this->testResponseStatusNotFound();
    }

    public function testDeleteNotFound(): void
    {
        $response = $this->delete(100);
        $this->assertArrayHasKey('data', $response);
        $this->testResponseStatusNotFound();
    }

    public function testDeleteUnprocessable(): void
    {
        $response = $this->delete('');
        $this->assertArrayHasKey('data', $response);
        $this->testResponseStatusUnprocessable();
    }

    public function testPutNotFound(): void
    {
        $this->put(static::getDefault(["id" => 100, "description" => "rcf",]));
        $this->testResponseStatusNotFound();
    }

    public function testPutUnprocessable(): void
    {
        $query = static::getDefault(['id' => '']);

        $this->put($query);
        $this->testResponseStatusUnprocessable();

        $this->createFcr();

        $query = static::getDefault(['description' => '']);

        $this->put($query);
        $this->testResponseStatusUnprocessable();
    }

    public function testPostDuplicate(): void
    {
        $this->createFcr();
        $this->testResponseStatusCreated();

        $this->createFcr();
        $this->testResponseStatusConflict();

        $this->createFcrDuplicateId();
        $this->testResponseStatusConflict();

        $this->createFcrDuplicateDescription();
        $this->testResponseStatusConflict();
    }

    public function testPostUnprocessable(): void
    {
        $this->postWrong();
        $this->testResponseStatusUnprocessable();

        $this->createConstraintBlankId();
        $this->testResponseStatusUnprocessable();

        $this->createConstraintBlankDescription();
        $this->testResponseStatusUnprocessable();
    }
//endregion Public

//region SECTION: Private
    private function assertGet(int $id): array
    {
        $find = $this->get($id);
        $this->testResponseStatusOK();

        $this->checkResult($find);

        return $find;
    }

    private function createFcr(): array
    {
        $query = static::getDefault();

        return $this->post($query);
    }

    private function createFcrDuplicateId(): array
    {
        $query = static::getDefault(['id' => '48']);

        return $this->post($query);
    }

    private function createFcrDuplicateDescription(): array
    {
        $query = static::getDefault(['description' => 'kzkt']);

        return $this->post($query);
    }

    private function createConstraintBlankId(): array
    {
        $query = static::getDefault(['id' => '']);

        return $this->post($query);
    }

    private function createConstraintBlankDescription(): array
    {
        $query = static::getDefault(['description' => '']);

        return $this->post($query);
    }

    private function checkResult($entity): void
    {
        $this->assertArrayHasKey('data', $entity);
        $this->assertArrayHasKey('id', $entity['data']);
        $this->assertArrayHasKey('description', $entity['data']);
        $this->assertArrayHasKey('active', $entity['data']);
    }
//endregion Private

//region SECTION: Getters/Setters
    public static function getFixtures(): array
    {
        return [FixtureInterface::FCR_FIXTURES];
    }

    public static function getDtoClass(): string
    {
        return FcrApiDto::class;
    }
//endregion Getters/Setters
}
