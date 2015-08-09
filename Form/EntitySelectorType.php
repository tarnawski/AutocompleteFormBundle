<?php

namespace Tarnawski\Bundle\AutocompleteFormBundle\Form;

use Tarnawski\Bundle\AutocompleteFormBundle\Form\DataTransformer\EntityToStringTransformerFactory;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Routing\RouterInterface;

class EntitySelectorType extends EntitySelectType
{
    private $factory;

    public function __construct(RouterInterface $router, EntityToStringTransformerFactory $factory)
    {
        parent::__construct($router);
        $this->factory = $factory;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $transformer = $this->factory->create($options['om'], $options['entity_class'], $options['field_name'], $options['non_exist_callback']);
        $builder->addModelTransformer($transformer);
    }

    public function getParent()
    {
        return 'text';
    }

    public function getName()
    {
        return 'object_selector';
    }
}
