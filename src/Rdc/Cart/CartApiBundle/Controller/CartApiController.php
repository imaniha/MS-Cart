<?php

namespace Rdc\Cart\CartApiBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\Post;
use FOS\RestBundle\Controller\Annotations\Delete;
use FOS\RestBundle\Controller\Annotations\Put;
use FOS\RestBundle\View\View;
use Symfony\Component\Form\Form;
use Rdc\Cart\CartBusinessBundle\Entity\Cart;
use Rdc\Cart\CartBusinessBundle\Vo\Address;
use Rdc\Cart\CartBusinessBundle\Vo\Item;
use Rdc\Cart\CartBusinessBundle\Vo\Customer;
use Rdc\Cart\CartApiBundle\Form\CartType;
use Rdc\Cart\CartApiBundle\Form\ItemType;
use Rdc\Cart\CartApiBundle\Form\CartAddressType;
use Rdc\Cart\CartApiBundle\Form\CartPaymentType;
use Rdc\Cart\CartApiBundle\Form\CartDeliveryMethodType;
use Rdc\Cart\CartApiBundle\Form\CartCustomerType;
use Rdc\Cart\CartApiBundle\Form\CartItemsType;
use Rdc\Cart\CartApiBundle\Form\DeliveryMethodType;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations\Version;
use Rdc\Cart\CartApiBundle\Exception\FormValidationException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * Class CartApiController
 *
 */
class CartApiController extends FOSRestController
{

    /**
     * @Get("/", name="cart_api")
     * @Template("@CartApi/default/index.html.twig")
     */

    public function defaultAction()
    {

        return [];
    }

    /**
     * Create new Cart
     *
     *
     * **Request Format**
     *<pre>
     *{
     *  "cart": {
     *    "channel": "desktop",
     *    "status": "draft",
     *    "shop_id": 1,
     *    "extra": "extra data 1",
     *    "extra2": "extra data 2"
     *  }
     *}
     *</pre>
     *
     * @Post("cart",requirements={"_format"="json"},defaults={"_format" = "json"}, name="post_cart")
     *
     * @ApiDoc(
     *
     *  input={
     *       "class"="Rdc\Cart\CartBusinessBundle\Entity\Cart",
     *       "groups"={"nelmio"},
     *       "parsers"={
     *         "Nelmio\ApiDocBundle\Parser\JmsMetadataParser"
     *       }
     *     },
     *  output={
     *       "class"="Rdc\Cart\CartBusinessBundle\Entity\Cart",
     *       "parsers"={
     *         "Nelmio\ApiDocBundle\Parser\JmsMetadataParser"
     *       }
     *     },
     *  resource=true,
     *  description="Create new Cart",
     *  section="Cart",
     *
     *  statusCodes={
     *      200="Returned when successful",
     *      400="Returned when a business exception occurred",
     *      500="Returned when a technical error occurs, request must be retry"
     *  },
     *
     * )
     *
     * @return array
     */

    public function postCartAction(Request $request)
    {
        $cartRepository = $this->getRepository('CartBusinessBundle:Cart');
        $cart = $cartRepository->createEntity();
        $form = $this->createForm(CartType::class, $cart);
        $form->handleRequest($request);

        try {
            $this->validateForm($form);
            $cart = $this->getCartBusiness()->createCart($cart);
            $view = $this->view($cart, 200);

        } catch (FormValidationException $exception) {
            $view = $this->view($form, 400);
        } catch (\Exception $exception) {
            $data = ['success' => false, 'message' => $exception->getMessage()];
            $view = $this->view($data, 400);
        }

        return $this->handleView($view);
    }

    /**
     * Return Cart content
     *
     * @Get("cart/{cart_id}",requirements={"_format"="json", "cart_id": "\d+"},defaults={"_format" = "json"}, name="get_cart")
     * @ParamConverter("cart", class="CartBusinessBundle:Cart")
     *
     * @ApiDoc(
     *  resource=true,
     *  description="Return Cart content",
     *  output={
     *       "class"="Rdc\Cart\CartBusinessBundle\Entity\Cart",
     *       "parsers"={
     *         "Nelmio\ApiDocBundle\Parser\JmsMetadataParser"
     *       }
     *     },
     *  section="Cart",
     *  statusCodes={
     *      200="Returned when successful",
     *      400="Returned when a business exception occurred",
     *      500="Returned when a technical error occurs, request must be retry"
     *  }
     * )
     *
     * @return array
     */
    public function getCartAction(Cart $cart)
    {
        $view = $this->view($cart, 200);

        return $this->handleView($view);
    }

