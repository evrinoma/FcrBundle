<?php

namespace Evrinoma\FcrBundle\Tests\Functional\Controller;


use Evrinoma\FcrBundle\Dto\FcrApiDto;
use Evrinoma\FcrBundle\Tests\Functional\CaseTest;
use Evrinoma\TestUtilsBundle\Browser\ApiBrowserTestInterface;
use Evrinoma\TestUtilsBundle\Browser\ApiBrowserTestTrait;
use Evrinoma\TestUtilsBundle\Controller\ApiControllerTestInterface;
use Evrinoma\TestUtilsBundle\Helper\ApiHelperTestInterface;
use Evrinoma\TestUtilsBundle\Helper\ApiHelperTestTrait;

/**
 * @group functional
 */
class ApiControllerTest extends CaseTest implements ApiControllerTestInterface, ApiBrowserTestInterface, ApiHelperTestInterface
{
//region SECTION: Fields
    public const API_GET      = 'evrinoma/api/fcr';
    public const API_CRITERIA = 'evrinoma/api/fcr/criteria';
    public const API_DELETE   = 'evrinoma/api/fcr/delete';
    public const API_PUT      = 'evrinoma/api/fcr/save';
    public const API_POST     = 'evrinoma/api/fcr/create';
//endregion Fields

    use ApiBrowserTestTrait, ApiHelperTestTrait;

//region SECTION: Protected
    protected function getFixtures(): array
    {
        return [];
    }

    protected static function getDtoClass(): string
    {
        return FcrApiDto::class;
    }

    protected static function defaultData(): array
    {
        return [
            "class"      => static::getDtoClass(),
        ];
    }
//endregion Protected

//region SECTION: Public
    public function testCriteria(): void
    {

    }

    public function testCriteriaNotFound(): void
    {

    }

    public function testPut(): void
    {

    }

    public function testPutNotFound(): void
    {

    }

    public function testPutUnprocessable(): void
    {

    }

    public function testDelete(): void
    {

    }

    public function testDeleteNotFound(): void
    {

    }

    public function testDeleteUnprocessable(): void
    {

    }

    public function testGet(): void
    {

    }

    public function testGetNotFound(): void
    {

    }

    public function testPostIdentity(): void
    {

    }

    public function testPostIdenityDependency(): void
    {

    }

    public function testPostIdenityDependencyIsolate(): void
    {

    }

    public function testPostDuplicate(): void
    {

    }

    public function testPostUnprocessable(): void
    {

    }
//endregion Public
}
