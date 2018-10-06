<?php

namespace Booni3\Linnworks\Api;

class Orders extends Api
{
    public function getOpenOrders()
    {
        dump('get orders');

        $res = $this->_get('Orders/GetOpenOrders', [
            "entriesPerPage" => 100,
            "pageNumber" => 0,
            "filters" => null,
            "sorting" => null,
            "fulfilmentCenter" => null,
            "additionalFilters" => null
        ]);

        dump($res);
    }

    public function getOpenOrders1()
    {
        dump('get orders 1 ');

        $res = $this->_get('Orders/GetOpenOrders', [
            "entriesPerPage" => 100,
            "pageNumber" => 0,
            "filters" => null,
            "sorting" => null,
            "fulfilmentCenter" => null,
            "additionalFilters" => null
        ]);

        dump($res);
    }

}