    /**
     * Add customer to Cart
     *
     * **Request Format**
     *<pre>
     * {
     *   "cart":{
     *     "customer": {
     *       "customer_id": 12,
     *       "email": "nicolas.rozen@rueducommerce.fr",
     *       "firstname": "Nicolas",
     *       "lastname": "Rozen",
     *       "additional_data": {
     *           "extra1": "data extra1",
     *           "extra2": "data extra2"
     *       }
     *     }
     *   }
     * }
     *</pre>
     *
     * @Post("cart/{cart_id}/customer",requirements={"_format"="json|xml|html"},defaults={"_format" = "json"}, name="add_customer_to_cart")
     * @ParamConverter("cart", class="CartBusinessBundle:Cart")
     * @ApiDoc(
     *  resource=true,
     *  input={
     *       "class"="Rdc\Cart\CartBusinessBundle\Vo\Customer",
     *       "groups"={"nelmio"},
     *       "parsers"={
     *         "Nelmio\ApiDocBundle\Parser\JmsMetadataParser",
     *         "Nelmio\ApiDocBundle\Parser\ValidationParser"
     *       }
     *     },
     *  output={
     *       "class"="Rdc\Cart\CartBusinessBundle\Entity\Cart",
     *       "parsers"={
     *         "Nelmio\ApiDocBundle\Parser\JmsMetadataParser"
     *       }
     *     },
     *  description="Add customer to Cart",
     *  section="Customer",
     *  statusCodes={
     *      200="Returned when successful",
     *      400="Returned when a business exception occurred",
     *      500="Returned when a technical error occurs, request must be retry"
     *  }
     * )
     *
     * @return array
     */
    public function addCustomerAction(Request $request, Cart $cart)
    {
        $form = $this->createForm(CartCustomerType::class, $cart);

        $form->handleRequest($request);

        try {
            $this->validateForm($form);
            $cart = $this->getCartBusiness()->createCart($cart);
            $view = $this->view($cart, 200);

        } catch (FormValidationException $exception) {
            $view = $this->view($form, 400);
        } catch (\Exception $exception) {
            $data = ['success' => false, 'message' => $exception->getMessage()];
            $view = $this->view($data, 400);
        }

        return $this->handleView($view);
    }

    /**
     * Add items to Cart
     *
     * **Request Format**
     *<pre>
     *{
     *  "cart": {
     *    "items": [{
     *      "offer_id": 3,
     *      "quantity": 3,
     *      "name": "clavier",
     *      "price": 100,
     *      "image": "http://www.rueducommerce.fr/mon_image.jpg",
     *      "merchant_id": 178,
     *      "merchant_name": "Rue du commerce",
     *      "brand_id": 493,
     *      "brand_name": "Corsair",
     *      "attributes": {
     *        "field1": "value1",
     *        "field2": "value2"
     *      },
     *      "stock": 12,
     *      "managed_stock": true,
     *      "product_url": "/product1.php",
     *      "reference": {
     *        "field1": "value1",
     *        "field2": "value2"
     *      },
     *      "additional_data": {
     *        "extra1": "data extra1",
     *        "extra2": "data extra2"
     *      }
     *    }]
     *  }
     *}
     *</pre>
     * @Post("cart/{cart_id}/item",requirements={"_format"="json", "cart_id": "\d+"},defaults={"_format" = "json"}, name="add_item_to_cart")
     * @ParamConverter("cart", class="CartBusinessBundle:Cart")
     * @ApiDoc(
     *  resource=true,
     *  input={
     *       "class"="Rdc\Cart\CartBusinessBundle\Vo\Item",
     *       "groups"={"nelmio"},
     *       "parsers"={
     *         "Nelmio\ApiDocBundle\Parser\JmsMetadataParser",
     *         "Nelmio\ApiDocBundle\Parser\ValidationParser"
     *       }
     *     },
     *  output={
     *       "class"="Rdc\Cart\CartBusinessBundle\Entity\Cart",
     *       "parsers"={
     *         "Nelmio\ApiDocBundle\Parser\JmsMetadataParser"
     *       }
     *     },
     *  description="Add an item to Cart",
     *  section="Item",
     *  statusCodes={
     *      200="Returned when successful",
     *      400="Returned when a business exception occurred",
     *      500="Returned when a technical error occurs, request must be retry"
     *  }
     * )
     *
     * @return array
     */
    public function addItemAction(Request $request, Cart $cart)
    {
        $form = $this->createForm(CartItemsType::class, $cart);
        $form->handleRequest($request);

        try {
            $this->validateForm($form);
            $cart = $this->getCartBusiness()->createCart($cart);
            $view = $this->view($cart, 200);

        } catch (FormValidationException $exception) {
            $view = $this->view($form, 400);
        } catch (\Exception $exception) {
            $data = ['success' => false, 'message' => $exception->getMessage()];
            $view = $this->view($data, 400);
        }

        return $this->handleView($view);
    }

