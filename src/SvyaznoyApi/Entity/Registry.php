<?php
namespace SvyaznoyApi\Entity;

use SvyaznoyApi\Entity\Registry\Order;
use SvyaznoyApi\Exception\InvalidArgument;

class Registry
{

    private $xml;
    private $number = '';
    private $date;
    private $organizationName = '';
    private $estimatedValue = 0.0;
    private $region = '';
    /** @var Order[] $orders */
    private $orders = [];

    public function __construct()
    {
        $this->xml = new \DOMDocument();
        $this->xml->preserveWhiteSpace = true;
        $this->xml->formatOutput = true;
    }

    /**
     * @return \DOMDocument
     */
    public function getXml(): \DOMDocument
    {
        $ordersRegistry = $this->xml->createElement('par:OrdersRegistry');
        $ordersRegistry->setAttributeNS('http://www.w3.org/2000/xmlns/', 'xmlns:xs', 'http://www.w3.org/2001/XMLSchema');
        $ordersRegistry->setAttributeNS('http://www.w3.org/2000/xmlns/', 'xmlns:xsi', 'http://www.w3.org/2001/XMLSchema-instance');
        $ordersRegistry->appendChild($this->xml->createElement('ns:registerNumber', $this->number));
        $ordersRegistry->appendChild($this->xml->createElement('ns:date', $this->date));
        $ordersRegistry->appendChild($this->xml->createElement('ns:organization', $this->organizationName));
        $ordersRegistry->appendChild($this->xml->createElement('ns:estimatedValue', $this->estimatedValue));

        foreach ($this->orders as $orderData) {
            $order = $this->xml->createElement('ns:order');
            $order->appendChild($this->xml->createElement('ns:givenId', $orderData->getGivenId()));
            $order->appendChild($this->xml->createElement('ns:deliveryPoint', $orderData->getDeliveryPoint()));

            $recipient = $this->xml->createElement('ns:recipient');
            $recipient->appendChild($this->xml->createElement('ns:name', $orderData->getRecipient()->getName()));
            $recipient->appendChild($this->xml->createElement('ns:phone', $orderData->getRecipient()->getPhone()));
            $recipient->appendChild($this->xml->createElement('ns:email', $orderData->getRecipient()->getEmail()));
            $order->appendChild($recipient);

            $order->appendChild($this->xml->createElement('ns:declaredValue', $orderData->getDeclaredValue()));

            $owner = $this->xml->createElement('ns:owner');
            $owner->appendChild($this->xml->createElement('ns1:INN', $orderData->getOwner()->getInn()));
            $owner->appendChild($this->xml->createElement('ns1:name', $orderData->getOwner()->getName()));
            $order->appendChild($owner);

            $order->appendChild($this->xml->createElement('ns:deliveryCost', $orderData->getDeliveryCost()));
            $order->appendChild($this->xml->createElement('ns:deliveryDate', $orderData->getDeliveryDate()));
            $order->appendChild($this->xml->createElement('ns:paymentSum', $orderData->getPaymentSum()));
            $order->appendChild($this->xml->createElement('ns:paymentType', $orderData->getPaymentType()));

            foreach ($orderData->getParcels() as $parcelData) {
                $parcel = $this->xml->createElement('ns:parcel');
                $parcel->appendChild($this->xml->createElement('ns:givenId', $parcelData->getGivenId()));
                $parcel->appendChild($this->xml->createElement('ns:declaredValue', $parcelData->getDeclaredValue()));

                foreach ($parcelData->getInventory() as $inventoryData) {
                    $inventory = $this->xml->createElement('ns:inventory');
                    $inventory->appendChild($this->xml->createElement('ns:article', $inventoryData->getArticle()));
                    $inventory->appendChild($this->xml->createElement('ns:barcode', $inventoryData->getBarcode()));
                    $inventory->appendChild($this->xml->createElement('ns:name', $inventoryData->getName()));
                    $inventory->appendChild($this->xml->createElement('ns:amount', $inventoryData->getAmount()));
                    $inventory->appendChild($this->xml->createElement('ns:sum', $inventoryData->getSum()));
                    $inventory->appendChild($this->xml->createElement('ns:clientSum', $inventoryData->getClientSum()));
                    $parcel->appendChild($inventory);
                }

                $order->appendChild($parcel);
            }

            $order->appendChild($this->xml->createElement('ns:parcelCount', count($orderData->getParcels())));

            $ordersRegistry->appendChild($order);
        }

        $shipping = $this->xml->createElement('ns:shipping');
        $shipping->setAttributeNS('http://www.w3.org/2001/XMLSchema-instance', 'xsi:type', 'ns:AllParcelsShipped');
        $ordersRegistry->appendChild($shipping);

        $shippingCode = $this->xml->createElement('ns:shippingCode', 'MSC');
        $ordersRegistry->appendChild($shippingCode);

        $this->xml->appendChild($ordersRegistry);
        return $this->xml;
    }

    /**
     * @param string $date
     * @throws InvalidArgument
     */
    public function setDate(string $date): void
    {
        if (!preg_match('#\d{4}-\d{2}-\d{2}#', $date)) {
            throw new InvalidArgument('Неверный формат даты реестра');
        }
        $this->date = $date;
    }

    /**
     * @param float $estimatedValue
     */
    public function setEstimatedValue(float $estimatedValue): void
    {
        $this->estimatedValue = $estimatedValue;
    }

    /**
     * @param string $number
     */
    public function setNumber(string $number): void
    {
        $this->number = $number;
    }

    /**
     * @param string $region
     */
    public function setRegion(string $region): void
    {
        $this->region = $region;
    }

    /**
     * @param string $organizationName
     */
    public function setOrganizationName(string $organizationName): void
    {
        $this->organizationName = $organizationName;
    }

    /**
     * @param Order $order
     * @throws InvalidArgument
     */
    public function addOrder(Order $order): void
    {
        if (!$order->getOwner() instanceof Order\Owner) {
            throw new InvalidArgument('Необходимо указать Owner для заказа ' . $order->getGivenId());
        }
        if (!$order->getRecipient() instanceof Order\Recipient) {
            throw new InvalidArgument('Необходимо указать Recipient для заказа ' . $order->getGivenId());
        }
        if (count($order->getParcels()) == 0) {
            throw new InvalidArgument('В заказе ' . $order->getGivenId() . ' нет ни одной посылки');
        }
        $this->orders[] = $order;
    }



}