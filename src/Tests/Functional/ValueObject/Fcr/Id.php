<?php

namespace Evrinoma\FcrBundle\Tests\Functional\ValueObject\Fcr;

use Evrinoma\TestUtilsBundle\ValueObject\Common\AbstractId;

class Id extends AbstractId
{
//region SECTION: Fields
    protected static string $value   = '48';
    protected static string $default = '88';

//endregion Fields
//region SECTION: Public
    public static function default(): string
    {
        return static::$default;
    }
//endregion Public
}