<?php

namespace AppBundle\Form\Type;

use AppBundle\Entity\Tag;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Routing\RouterInterface;


class TestType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('tags', 'object_selector', [
            'endpoint_path' => 'get_tag',
         // 'endpoint_path_attr' => array('id' => 158)
            'endpoint_path_attr' => function(RouterInterface $router) {
                return $router->generate('get_tag', array('id'=> 100));
           },
            'entity_class' => 'AppBundle\Entity\Tag',
            'field_name' => 'name',
            'non_exist_callback' => function(EntityManager $manager, $string) {
                $tag = new Tag();
                $tag->setName($string);
                $manager->persist($tag);
                $manager->flush();
                return $tag;
            },
        ]);
        $builder->add('save', 'submit');
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'post';
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Tag'
        ));
    }
}
