<?php

namespace Tarnawski\Bundle\AutocompleteFormBundle\Form\DataTransformer;

use Doctrine\Common\Persistence\ManagerRegistry;

class TagsToStringTransformerFactory
{
    /**
     * @var ManagerRegistry
     */
    private $registry;

    public function __construct(ManagerRegistry $registry)
    {
        $this->registry = $registry;
    }

    public function create($om, $data_class, $field_name, $non_exist_callback = null)
    {
        return new TagsToStringTransformer($this->registry->getManager($om),$data_class, $field_name, $non_exist_callback);

    }
}
