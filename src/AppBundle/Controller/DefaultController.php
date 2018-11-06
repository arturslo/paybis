<?php

namespace AppBundle\Controller;

use AppBundle\Form\DividerRequestFormType;
use AppBundle\StringDivider\DividerRequest;
use AppBundle\StringDivider\StringDivider;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $dividerRequest = new DividerRequest('', 1);

        $form = $this->createForm(DividerRequestFormType::class, $dividerRequest);
        $substringCollection = null;

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $stringDivider = new StringDivider();
            $substringCollection = $stringDivider->divideIntoSubstrings($dividerRequest);
        }

        return $this->render('default/index.html.twig', [
            'form' => $form->createView(),
            'substringCollection' => $substringCollection
        ]);
    }
}
