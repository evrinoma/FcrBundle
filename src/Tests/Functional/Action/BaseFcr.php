<?php

namespace Evrinoma\FcrBundle\Tests\Functional\Action;


use Evrinoma\FcrBundle\Dto\FcrApiDto;
use Evrinoma\FcrBundle\Tests\Functional\Helper\BaseFcrTestTrait;
use Evrinoma\FcrBundle\Tests\Functional\ValueObject\Fcr\Active;
use Evrinoma\FcrBundle\Tests\Functional\ValueObject\Fcr\Description;
use Evrinoma\FcrBundle\Tests\Functional\ValueObject\Fcr\Id;
use Evrinoma\TestUtilsBundle\Action\AbstractServiceTest;
use Evrinoma\UtilsBundle\Model\ActiveModel;
use PHPUnit\Framework\Assert;

class BaseFcr extends AbstractServiceTest implements BaseFcrTestInterface
{
    use BaseFcrTestTrait;


    public const API_GET      = 'evrinoma/api/fcr';
    public const API_CRITERIA = 'evrinoma/api/fcr/criteria';
    public const API_DELETE   = 'evrinoma/api/fcr/delete';
    public const API_PUT      = 'evrinoma/api/fcr/save';
    public const API_POST     = 'evrinoma/api/fcr/create';


    protected static function getDtoClass(): string
    {
        return FcrApiDto::class;
    }

    protected static function defaultData(): array
    {
        return [
            "id"          => Id::default(),
            "description" => Description::default(),
            "class"       => static::getDtoClass(),
        ];
    }


    public function actionPost(): void
    {
        $this->createFcr();
        $this->testResponseStatusCreated();
    }

    public function actionCriteriaNotFound(): void
    {
        $find = $this->criteria(["class" => static::getDtoClass(), "active" => Active::wrong()]);
        $this->testResponseStatusNotFound();
        Assert::assertArrayHasKey('data', $find);

        $find = $this->criteria(["class" => static::getDtoClass(), "id" => Id::value(), "active" => Active::block(), "description" => Description::wrong()]);
        $this->testResponseStatusNotFound();
        Assert::assertArrayHasKey('data', $find);
    }

    public function actionCriteria(): void
    {
        $find = $this->criteria(["class" => static::getDtoClass(), "active" => Active::value(), "id" => Id::value()]);
        $this->testResponseStatusOK();
        Assert::assertCount(1, $find['data']);

        $find = $this->criteria(["class" => static::getDtoClass(), "active" => Active::delete()]);
        $this->testResponseStatusOK();
        Assert::assertCount(3, $find['data']);

        $find = $this->criteria(["class" => static::getDtoClass(), "active" => Active::delete(), "description" => Description::value()]);
        $this->testResponseStatusOK();
        Assert::assertCount(2, $find['data']);

        $find = $this->criteria(["class" => static::getDtoClass(), "id" => 49, "active" => Active::block(), "description" => Description::value()]);
        $this->testResponseStatusOK();
        Assert::assertCount(1, $find['data']);
    }

    public function actionDelete(): void
    {
        $find = $this->assertGet(Id::value());

        Assert::assertEquals(ActiveModel::ACTIVE, $find['data']['active']);

        $this->delete(Id::value());
        $this->testResponseStatusAccepted();

        $delete = $this->assertGet(Id::value());

        Assert::assertEquals(ActiveModel::DELETED, $delete['data']['active']);
    }

    public function actionPut(): void
    {
        $find = $this->assertGet(Id::value());

        $updated = $this->put(static::getDefault(['id' => Id::value(), 'description' => Description::ITE_48()]));
        $this->testResponseStatusOK();

        Assert::assertEquals($find['data']['id'], $updated['data']['id']);
        Assert::assertEquals(Description::ITE_48(), $updated['data']['description']);
    }

    public function actionGet(): void
    {
        $find = $this->assertGet(Id::value());
    }

    public function actionGetNotFound(): void
    {
        $response = $this->get(Id::wrong());
        Assert::assertArrayHasKey('data', $response);
        $this->testResponseStatusNotFound();
    }

    public function actionDeleteNotFound(): void
    {
        $response = $this->delete(Id::wrong());
        Assert::assertArrayHasKey('data', $response);
        $this->testResponseStatusNotFound();
    }

    public function actionDeleteUnprocessable(): void
    {
        $response = $this->delete(Id::empty());
        Assert::assertArrayHasKey('data', $response);
        $this->testResponseStatusUnprocessable();
    }

    public function actionPutNotFound(): void
    {
        $this->put(static::getDefault(["id" => Id::wrong(), "description" => Description::rcf(),]));
        $this->testResponseStatusNotFound();
    }

    public function actionPutUnprocessable(): void
    {
        $query = static::getDefault(['id' => Id::empty()]);

        $this->put($query);
        $this->testResponseStatusUnprocessable();

        $this->createFcr();

        $query = static::getDefault(['description' => Description::empty()]);

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

}