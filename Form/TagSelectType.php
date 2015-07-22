<?php

namespace Tarnawski\Bundle\AutocompleteFormBundle\Form;

use Acme\BlogBundle\Form\DataTransformer\TagsToStringTransformerFactory;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\Form\Exception\InvalidConfigurationException;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Routing\RouterInterface;

class TagSelectType extends AbstractType
{
    /***
     * @var RouterInterface
     */
    protected $router;

    public function __construct(RouterInterface $router)
    {
        $this->router = $router;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'invalid_message' => 'The selected issue does not exist',
            'om' => 'default'
        ));

        $resolver->setRequired([
            'endpoint_path'
        ]);

        $resolver->setDefined('endpoint_path_attr');
        $resolver->setAllowedTypes('endpoint_path', ['string']);
        $resolver->setAllowedTypes('endpoint_path_attr', ['array', 'callable']);
    }

    /**
     * {@inheritdoc}
     */
    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        if (isset($options['endpoint_path_attr'])) {
            if (is_array($options['endpoint_path_attr'])) {
                $view->vars['endpoint_path'] = $this->router->generate(
                    $options['endpoint_path'],
                    $options['endpoint_path_attr'],
                    false
                );
            }else {
                $router = $this->router;
                $view->vars['endpoint_path'] = call_user_func($options['endpoint_path_attr'], $router);
            }
        }else{
            $view->vars['endpoint_path']=$options['endpoint_path'];
        }
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
