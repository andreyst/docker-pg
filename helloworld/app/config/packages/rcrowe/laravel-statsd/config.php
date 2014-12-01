<?php

// var_dump($_SERVER,[
    // 'host' => isset($_SERVER['STATSD_PORT_8125_TCP_ADDR']) ? $_SERVER['STATSD_PORT_8125_TCP_ADDR'] : 'localhost',

    // 'port' => isset($_SERVER['STATSD_PORT_8125_TCP_PORT']) ? $_SERVER['STATSD_PORT_8125_TCP_PORT'] : 8125,
    // ]);
return array(

    /**
     * Statsd host.
     */
    'host' => isset($_SERVER['STATSD_PORT_8125_TCP_ADDR']) ? $_SERVER['STATSD_PORT_8125_TCP_ADDR'] : 'localhost',

    /**
     * Statsd port.
     */
    'port' => isset($_SERVER['STATSD_PORT_8125_TCP_PORT']) ? $_SERVER['STATSD_PORT_8125_TCP_PORT'] : 8125,

    /**
     * Statsd protocol.
     */
    'protocol' => 'udp',

    /**
     * Environments in which we allow sending to Statsd.
     */
    'environments' => ['prod', 'production', 'local'],
);
