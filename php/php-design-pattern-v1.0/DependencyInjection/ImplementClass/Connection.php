<?php
namespace DependencyInjection\ImplementClass;

use DependencyInjection\Contracts\Parameters;

class Connection
{
    protected $configuration;
    protected $host;

    public function __construct(Parameters $config)
    {
        $this->configuration = $config;
    }

    public function connect()
    {
        $host = $this->configuration->get('host');
        $this->host = $host;
    }

    public function getHost()
    {
        return $this->host;
    }
}
