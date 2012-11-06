<?php

namespace Havvg\Component\Monitor\Measurement;

use Havvg\Component\Monitor\Resource\ResourceInterface;
use Havvg\Component\Monitor\Result\ResultInterface;

use Havvg\Component\Monitor\Exception\Measurement\UnsupportedResourceException;

/**
 * A measurement reflects the actual instrument on how to determine the status of a resource.
 *
 * The measurement has contracts to the resources it is covering.
 */
interface MeasurementInterface
{
    /**
     * Check whether this measurement is capable if determining the status of the given resource.
     *
     * @param ResourceInterface $resouce
     *
     * @return bool
     */
    public function supports(ResourceInterface $resouce);

    /**
     * Collect the data from the resource and create a result.
     *
     * @param ResourceInterface $resource
     *
     * @return ResultInterface
     *
     * @throws UnsupportedResourceException
     */
    public function measure(ResourceInterface $resource);
}
