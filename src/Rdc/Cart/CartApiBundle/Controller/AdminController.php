<?php

namespace Rdc\Cart\CartApiBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\Request;

class AdminController extends FOSRestController
{


    /**
     * Return Cart content
     *
     * @Get("status",requirements={"_format"="json"},defaults={"_format" = "json"}, name="get_status")
     * @ApiDoc(

     *  description="Return Cart API status",
     *  section="Status",
     *  statusCodes={
     *      200="Returned when successful",
     *      400="Returned when a technical issue occurs",
     *      500="Returned when a technical error occurs, request must be retry"
     *  }
     * )
     *
     * @return array
     */
    public function statusAction(Request $request)
    {
        $data = [
            'success' => true
        ];

        $view = $this->view($data, 200);

        return $this->handleView($view);
    }
}
