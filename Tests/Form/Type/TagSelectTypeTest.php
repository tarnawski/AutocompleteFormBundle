<?php

namespace Tarnawski\Bundle\AutocompleteFormBundle\Tests\Form;

use Tarnawski\Bundle\AutocompleteFormBundle\Form\TagSelectType;

class TagSelectTypeTest extends \PHPUnit_Framework_TestCase
{

    public function testSetDefaultOptions()
    {
        $registry = $this->getMock('Doctrine\Common\Persistence\ManagerRegistry');
        $resolver = $this->getMock('Symfony\Component\OptionsResolver\OptionsResolver');
        $resolver->expects($this->once())->method('setDefaults');
        $type = new TagSelectType($registry);
        $type->setDefaultOptions($resolver);
    }

    public function testSetRequired()
    {
        $registry = $this->getMock('Doctrine\Common\Persistence\ManagerRegistry');
        $resolver = $this->getMock('Symfony\Component\OptionsResolver\OptionsResolver');
        $resolver->expects($this->once())->method('setRequired');
        $type = new TagSelectType($registry);
        $type->setDefaultOptions($resolver);
    }

    public function testSetAllowedTypes()
    {
        $registry = $this->getMock('Doctrine\Common\Persistence\ManagerRegistry');
        $resolver = $this->getMock('Symfony\Component\OptionsResolver\OptionsResolver');
        $resolver->expects($this->once())->method('setAllowedTypes');
        $type = new TagSelectType($registry);
        $type->setDefaultOptions($resolver);
    }

    public function testGetParent()
    {
        $registry = $this->getMock('Doctrine\Common\Persistence\ManagerRegistry');
        $type = new TagSelectType($registry);
        $this->assertEquals('text', $type->getParent());
    }

    public function testGetName()
    {
        $registry = $this->getMock('Doctrine\Common\Persistence\ManagerRegistry');
        $type = new TagSelectType($registry);
        $this->assertEquals('tag_selector', $type->getName());
    }
}