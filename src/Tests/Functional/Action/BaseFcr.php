<?php

namespace Evrinoma\FcrBundle\Tests\Functional\Action;


use Evrinoma\FcrBundle\Dto\FcrApiDto;
use Evrinoma\FcrBundle\Tests\Functional\Helper\BaseFcrTestTrait;
use Evrinoma\TestUtilsBundle\Action\AbstractServiceTest;
use Evrinoma\UtilsBundle\Model\ActiveModel;
use PHPUnit\Framework\Assert;

class BaseFcr extends AbstractServiceTest implements BaseFcrTestInterface
{
    use BaseFcrTestTrait;

//region SECTION: Fields
    public const API_GET      = 'evrinoma/api/fcr';
    public const API_CRITERIA = 'evrinoma/api/fcr/criteria';
    public const API_DELETE   = 'evrinoma/api/fcr/delete';
    public const API_PUT      = 'evrinoma/api/fcr/save';
    public const API_POST     = 'evrinoma/api/fcr/create';
//endregion Fields

//region SECTION: Protected
    protected static function getDtoClass(): string
    {
        return FcrApiDto::class;
    }

    protected static function defaultData(): array
    {
        return [
            "id"          => '88',
            "description" => 'kpz',
            "class"       => static::getDtoClass(),
        ];
    }
//endregion Protected

//region SECTION: Public
    public function actionPost(): void
    {
        $this->createFcr();
        $this->testResponseStatusCreated();
    }

    public function actionCriteriaNotFound(): void
    {
        $find = $this->criteria(["class" => static::getDtoClass(), "active" => "e"]);
        $this->testResponseStatusNotFound();
        Assert::assertArrayHasKey('data', $find);

        $find = $this->criteria(["class" => static::getDtoClass(), "id" => 49, "active" => "b", "description" => 'nvr5']);
        $this->testResponseStatusNotFound();
        Assert::assertArrayHasKey('data', $find);
    }

    public function actionCriteria(): void
    {
        $find = $this->criteria(["class" => static::getDtoClass(), "active" => "a", "id" => 48]);
        $this->testResponseStatusOK();
        Assert::assertCount(1, $find['data']);

        $find = $this->criteria(["class" => static::getDtoClass(), "active" => "d"]);
        $this->testResponseStatusOK();
        Assert::assertCount(3, $find['data']);

        $find = $this->criteria(["class" => static::getDtoClass(), "active" => "d", "description" => 'nvr']);
        $this->testResponseStatusOK();
        Assert::assertCount(2, $find['data']);

        $find = $this->criteria(["class" => static::getDtoClass(), "id" => 49, "active" => "b", "description" => 'nvr']);
        $this->testResponseStatusOK();
        Assert::assertCount(1, $find['data']);
    }

    public function actionDelete(): void
    {
        $find = $this->assertGet(48);

        Assert::assertEquals(ActiveModel::ACTIVE, $find['data']['active']);

        $this->delete(48);
        $this->testResponseStatusAccepted();

        $delete = $this->assertGet(48);

        Assert::assertEquals(ActiveModel::DELETED, $delete['data']['active']);
    }

    public function actionPut(): void
    {
        $find = $this->assertGet(48);

        $updated = $this->put(static::getDefault(['id' => 48, 'description' => 'ITE_48']));
        $this->testResponseStatusOK();

        Assert::assertEquals($find['data']['id'], $updated['data']['id']);
        Assert::assertEquals('ITE_48', $updated['data']['description']);
    }

    public function actionGet(): void
    {
        $find = $this->assertGet(48);
    }

    public function actionGetNotFound(): void
    {
        $response = $this->get(100);
        Assert::assertArrayHasKey('data', $response);
        $this->testResponseStatusNotFound();
    }

    public function actionDeleteNotFound(): void
    {
        $response = $this->delete(100);
        Assert::assertArrayHasKey('data', $response);
        $this->testResponseStatusNotFound();
    }

    public function actionDeleteUnprocessable(): void
    {
        $response = $this->delete('');
        Assert::assertArrayHasKey('data', $response);
        $this->testResponseStatusUnprocessable();
    }

    public function actionPutNotFound(): void
    {
        $this->put(static::getDefault(["id" => 100, "description" => "rcf",]));
        $this->testResponseStatusNotFound();
    }

    public function actionPutUnprocessable(): void
    {
        $query = static::getDefault(['id' => '']);

        $this->put($query);
        $this->testResponseStatusUnprocessable();

        $this->createFcr();

        $query = static::getDefault(['description' => '']);

        $this->put($query);
        $this->testResponseStatusUnprocessable();
    }

    public function actionPostDuplicate(): void
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

    public function actionPostUnprocessable(): void
    {
        $this->postWrong();
        $this->testResponseStatusUnprocessable();

        $this->createConstraintBlankId();
        $this->testResponseStatusUnprocessable();

        $this->createConstraintBlankDescription();
        $this->testResponseStatusUnprocessable();
    }
//endregion Public
}