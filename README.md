# linnworks-laravel

## About

Wrapper for the Linnworks API, as documented at [http://apps.linnworks.net/Api](http://apps.linnworks.net/Api)

## Install

    composer require booni3/linnworks-laravel

## Usage

Using Facade:

    $orders = Linnworks::Orders()->getOpenOrders(
        25,
        1,
        null,
        null,
        'e41b4701-0885-430d-9623-d840d9d46dd6',
        null);