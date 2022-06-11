<?php

namespace Evrinoma\FcrBundle\Tests\Functional\Controller;


use Evrinoma\FcrBundle\Fixtures\FixtureInterface;
use Evrinoma\TestUtilsBundle\Action\ActionTestInterface;
use Evrinoma\TestUtilsBundle\Functional\AbstractFunctionalTest;
use Psr\Container\ContainerInterface;


/**
 * @group functional
 */
final class ApiControllerTest extends AbstractFunctionalTest
{

    protected string $actionServiceName = 'evrinoma.fcr.test.functional.action.fcr';


    protected function getActionService(ContainerInterface $container): ActionTestInterface
    {
        return $container->get($this->actionServiceName);
    }


    public static function getFixtures(): array
    {
        return [FixtureInterface::FCR_FIXTURES];
    }

}