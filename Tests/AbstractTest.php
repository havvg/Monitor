<?php

namespace Havvg\Component\Monitor\Tests;

abstract class AbstractTest extends \PHPUnit_Framework_TestCase
{
    protected function getHandlerMock()
    {
        return $this->getMock('Havvg\Component\Monitor\Result\Handler\HandlerInterface');
    }

    protected function getMeasurementMock()
    {
        return $this->getMock('Havvg\Component\Monitor\Measurement\MeasurementInterface');
    }

    protected function getResourceMock()
    {
        return $this->getMock('Havvg\Component\Monitor\Resource\ResourceInterface');
    }

    protected function getResultMock()
    {
        return $this->getMock('Havvg\Component\Monitor\Result\ResultInterface');
    }

    protected function getSystemMock()
    {
        return $this->getMock('Havvg\Component\Monitor\Resource\SystemInterface');
    }

    protected function getSystemAwareResourceMock()
    {
        return $this->getMock('Havvg\Component\Monitor\Resource\SystemAwareResourceInterface');
    }
}
