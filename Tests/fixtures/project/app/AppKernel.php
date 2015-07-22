<?php

use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Config\Loader\LoaderInterface;

class AppKernel extends Kernel
{
    public function registerBundles()
    {
        return array(
            new Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
            new Symfony\Bundle\TwigBundle\TwigBundle(),
            new Tarnawski\Bundle\AutocompleteFormBundle\TarnawskiAutocompleteFormBundle(),
            new AppBundle\AppBundle(),

        );

    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load(sprintf('%s/config/config.yml', __DIR__));
    }
    public function getCacheDir()
    {
        return sys_get_temp_dir() . '/TarnawskiAutocompleteFormBundle/cache';
    }
    public function getLogDir()
    {
        return sys_get_temp_dir() . '/TarnawskiAutocompleteFormBundle/logs';
    }
}
