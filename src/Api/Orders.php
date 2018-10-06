<?php

namespace Booni3\Linnworks\Api;

class Orders extends Api
{
    public function getOpenOrders()
    {
        dump('get orders');

        $res = $this->_get('Orders/GetOpenOrders', [
            "entriesPerPage" => 25,
            "pageNumber" => 1,
            "filters" => null,
            "sorting" => null,
            "fulfilmentCenter" => 'e41b4701-0885-430d-9623-d840d9d46dd6',
            "additionalFilters" => null
        ]);

        dump($res);
    }

}