    /**
     * Update Cart Item
     *
     * **Request Format**
     *<pre>
     *{
     *  "cart": {
     *    "items": [{
     *      "item_id": 12,
     *      "offer_id": 3,
     *      "quantity": 3,
     *      "name": "clavier",
     *      "price": 100,
     *      "image": "http://www.rueducommerce.fr/mon_image.jpg",
     *      "merchant_id": 178,
     *      "merchant_name": "Rue du commerce",
     *      "brand_id": 493,
     *      "brand_name": "Corsair",
     *      "attributes": {
     *        "field1": "value1",
     *        "field2": "value2"
     *      },
     *      "stock": 12,
     *      "managed_stock": true,
     *      "product_url": "/product1.php",
     *      "reference": {
     *        "field1": "value1",
     *        "field2": "value2"
     *      },
     *      "additional_data": {
     *        "extra1": "data extra1",
     *        "extra2": "data extra2"
     *      }
     *    }]
     *  }
     *}
     *</pre>
     * @Put("cart/{cart_id}/item",requirements={"_format"="json", "cart_id": "\d+"},defaults={"_format" = "json"}, name="add_item_to_cart")
     * @ParamConverter("cart", class="CartBusinessBundle:Cart")
     * @ApiDoc(
     *  resource=true,
     *  input={
     *       "class"="Rdc\Cart\CartBusinessBundle\Vo\Item",
     *       "groups"={"nelmio"},
     *       "parsers"={
     *         "Nelmio\ApiDocBundle\Parser\JmsMetadataParser",
     *         "Nelmio\ApiDocBundle\Parser\ValidationParser"
     *       }
     *     },
     *  output={
     *       "class"="Rdc\Cart\CartBusinessBundle\Entity\Cart",
     *       "parsers"={
     *         "Nelmio\ApiDocBundle\Parser\JmsMetadataParser"
     *       }
     *     },
     *  description="Update Cart Items",
     *  section="Item",
     *  statusCodes={
     *      201="Returned when successful",
     *      400="Returned when a business exception occurred",
     *      500="Returned when a technical error occurs, request must be retry"
     *  }
     * )
     *
     * @return array
     */
    public function updateItemAction(Request $request, Cart $cart)
    {
        $form = $this->createForm(CartItemsType::class, $cart, ['method'=>$request->getMethod()]);
        $form->handleRequest($request);

        try {
            $this->validateForm($form);
            $cart = $this->getCartBusiness()->createCart($cart);
            $view = $this->view($cart, 201);

        } catch (FormValidationException $exception) {
            $view = $this->view($form, 400);
        } catch (\Exception $exception) {
            $data = ['success' => false, 'message' => $exception->getMessage()];
            $view = $this->view($data, 400);
        }

        return $this->handleView($view);
    }

    /**
     * Return Cart content
     *
     * @Get("cart/{cart_id}/summary",requirements={"_format"="json", "cart_id": "\d+"},defaults={"_format" = "json"}, name="get_cart_summary")
     * @ParamConverter("cart", class="CartBusinessBundle:Cart")
     * @ApiDoc(
     *  resource=true,
     *  output={
     *       "class"="Rdc\Cart\CartBusinessBundle\Entity\Cart",
     *       "parsers"={
     *         "Nelmio\ApiDocBundle\Parser\JmsMetadataParser"
     *       }
     *     },
     *  description="Return Cart summary content",
     *  section="Cart",
     *  statusCodes={
     *      200="Returned when successful",
     *      400="Returned when a business exception occurred",
     *      500="Returned when a technical error occurs, request must be retry"
     *  }
     * )
     *
     * @return array
     */
    public function getCartSummaryAction($cart)
    {
        $view = $this->view($cart, 200);

        return $this->handleView($view);
    }

