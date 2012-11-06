<?php

namespace Havvg\Component\Monitor;

use Havvg\Component\Monitor\Measurement\MeasurementInterface;
use Havvg\Component\Monitor\Resource\ResourceInterface;
use Havvg\Component\Monitor\Result\ResultInterface;

class Monitor extends AbstractSystemAwareMonitor
{
    /**
     * Observe the currently registered environment.
     *
     * @return ResultInterface[]
     */
    public function observe()
    {
        $results = array();

        foreach ($this->getMeasurements() as $eachMeasurement) {
            foreach ($this->getResources() as $eachResource) {
                $results = array_merge($results, $this->measureResource($eachMeasurement, $eachResource));
            }
        }

        foreach ($this->getHandlers() as $eachHandler) {
            foreach ($results as $eachResult) {
                $eachHandler->process($eachResult);
            }
        }

        return $results;
    }

    /**
     * Process a single measurement on the given resource.
     *
     * @param MeasurementInterface $measurement
     * @param ResourceInterface $resource
     *
     * @return ResultInterface[]
     */
    protected function measureResource(MeasurementInterface $measurement, ResourceInterface $resource)
    {
        $results = array();

        if ($measurement->supports($resource)) {
            $results[] = $measurement->measure($resource);
        }

        return $results;
    }
}
