<?php

namespace Evrinoma\FcrBundle;


use Evrinoma\FcrBundle\DependencyInjection\EvrinomaFcrExtension;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class EvrinomaFcrBundle extends Bundle
{
//region SECTION: Fields
    public const FCR_BUNDLE = 'fcr';
//endregion Fields

//region SECTION: Getters/Setters
    public function getContainerExtension()
    {
        if (null === $this->extension) {
            $this->extension = new EvrinomaFcrExtension();
        }

        return $this->extension;
    }
//endregion Getters/Setters


}