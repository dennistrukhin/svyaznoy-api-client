<?php
namespace SvyaznoyApi\Request;

use Psr\Log\LoggerInterface;
use SvyaznoyApi\Exception\UnprocessableEntity;
use SvyaznoyApi\Http\Header;
use SvyaznoyApi\Http\Headers;

class Registry extends ARequest
{

    /**
     * @param \SvyaznoyApi\Entity\Registry $registry
     * @throws UnprocessableEntity
     */
    public function send(\SvyaznoyApi\Entity\Registry $registry)
    {
        $soapXml = $this->soapifyRegistry($registry);
        if ($this->logger instanceof LoggerInterface) {
            $this->logger->info('Отправка в Связной реестра');
        }
        $headers = new Headers();
        $headers->add(new Header('SOAPAction', '"http://api.svyaznoy.ru/NTVR/ParcelContractor_v3#ParcelContractor_v3:RegisterParcelOrders"'));
        $headers->add(new Header('Content-Type', 'text/xml'));
        $response = $this->httpClient->post($this->baseUri . '/parcels', $headers, [], $soapXml->saveXML());
        $responseXml = simplexml_load_string($response->getBody());
        $responseXml->registerXPathNamespace('soap', 'http://schemas.xmlsoap.org/soap/envelope/');
        $responseXml->registerXPathNamespace('m', 'http://api.svyaznoy.ru/NTVR/ParcelContractor_v3');
        $return = $responseXml->xpath("//soap:Envelope/soap:Body/m:RegisterParcelOrdersResponse/m:return")[0];
        $success = strtolower((string)$return->attributes()['success']) === 'true';
        $responseString = (string)$return->text;
        if (!$success) {
            throw new UnprocessableEntity($responseString);
        }
    }

    private function soapifyRegistry(\SvyaznoyApi\Entity\Registry $registry)
    {
        $xml = $registry->getXml();

        $orderRegistry = $xml->getElementsByTagName('par:OrdersRegistry')->item(0);
        $soapXml = new \DOMDocument();
        $soapXml->preserveWhiteSpace = true;
        $soapXml->formatOutput = true;
        $envelope = $soapXml->createElementNS('http://schemas.xmlsoap.org/soap/envelope/', 'soapenv:Envelope');
        $soapXml->appendChild($envelope);
        $envelope->setAttributeNS('http://www.w3.org/2000/xmlns/', 'xmlns:par', 'http://api.svyaznoy.ru/NTVR/ParcelContractor_v3');
        $envelope->setAttributeNS('http://www.w3.org/2000/xmlns/', 'xmlns:ns', 'http://schemas.svyaznoy.ru/parcel-delivery/contractor/3.0');
        $envelope->setAttributeNS('http://www.w3.org/2000/xmlns/', 'xmlns:ns1', 'http://schemas.svyaznoy.ru/parcel-delivery/common/1.0');

        $header = $soapXml->createElementNS('http://schemas.xmlsoap.org/soap/envelope/', 'soapenv:Header');
        $envelope->appendChild($header);

        $body = $soapXml->createElementNS('http://schemas.xmlsoap.org/soap/envelope/', 'soapenv:Body');
        $envelope->appendChild($body);

        $registerParcelOrders = $soapXml->createElement('par:RegisterParcelOrders');
        $registerParcelOrders->appendChild($soapXml->importNode($orderRegistry, true));
        $body->appendChild($registerParcelOrders);

        return $soapXml;
    }


}