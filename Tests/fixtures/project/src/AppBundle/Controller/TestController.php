<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Tag;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Form\Type\TestType;
use Symfony\Component\HttpFoundation\JsonResponse;

class TestController extends Controller
{
    public function indexAction(Request $request)
    {
        $tag = new Tag();
        $tag->setName(1);
        $form = $this->createForm(new TestType(), array(
            $tag
        ));
        $form->handleRequest($request);

        return $this->render('AppBundle:Test:index.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    public function getAction(Request $request)
    {
        $result = array("foo", "bar", "hello", "world");

        return JsonResponse::create($result);
    }
}