    /**
     * Add address to Cart
     *
     * Add "items" attribute that contains a collection of items to affect the address to a set of items
     *
     * **Request Format**
     *<pre>
     * {
     *   "cart":{
     *     "address": [{
     *       "address_id": 1,
     *       "type": "billing_address",
     *       "firstname": "Nicolas",
     *       "lastname": "Rozen",
     *       "address1": "12 rue roger poncelet",
     *       "city": "Asnières sur seine",
     *       "zip": "92600",
     *       "country_code": "FR",
     *       "country_label": "France",
     *       "phone": "0148317726",
     *       "mobile_phone": "0670142201",
     *       "work_phone": "",
     *       "fax": "",
     *       "rcs": "",
     *       "access_code": "",
     *       "items": [{"id":1}, {"id": 2}],
     *       "additional_data": {
     *           "extra1": "data extra1",
     *           "extra2": "data extra2"
     *       }
     *     }]
     *   }
     * }
     *</pre>
     *
     * @Post("cart/{cart_id}/address",requirements={"_format"="json", "cart_id": "\d+"},defaults={"_format" = "json"}, name="add_address_to_cart")
     * @ParamConverter("cart", class="CartBusinessBundle:Cart")
     * @ApiDoc(
     *  resource=true,
     *  description="Add address to Cart",
     *
     *  input={
     *       "class"="Rdc\Cart\CartBusinessBundle\Vo\Address",
     *       "parsers"={
     *         "Nelmio\ApiDocBundle\Parser\ValidationParser"
     *       }
     *     },
     *  output={
     *       "class"="Rdc\Cart\CartBusinessBundle\Entity\Cart",
     *       "parsers"={
     *         "Nelmio\ApiDocBundle\Parser\JmsMetadataParser"
     *       }
     *     },
     *  section="Address",
     *  statusCodes={
     *      200="Returned when successful",
     *      400="Returned when a business exception occurred",
     *      500="Returned when a technical error occurs, request must be retry"
     *  }
     * )
     *
     * @return array
     */
    public function addAddressAction(Request $request, Cart $cart)
    {
        $form = $this->createForm(CartAddressType::class, $cart);

        $form->handleRequest($request);

        try {
            $this->validateForm($form);
            $cart = $this->getCartBusiness()->createCart($cart);
            $view = $this->view($cart, 200);

        } catch (FormValidationException $exception) {
            $view = $this->view($form, 400);
        } catch (\Exception $exception) {
            $data = ['success' => false, 'message' => $exception->getMessage()];
            $view = $this->view($data, 400);
        }

        return $this->handleView($view);
    }

    /**
     * Add payment to Cart
     *
     * **Request Format**
     *<pre>
     * {
     *   "cart":{
     *     "payment": {
     *       "type_id": 1,
     *       "type_name": "CB",
     *       "additional_data": {
     *           "extra1": "data extra1",
     *           "extra2": "data extra2"
     *       }
     *     }
     *   }
     * }
     *</pre>
     *
     * @Post("cart/{cart_id}/payment",requirements={"_format"="json", "cart_id": "\d+"},defaults={"_format" = "json"}, name="add_payment_to_cart")
     * @ParamConverter("cart", class="CartBusinessBundle:Cart")
     * @ApiDoc(
     *  resource=true,
     *  description="Add payment to Cart",
     *
     *  input={
     *       "class"="Rdc\Cart\CartBusinessBundle\Vo\Payment",
     *       "groups"={"nelmio"},
     *       "parsers"={
     *         "Nelmio\ApiDocBundle\Parser\ValidationParser"
     *       }
     *     },
     *  output={
     *       "class"="Rdc\Cart\CartBusinessBundle\Entity\Cart",
     *       "parsers"={
     *         "Nelmio\ApiDocBundle\Parser\JmsMetadataParser"
     *       }
     *     },
     *  section="Payment",
     *  statusCodes={
     *      200="Returned when successful",
     *      400="Returned when a business exception occurred",
     *      500="Returned when a technical error occurs, request must be retry"
     *  }
     * )
     *
     * @return array
     */
    public function addPaymentAction(Request $request, Cart $cart)
    {
        $form = $this->createForm(CartPaymentType::class, $cart);

        $form->handleRequest($request);

        try {
            $this->validateForm($form);
            $cart = $this->getCartBusiness()->createCart($cart);
            $view = $this->view($cart, 200);

        } catch (FormValidationException $exception) {
            $view = $this->view($form, 400);
        } catch (\Exception $exception) {
            $data = ['success' => false, 'message' => $exception->getMessage()];
            $view = $this->view($data, 400);
        }

        return $this->handleView($view);
    }

