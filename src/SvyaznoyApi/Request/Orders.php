<?php
namespace SvyaznoyApi\Request;

use Psr\Log\LoggerInterface;
use SvyaznoyApi\Entity\Order;
use SvyaznoyApi\Exception\UnprocessableEntity;
use SvyaznoyApi\Library\DeliveryDate;
use SvyaznoyApi\Library\OrderResponse;
use SvyaznoyApi\Library\TimeInterval;

class Orders extends ARequest
{

    /**
     * @param Order $order
     * @return OrderResponse
     * @throws UnprocessableEntity
     */
    public function create(Order $order)
    {
        if ($this->logger instanceof LoggerInterface) {
            $this->logger->info('Отправка в Связной заказа');
            $this->logger->info(print_r($order, true));
        }
        $params = $this->getQueryArray($order);
        $response = $this->httpClient->post(
            $this->baseUri . '/orders',
            null,
            $params
        );
        if ($response->getStatusCode() === 422) {
            $messages = [];
            foreach ($response->getBody() as $errInfo) {
                $messages[] = $errInfo['message'];
            }
            $e = new UnprocessableEntity($response->getStatusText(), $messages);
            throw $e;
        }
        return new OrderResponse(
            $response->getBody()['id'],
            $response->getBody()['partner_order_number'],
            $response->getBody()['inserted_at'],
            $response->getBody()['updated_at']
        );
    }

    /**
     * @param Order $order
     * @return array
     */
    private function getQueryArray(Order $order): array
    {
        $query = [];
        if (!empty($order->getPartnerOrderNumber())) {
            $query['partner_order_number'] = $order->getPartnerOrderNumber();
        }
        if (!empty($order->getCityId())) {
            $query['city_id'] = $order->getCityId();
        }
        if (!empty($order->getDeliveryTypeId())) {
            $query['delivery_type_id'] = $order->getDeliveryTypeId();
        }
        if (!empty($order->getPaymentTypeId())) {
            $query['payment_type_id'] = $order->getPaymentTypeId();
        }
        if ($order->getDeliveryDate() instanceof DeliveryDate) {
            $query['delivery_date'] = $order->getDeliveryDate()->format('Y-m-d');
        }
        if (!empty($order->getContactName())) {
            $query['contact_name'] = $order->getContactName();
        }
        if (!empty($order->getMobilePhone())) {
            $query['mobile_phone'] = $order->getMobilePhone()->getNumber();
        }
        if (!empty($order->getCityPhone())) {
            $query['city_phone'] = $order->getCityPhone()->getNumber();
        }
        if (!empty($order->getEmail())) {
            $query['email'] = $order->getEmail();
        }
        if (!empty($order->getOutpostPointId())) {
            $query['cms_addressee'] = (int)$order->getOutpostPointId();
        }
        if ($order->getCalculationDateTime() instanceof \DateTime) {
            $query['calculation_datetime'] = $order->getCalculationDateTime()->format('Y-m-d\TH:i:s');
        }
        if (!empty($order->getCompanyName())) {
            $query['f_company_name'] = $order->getCompanyName();
        }
        if (!empty($order->getCompanyInn())) {
            $query['bn_inn'] = $order->getCompanyInn();
        }
        $query['format'] = 'json';
        $this->addTimeInterval($query, $order);
        $this->addCartItems($query, $order);
        return $query;
    }

    private function addTimeInterval(array &$query, Order $order)
    {
        if ($order->getDeliveryInterval() instanceof TimeInterval) {
            $query['delivery_time_from'] = $order->getDeliveryInterval()->getTimeFrom()->format('H:i');
            $query['delivery_time_to'] = $order->getDeliveryInterval()->getTimeTo()->format('H:i');
        }
    }

    private function addCartItems(array &$query, Order $order)
    {
        $cartItems = $order->getCart()->getItems();
        if (count($cartItems) > 0) {
            $cartArray = [];
            foreach ($cartItems as $cartItem) {
                $cartArray[] = [
                    'product_id' => $cartItem->getProductId(),
                    'price' => $cartItem->getPrice() / 100,
                    'qty' => $cartItem->getQuantity(),
                ];
            }
            $query['basket'] = $cartArray;
        }
    }

}