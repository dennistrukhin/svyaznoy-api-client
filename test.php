<?php

require_once 'vendor/autoload.php';

$clientAuthentication = new \SvyaznoyApi\ClientConfiguration(
    'zabberi',
    '@^ZAbdFeNqSMrA3',
    \SvyaznoyApi\ClientConfiguration::MODE_PROD
);

$client = new \SvyaznoyApi\Client($clientAuthentication);
$deliveryFilter = new \SvyaznoyApi\Request\DeliveryFilter();
$deliveryFilter->setCityId(133);
$deliveryFilter->setOrderDate(new \DateTime());

$result = $client->delivery()->get($deliveryFilter);
//$result = $client->outpostPoints()->get(null, new \SvyaznoyApi\Request\Pagination(1, 2));
var_dump($result);