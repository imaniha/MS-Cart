<?php

namespace Stub\StubCartBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;

use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use FOS\RestBundle\Controller\Annotations\Get;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\View\View;
use Symfony\Component\Form\Form;
use Rdc\Cart\CartBusinessBundle\Entity\Cart;
use Rdc\Cart\CartApiBundle\Exception\FormValidationException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class DefaultController extends FOSRestController
{
    /**
     * Return Cart content
     *
     * @Get("stub/carts",requirements={"_format"="json"},defaults={"_format" = "json"}, name="stub_get_carts")
     *
     * @ApiDoc(
     *  resource=true,
     *  description="Return all Carts",
     *  section="Stub",
     *  statusCodes={
     *      200="Returned when successful",
     *      400="Returned when the url is malformed",
     *      500="Returned when a technical error occurs, request must be retry"
     *  }
     * )
     *
     * @return array
     */
    public function getCartsAction(Request $request)
    {
        $carts = $this->getDoctrine()->getRepository('CartBusinessBundle:Cart')->findAll();

        $view = $this->view($carts, 200);

        return $this->handleView($view);
    }
}