    /**
     * Add delivery method to Cart
     *
     * Add "items" attribute that contains a collection of items to affect the delivery method to a set of items
     * Add "stores" attribute that contains a collection of store to affect the delivery method to a set of items belonging to the stores
     *
     * **Request Format**
     *<pre>
     * {
     *   "cart":{
     *     "delivery_methods": [{
     *       "type_id": 73715780,
     *       "type_name": "Livraison express à domicile par Chronopost",
     *       "items": [{"id":1}, {"id": 2}],
     *       "stores": [{"id":1}, {"id": 2}],
     *       "additional_data": {
     *           "delivery_method_id": 1245,
     *           "delivery_method_amount": 10.20,
     *           "delivery_method_delivery_id": "4-BE-Livraison express à domicile par Chronopost"
     *       }
     *     }]
     *   }
     * }
     *</pre>
     *
     * @Post("cart/{cart_id}/deliverymethod",requirements={"_format"="json", "cart_id": "\d+"},defaults={"_format" = "json"})
     * @ParamConverter("cart", class="CartBusinessBundle:Cart")
     * @ApiDoc(
     *  resource=true,
     *  description="Add delivery method to Cart",
     *
     *  input={
     *       "class"="Rdc\Cart\CartBusinessBundle\Vo\DeliveryMethod",
     *       "groups"={"nelmio"},
     *       "parsers"={
     *         "Nelmio\ApiDocBundle\Parser\ValidationParser"
     *       }
     *     },
     *  output={
     *       "class"="Rdc\Cart\CartBusinessBundle\Entity\Cart",
     *       "parsers"={
     *         "Nelmio\ApiDocBundle\Parser\JmsMetadataParser"
     *       }
     *     },
     *  section="Delivery method",
     *  statusCodes={
     *      200="Returned when successful",
     *      400="Returned when a business exception occurred",
     *      500="Returned when a technical error occurs, request must be retry"
     *  }
     * )
     *
     * @return array
     */
    public function addDeliveryMethodAction(Request $request, Cart $cart)
    {
        $form = $this->createForm(CartDeliveryMethodType::class, $cart);

        $form->handleRequest($request);

        try {
            $this->validateForm($form);
            $cart = $this->getCartBusiness()->createCart($cart);
            $view = $this->view($cart, 200);

        } catch (FormValidationException $exception) {
            $view = $this->view($form, 400);
        } catch (\Exception $exception) {
            $data = ['success' => false, 'message' => $exception->getMessage()];
            $view = $this->view($data, 400);
        }

        return $this->handleView($view);
    }

    /**
     * Add promotion to cart
     *
     * **Request Format**
     *<pre>
     * {
     *   "cart":{
     *     "promotion":[
     *     {
     *       "promotion_rule": [
     *         {
     *           "site_id": "0",
     *           "threshold_amount": "300",
     *           "creation_user_id": "0",
     *           "modification_user_id": "0",
     *           "ts_insert": "2013-07-01 00:00:00",
     *           "ts_last_change": "2014-01-13 05:54:58",
     *           "store_mode": "include"
     *         }
     *         ],
     *         "promotion_data": {
     *         "id": "26",
     *         "code": "10euros",
     *         "from_date": "2009-02-12 00:00:00",
     *         "to_date": "2019-03-13 00:00:00",
     *         "enable": "1",
     *         "max_number_uses": "0",
     *         "max_use_per_customer": "1",
     *         "domaine_source": "Informatique_Front",
     *         "financial_source": "internal",
     *         "user_link": "0",
     *         "action_id": "60",
     *         "rule_id": "114",
     *         "pattern_id": "0",
     *         "creation_date": "2013-07-15 18:06:23",
     *         "creation_user_id": "0",
     *         "modification_date": "2013-07-15 18:06:23",
     *         "modification_user_id": "0"
     *         },
     *         "promotion_action": [
     *         {
     *           "id": "492379",
     *           "name": "Ordii",
     *           "discount_type": "amount",
     *           "discount_value": "10.00",
     *           "apply_on": "target",
     *           "creation_user_id": "0",
     *           "modification_user_id": "0",
     *           "ts_insert": "2013-07-01 00:00:00",
     *           "ts_last_change": "2016-04-28 17:56:19",
     *           "target_id": "8574448",
     *           "target_type": "universe",
     *           "target_mode": "include",
     *           "action_id": "60"
     *         }
     *       ]
     *     }
     *     ]
     *   }
     * }
     *</pre>
     *
     * @Post("cart/{cart_id}/promotion",requirements={"_format"="json"},defaults={"_format" = "json"}, name="add_promotion_to_cart")
     * @ParamConverter("cart", class="CartBusinessBundle:Cart")
     *
     * @ApiDoc(
     *  resource=true,
     *  output={
     *       "class"="Rdc\Cart\CartBusinessBundle\Entity\Cart",
     *       "parsers"={
     *         "Nelmio\ApiDocBundle\Parser\JmsMetadataParser"
     *       }
     *     },
     *  description="Add promotion to cart",
     *  section="Cart Promotion",
     *  statusCodes={
     *      200="Returned when successful",
     *      400="Returned when a business exception occurred",
     *      500="Returned when a technical error occurs, request must be retry"
     *  }
     * )
     *
     * @return array
     */
    public function addPromotionAction(Request $request, $cart)
    {
        $form = $this->createForm(CartPromotionType::class, $cart);
        $form->handleRequest($request);

        try {

            $this->validateForm($form);

            $cart = $this->getCartBusiness()->createCart($cart);
            $view = $this->view($cart, 200);

            $this->getDoctrine()->getManager()->persist($cart);
            $this->getDoctrine()->getManager()->flush();

        } catch (FormValidationException $exception) {

            $form = $this->convertFormToArray($form);
            $view = $this->view($form, 400);
        } catch (\Exception $exception) {
            $data = ['success' => false, 'message' => $exception->getMessage()];
            $view = $this->view($data, 400);
        }

        return $this->handleView($view);
    }

