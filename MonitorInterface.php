<?php

namespace Havvg\Component\Monitor;

use Havvg\Component\Monitor\Measurement\MeasurementInterface;
use Havvg\Component\Monitor\Resource\ResourceInterface;
use Havvg\Component\Monitor\Result\Handler\HandlerInterface;
use Havvg\Component\Monitor\Result\ResultInterface;

/**
 * A monitor observes a provided environment.
 *
 * The environment consists of
 * * Measurements defining how to determine the status of
 * * Resources, the actual units to be monitored.
 * * Handlers providing interfaces to communicate the results and their status.
 */
interface MonitorInterface
{
    /**
     * Register a resource on this monitor.
     *
     * @param ResourceInterface $resource
     *
     * @return MonitorInterface
     */
    public function addResource(ResourceInterface $resource);

    /**
     * Register a measurement on this monitor.
     *
     * @param MeasurementInterface $measurement
     *
     * @return MonitorInterface
     */
    public function addMeasurement(MeasurementInterface $measurement);

    /**
     * Register a result handler on this monitor.
     *
     * @param HandlerInterface $handler
     *
     * @return MonitorInterface
     */
    public function addHandler(HandlerInterface $handler);

    /**
     * Observe the currently registered environment.
     *
     * @return ResultInterface[]
     */
    public function observe();
}
