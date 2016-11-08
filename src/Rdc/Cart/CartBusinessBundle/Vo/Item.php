<?php

namespace Rdc\Cart\CartBusinessBundle\Vo;

use Symfony\Component\OptionsResolver\OptionsResolver;
/**
 * Item
 */
class Item extends AbstractVo
{
    /**
     * @var int
     */
    private $itemId;
    /**
     * @var int
     */
    private $offerId;

    /**
     * @var integer
     */
    private $quantity;

    /**
     * @var string
     */
    private $name;

    /**
     * @var integer
     */
    private $price;

    /**
     * @var string
     */
    private $image;

    /**
     * @var integer
     */
    private $merchantId;

    /**
     * @var string
     */
    private $merchantName;

    /**
     * @var integer
     */
    private $brandId;

    /**
     * @var string
     */
    private $brandName;

    /**
     * @var array
     */
    private $attributes;

    /**
     * @var integer
     */
    private $stock;

    /**
     * @var integer
     */
    private $managedStock;

    /**
     * @var string
     */
    private $productUrl;

    /**
     * @var string
     */
    private $reference;

    /**
     * @var integer
     */
    private $storeId;

    /**
     * @var array
     */
    private $additionalData;

    protected function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'offer_id' => null,
                'item_id' => null,
                'quantity' => null,
                'store_id' => null,
                'name' => null,
                'price' => null,
                'image' => null,
                'merchant_id' => null,
                'merchant_name' => null,
                'brand_id' => null,
                'brand_name' => null,
                'attributes' => null,
                'stock' => null,
                'managed_stock' => null,
                'product_url' => null,
                'reference' => null,
                'additional_data' => '',
            ]
        );
    }

    /**
     * @return int
     */
    public function getItemId()
    {
        return $this->itemId;
    }

    /**
     * @param int $itemId
     */
    public function setItemId($itemId)
    {
        $this->itemId = $itemId;
    }

    public function getOfferId()
    {
        return $this->offerId;
    }

    /**
     * @param int $offerId
     */
    public function setOfferId($offerId)
    {
        $this->offerId = $offerId;
    }

    /**
     * @return int
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * @param int $quantity
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }

    /**
     * @return int
     */
    public function getStoreId()
    {
        return $this->storeId;
    }

    /**
     * @param int $storeId
     */
    public function setStoreId($storeId)
    {
        $this->storeId = $storeId;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return int
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param int $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

    /**
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param string $image
     */
    public function setImage($image)
    {
        $this->image = $image;
    }

    /**
     * @return int
     */
    public function getMerchantId()
    {
        return $this->merchantId;
    }

    /**
     * @param int $merchantId
     */
    public function setMerchantId($merchantId)
    {
        $this->merchantId = $merchantId;
    }

    /**
     * @return string
     */
    public function getMerchantName()
    {
        return $this->merchantName;
    }

    /**
     * @param string $merchantName
     */
    public function setMerchantName($merchantName)
    {
        $this->merchantName = $merchantName;
    }

    /**
     * @return int
     */
    public function getBrandId()
    {
        return $this->brandId;
    }

    /**
     * @param int $brandId
     */
    public function setBrandId($brandId)
    {
        $this->brandId = $brandId;
    }

    /**
     * @return string
     */
    public function getBrandName()
    {
        return $this->brandName;
    }

    /**
     * @param string $brandName
     */
    public function setBrandName($brandName)
    {
        $this->brandName = $brandName;
    }

    /**
     * @return array
     */
    public function getAttributes()
    {
        return $this->attributes;
    }

    /**
     * @param array $attributes
     */
    public function setAttributes($attributes)
    {
        $this->attributes = $attributes;
    }

    /**
     * @return int
     */
    public function getStock()
    {
        return $this->stock;
    }

    /**
     * @param int $stock
     */
    public function setStock($stock)
    {
        $this->stock = $stock;
    }

    /**
     * @return int
     */
    public function getManagedStock()
    {
        return $this->managedStock;
    }

    /**
     * @param int $managedStock
     */
    public function setManagedStock($managedStock)
    {
        $this->managedStock = $managedStock;
    }

    /**
     * @return string
     */
    public function getProductUrl()
    {
        return $this->productUrl;
    }

    /**
     * @param string $productUrl
     */
    public function setProductUrl($productUrl)
    {
        $this->productUrl = $productUrl;
    }

    /**
     * @return string
     */
    public function getReference()
    {
        return $this->reference;
    }

    /**
     * @param string $reference
     */
    public function setReference($reference)
    {
        $this->reference = $reference;
    }

    /**
     * @return array
     */
    public function getAdditionalData()
    {
        return $this->additionalData;
    }

    /**
     * @param array $additional_data
     */
    public function setAdditionalData($additionalData)
    {
        $this->additionalData = $additionalData;
    }

}
