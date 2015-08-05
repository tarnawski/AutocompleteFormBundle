<?php

namespace Tarnawski\Bundle\AutocompleteFormBundle\Form;

use Tarnawski\Bundle\AutocompleteFormBundle\Form\DataTransformer\TagsToStringTransformerFactory;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Routing\RouterInterface;
use Tarnawski\Bundle\AutocompleteFormBundle\Form\TagSelectType;

class TagSelectorType extends TagSelectType
{
    private $factory;

    public function __construct(RouterInterface $router, TagsToStringTransformerFactory $factory)
    {

        parent::__construct($router);
        $this->factory = $factory;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $transformer = $this->factory->create($options['om']);
        $builder->addModelTransformer($transformer);
    }


    public function getParent()
    {
        return 'text';
    }

    public function getName()
    {
        return 'tag_selector';
    }
}
