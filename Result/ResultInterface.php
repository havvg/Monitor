<?php

namespace Havvg\Component\Monitor\Result;

use Havvg\Component\Monitor\Resource\ResourceInterface;

/**
 * A result reflects the status and any additional information collected from a measurement.
 */
interface ResultInterface
{
    /**
     * Return the resource this result is attached to.
     *
     * @return ResourceInterface
     */
    public function getResource();

    /**
     * Return the status for this result.
     *
     * @return Status
     */
    public function getStatus();

    /**
     * This extra data is contracted to the measurement itself.
     *
     * It may contain additional information a handler may
     *
     * @return mixed
     */
    public function getExtraData();
}
