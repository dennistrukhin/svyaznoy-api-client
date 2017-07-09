<?php
namespace SvyaznoyApi\Request;

use SvyaznoyApi\Authenticator;
use SvyaznoyApi\Client;
use SvyaznoyApi\HttpClient;
use SvyaznoyApi\Response;

class Order extends ARequest
{

    private $params = [
        'delivery_time_from' => '08:00',
        'delivery_time_to' => '23:00',
        'format' => 'json',
        'basket' => []
    ];

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @param $id
     * @return $this
     * @internal param mixed $query
     */
    public function setOrderId($id)
    {
        $this->params['partner_order_number'] = $id;
        return $this;
    }

    public function setCityId($cityId)
    {
        $this->params['city_id'] = $cityId;
        return $this;
    }

    public function setDeliveryId($deliveryId)
    {
        $this->params['delivery_type_id'] = $deliveryId;
        return $this;
    }

    public function setPaymentId($paymentId)
    {
        $this->params['payment_type_id'] = $paymentId;
        return $this;
    }

    public function setDeliveryDate($deliveryDate)
    {
        $this->params['payment_type_id'] = $deliveryDate;
        return $this;
    }

    public function setCustomerName($customerName)
    {
        $this->params['contact_name'] = $customerName;
        return $this;
    }

    public function setCustomerMobilePhone($mobilePhone)
    {
        $this->params['mobile_phone'] = $mobilePhone;
        return $this;
    }

    public function setCustomerLandPhone($landPhone)
    {
        $this->params['city_phone'] = $landPhone;
        return $this;
    }

    public function setCustomerEmail($email)
    {
        $this->params['email'] = $email;
        return $this;
    }

    public function setOutpostId($outpostId)
    {
        $this->params['cms_addressee'] = $outpostId;
        return $this;
    }

    public function setShipmentDateTime(\DateTime $shipmentDateTime)
    {
        $this->params['calculation_datetime'] = $shipmentDateTime->format('Y-m-d\TH:i:s');
        return $this;
    }

    public function setCompanyInn($number)
    {
        $this->params['bn_inn'] = $number;
        return $this;
    }

    public function setCompanyName($companyName)
    {
        $this->params['f_company_name'] = $companyName;
        return $this;
    }

    public function addProduct($price, $quantity)
    {
        $this->params['basket'][] = [
            'product_id' => '2796047',
            'price' => round($price / 100, 2),
            'qty' => $quantity
        ];
    }

    public function create()
    {
        $authenticator = new Authenticator($this->client);
        $httpClient = new HttpClient($authenticator);
        $response = $httpClient->post(
            $this->client->getUriApi() . '/orders'
        );
        return new Response($response);
    }


}