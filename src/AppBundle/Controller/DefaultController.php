<?php

namespace AppBundle\Controller;

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
        $inputString = 'abcd';
        $minimalSubstringLength = 2;

        $dividerRequest = new DividerRequest($inputString, $minimalSubstringLength);
        $stringDivider = new StringDivider();
        $res = $stringDivider->divideIntoSubstrings($dividerRequest);
        dump($res);

        return new Response();
    }
}
