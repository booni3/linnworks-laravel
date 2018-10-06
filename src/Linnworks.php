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

    protected $bearer = null;
    protected $server = null;

    public function __construct($applicationId, $applicationSecret, $token)
    {
        $this->applicationId = $applicationId;
        $this->applicationSecret = $applicationSecret;
        $this->token = $token;
    }

    public function make()
    {
        if(!$this->bearer){
            $this->getBearer();
        }
        return $this;
//        return new static($this->applicationId, $this->applicationSecret, $this->token);
    }

    public function getBearer()
    {
        $auth = new Api\Auth($this->applicationId, $this->applicationSecret, $this->token);
        $res = $auth->AuthorizeByApplication();
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