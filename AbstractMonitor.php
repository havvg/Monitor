<?php

namespace Havvg\Component\Monitor;

use Havvg\Component\Monitor\Measurement\MeasurementInterface;
use Havvg\Component\Monitor\Resource\ResourceInterface;
use Havvg\Component\Monitor\Result\Handler\HandlerInterface;

abstract class AbstractMonitor implements MonitorInterface
{
    protected $resources = array();
    protected $measurements = array();
    protected $handlers = array();

    /**
     * Return the list of handlers currently registered on this monitor.
     *
     * @return HandlerInterface[]
     */
    public function getHandlers()
    {
        return $this->handlers;
    }

    /**
     * Return the list of measurements currently registered on this monitor.
     *
     * @return MeasurementInterface[]
     */
    public function getMeasurements()
    {
        return $this->measurements;
    }

    /**
     * Return the list of resources currently registered on this monitor.
     *
     * @return ResourceInterface[]
     */
    public function getResources()
    {
        return $this->resources;
    }

    /**
     * Set the list of handlers to be registered on this monitor.
     *
     * @param HandlerInterface[] $handlers
     *
     * @return AbstractMonitor
     */
    public function setHandlers(array $handlers = array())
    {
        $this->handlers = array();

        foreach ($handlers as $eachHandler) {
            $this->addHandler($eachHandler);
        }

        return $this;
    }

    /**
     * Set the list of measurements to be registered on this monitor.
     *
     * @param MeasurementInterface[] $measurements
     *
     * @return AbstractMonitor
     */
    public function setMeasurements(array $measurements = array())
    {
        $this->measurements = array();

        foreach ($measurements as $eachMeasurement) {
            $this->addMeasurement($eachMeasurement);
        }

        return $this;
    }

    /**
     * Set the list of resources to be registered on this monitor.
     *
     * @param ResourceInterface[] $resources
     *
     * @return AbstractMonitor
     */
    public function setResources(array $resources = array())
    {
        $this->resources = array();

        foreach ($resources as $eachResource) {
            $this->addResource($eachResource);
        }

        return $this;
    }

    /**
     * Register a resource on this monitor.
     *
     * @param ResourceInterface $resource
     *
     * @return MonitorInterface
     */
    public function addResource(ResourceInterface $resource)
    {
        $this->resources[] = $resource;

        return $this;
    }

    /**
     * Register a measurement on this monitor.
     *
     * @param MeasurementInterface $measurement
     *
     * @return MonitorInterface
     */
    public function addMeasurement(MeasurementInterface $measurement)
    {
        $this->measurements[] = $measurement;

        return $this;
    }

    /**
     * Register a result handler on this monitor.
     *
     * @param HandlerInterface $handler
     *
     * @return MonitorInterface
     */
    public function addHandler(HandlerInterface $handler)
    {
        $this->handlers[] = $handler;

        return $this;
    }
}
