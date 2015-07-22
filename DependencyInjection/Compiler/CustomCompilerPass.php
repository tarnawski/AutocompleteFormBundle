<?php

namespace Tarnawski\Bundle\AutocompleteFormBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\Definition;

class CustomCompilerPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        if (!$container->hasParameter('twig.form.resources')) {
            return;
        }
        $container->setParameter('twig.form.resources', array_merge(
            $container->getParameter('twig.form.resources'),
            array('TarnawskiAutocompleteFormBundle:Form:fields.html.twig')
        ));

        if (!$container->hasParameter('framework.templating.form.resources')) {
            return;
        }
        $container->setParameter('framework.templating.form.resources', array_merge(
            $container->getParameter('framework.templating.form.resources'),
            array('TarnawskiAutocompleteFormBundle:Form')
        ));

//        $definition = $container->setDefinition(
//            'tarnawski_autocomplete_form.type.tag_selector',
//            new Definition($container->getParameter('tarnawski_autocomplete_form.tag_selector_class'))
//        )

    }
}
