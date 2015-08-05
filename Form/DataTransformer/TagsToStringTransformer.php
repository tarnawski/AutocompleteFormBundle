<?php

namespace Tarnawski\Bundle\AutocompleteFormBundle\Form\DataTransformer;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Form\DataTransformerInterface;
use AppBundle\Entity\Tag;

class TagsToStringTransformer implements DataTransformerInterface
{
    /**
     * @var ObjectManager
     */
    private $om;
    private $data_class;
    private $fieldName;
    private $non_exist_callback;
    /**
     * @param ObjectManager $om
     * @param $data_class
     * @param $field_name
     * @param $non_exist_callback
     */
    public function __construct(ObjectManager $om, $data_class, $field_name, $non_exist_callback)
    {
        $this->om = $om;
        $this->data_class = $data_class;
        $this->fieldName = $field_name;
        $this->non_exist_callback = $non_exist_callback;
    }

    /**
     * @param Tag collection $tags
     * @return String
     */
    public function transform($tags)
    {
        $list = '';
        if ($tags) {
            foreach ($tags as $tag) {
                $list = $tag->getName() . ', ' . $list;
            }
        }

        return $list;
    }

    /**
     *
     * @param string $string String to transform
     *
     * @return Tag $tag
     *
     */
    public function reverseTransform($string)
    {
        $tags = new \Doctrine\Common\Collections\ArrayCollection();

        $arrayOfTags = explode(",", $string);
        foreach ($arrayOfTags as $nameOfTag) {
            $entity = $this->om->getRepository($this->data_class)->findOneBy(array(
                $this->fieldName => $nameOfTag
            ));

            if (!$entity && is_callable($this->non_exist_callback)) {
                $callback = $this->non_exist_callback;
                $entity = $callback($this->om, $nameOfTag);
            }

            $tags->add($entity);
        }

        return $tags;
    }
}
