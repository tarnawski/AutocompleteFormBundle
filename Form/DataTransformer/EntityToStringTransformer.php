<?php

namespace Tarnawski\Bundle\AutocompleteFormBundle\Form\DataTransformer;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Form\DataTransformerInterface;
use AppBundle\Entity\Tag;
use Symfony\Component\PropertyAccess\PropertyAccess;


class EntityToStringTransformer implements DataTransformerInterface
{
    /**
     * @var ObjectManager
     */
    private $om;
    private $entity_class;
    private $fieldName;
    private $non_exist_callback;
    /**
     * @param ObjectManager $om
     * @param $entity_class
     * @param $field_name
     * @param $non_exist_callback
     */
    public function __construct(ObjectManager $om, $entity_class, $field_name, $non_exist_callback)
    {
        // Object Manager
        $this->om = $om;
        // Name of class where looking for object
        $this->entity_class = $entity_class;
        // Name of field on which we search
        $this->fieldName = $field_name;
        // Action whew object not found
        $this->non_exist_callback = $non_exist_callback;
    }

    /**
     * @param mixed $rows
     * @return string
     */
    public function transform($rows)
    {
        $accessor = PropertyAccess::createPropertyAccessor();
        $list = '';
        $arrayValueOfRows=[];
        if ($rows) {
            foreach ($rows as $row) {
                $arrayValueOfRows[] = $accessor->getValue($row, $this->fieldName);
            }
            $list = implode(", ", $arrayValueOfRows);
        }

        return $list;
    }

    /**
     * @param mixed $string
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function reverseTransform($string)
    {
        $rows = new \Doctrine\Common\Collections\ArrayCollection();

        $arrayOfRows = explode(",", $string);
        foreach ($arrayOfRows as $nameOfRow) {
            $nameOfRow = trim($nameOfRow, ' ');
            $entity = $this->om->getRepository($this->entity_class)->findOneBy(array(
                $this->fieldName => $nameOfRow
            ));

            if (!$entity && is_callable($this->non_exist_callback)) {
                $callback = $this->non_exist_callback;
                $entity = $callback($this->om, $nameOfRow);
            }else{
                $rows->add($entity);
            }
        }

        return $rows;
    }
}
