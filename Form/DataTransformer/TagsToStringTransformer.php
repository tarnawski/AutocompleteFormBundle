<?php

namespace Tarnawski\Bundle\AutocompleteFormBundle\Form\DataTransformer;

use Doctrine\Common\Persistence\ObjectManager;

use Doctrine\Common\Collections\Collection;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;


class TagsToStringTransformer implements DataTransformerInterface
{
    /**
     * @var ObjectManager
     */
    private $om;
    private $data_class;
    private $fieldName;
    /**
     * @param ObjectManager $om
     * @param $data_class
     * @param $field_name
     */
    public function __construct(ObjectManager $om, $data_class, $field_name)
    {
        $this->om = $om;
        $this->data_class = $data_class;
        $this->fieldName = $field_name;
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
            $result = $this->om->getRepository($this->data_class)->findOneBy(array(
                $this->fieldName => $nameOfTag
            ));

            if (!$result) {
                //Action when tag don't exist
                $tag = new Tag();
                $tag->setName($nameOfTag);
                $tags->add($tag);


            } else {
                $tags->add($result);

            }

        }

        return $tags;
    }
}
