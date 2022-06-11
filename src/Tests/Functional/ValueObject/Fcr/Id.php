<?php

namespace Evrinoma\FcrBundle\Tests\Functional\ValueObject\Fcr;

use Evrinoma\TestUtilsBundle\ValueObject\Common\AbstractId;

class Id extends AbstractId
{

    protected static string $value   = '48';
    protected static string $default = '88';


    public static function default(): string
    {
        return static::$default;
    }

}