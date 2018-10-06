<?php


namespace Booni3\Linnworks;

use Booni3\Linnworks\Api\Orders;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\HandlerStack;

class Linnworks
{
    private $applicationId;
    private $applicationSecret;
    private $token;
    protected $bearer;
    protected $server;

    public function __construct($applicationId, $applicationSecret, $token, $bearer = null, $server = null)
    {
        $this->applicationId = $applicationId;
        $this->applicationSecret = $applicationSecret;
        $this->token = $token;
        $this->bearer = $bearer;
        $this->server = $server;
    }

    public function make()
    {
        if(!$this->bearer) $this->getBearer();
        return new static (
            $this->applicationId,
            $this->applicationSecret,
            $this->token,
            $this->bearer,
            $this->server);
    }

    public function getBearer()
    {
        $res = $this->Auth()->AuthorizeByApplication();
        $this->bearer = $res['Token'];
        $this->server = $res['Server'];
    }

    protected function getApiInstance($method)
    {
        $class = "\\Booni3\\Linnworks\\Api\\".ucwords($method);
        if (class_exists($class) && ! (new \ReflectionClass($class))->isAbstract()) {
            return new $class(
                $this->applicationId,
                $this->applicationSecret,
                $this->token,
                $this->bearer,
                $this->server);
        }
        throw new \BadMethodCallException("Undefined method [{$method}] called.");
    }

    public function __call($method, array $parameters)
    {
        return $this->getApiInstance($method);
    }

}