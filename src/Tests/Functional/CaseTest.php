<?php

namespace Evrinoma\FcrBundle\Tests\Functional;

use Evrinoma\TestUtilsBundle\Web\AbstractWebCaseTest;

/**
 * TestCase.
 */
abstract class CaseTest extends AbstractWebCaseTest
{
//region SECTION: Protected
    /**
     * {@inheritdoc}
     */
    protected static function createKernel(array $options = [])
    {
        require_once __DIR__.'/Kernel.php';

        return new Kernel('test', true);
    }
//endregion Protected
}
