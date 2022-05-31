<?php

namespace Evrinoma\FcrBundle\Tests\Functional\ValueObject\Fcr;

use Evrinoma\TestUtilsBundle\ValueObject\Common\AbstractActive;
use Evrinoma\UtilsBundle\Model\ActiveModel;

class Active extends AbstractActive
{
    protected static string $default = ActiveModel::MODERATED;
}