    /**
     * Get Order list
     *
     *
     * @Get("order/list",requirements={"_format"="json"},defaults={"_format" = "json"}, name="get_order_list")
     * @ApiDoc(
     *  resource=true,
     *  description="Get order list",
     *
     *  output={
     *       "class"="Rdc\Cart\CartBusinessBundle\Entity\Cart",
     *       "groups"={"nelmio"},
     *       "parsers"={
     *         "Nelmio\ApiDocBundle\Parser\ValidationParser"
     *       }
     *     },
     *  section="Order",
     *  statusCodes={
     *      200="Returned when successful",
     *      400="Returned when a business exception occurred",
     *      500="Returned when a technical error occurs, request must be retry"
     *  }
     * )
     *
     * @return array
     */
    public function getUnnotifiedOrderListAction(Request $request)
    {
        try {
            $orders = $this->getCartBusiness()->getUnnotifiedOrders();
            $view = $this->view($orders, 200);

        } catch (\Exception $exception) {
            $data = ['success' => false, 'message' => $exception->getMessage()];
            $view = $this->view($data, 400);
        }

        return $this->handleView($view);
    }

    /**
     * Notified an Order
     *
     * @Put("order/{cart_id}/notified",requirements={"_format"="json", "cart_id": "\d+"},defaults={"_format" = "json"}, name="update_cart_item")
     * @ParamConverter("cart", class="CartBusinessBundle:Cart")
     * @ApiDoc(
     *  resource=true,
     *  description="Notified an Order",
     *  section="Order",
     *  statusCodes={
     *      200="Returned when successful",
     *      400="Returned when a business exception occurred",
     *      500="Returned when a technical error occurs, request must be retry"
     *  }
     * )
     *
     * @return array
     */
    public function putOrderNotifiedAction(Request $request, Cart $cart)
    {
        try {
            $this->getCartBusiness()->notify($cart);
            $view = $this->view(['success' => true], 200);

        } catch (\Exception $exception) {
            $data = ['success' => false, 'message' => $exception->getMessage()];
            $view = $this->view($data, 400);
        }

        return $this->handleView($view);
    }

    /**
     * @return   \Rdc\Cart\CartBusinessBundle\Service\CartBusiness
     */
    protected function getCartBusiness()
    {
        return $this->get('cart.business');
    }

    /**
     * @param \Symfony\Component\Form\AbstractType Form to be validated
     * @throws \Rdc\Cart\CartApiBundle\Exception\FormValidationException if the form is invalid
     */
    protected function validateForm($form)
    {
        if (!$form->isValid()) {
            throw new FormValidationException();
        }
    }

    /**
     *
     * @param    string  repository name
     * @return   \Doctrine\ORM\EntityRepository
     *
     */
    protected function getRepository($repository)
    {
        return $this->getDoctrine()->getRepository($repository);
    }
}
