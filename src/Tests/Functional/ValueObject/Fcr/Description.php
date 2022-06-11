<?php

namespace Evrinoma\FcrBundle\Tests\Functional\ValueObject\Fcr;

use Evrinoma\TestUtilsBundle\ValueObject\Common\AbstractIdentity;

class Description extends AbstractIdentity
{

    protected static string $value   = "nvr";
    protected static string $default = "kpz";


    public static function ITE_48(): string
    {
        return 'ITE_48';
    }

    public static function rcf(): string
    {
        return 'rcf';
    }
}