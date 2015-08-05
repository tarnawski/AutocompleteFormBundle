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

    public function create($om)
    {
        return new TagsToStringTransformer($this->registry->getManager($om),'AppBundle\Model\Tag', 'field_name');

    }
}
