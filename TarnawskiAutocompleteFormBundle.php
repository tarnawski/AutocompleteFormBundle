<?php

namespace Tarnawski\Bundle\AutocompleteFormBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Tarnawski\Bundle\AutocompleteFormBundle\DependencyInjection\Compiler\CustomCompilerPass;

class TarnawskiAutocompleteFormBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        $container->addCompilerPass(new CustomCompilerPass());
    }
}
