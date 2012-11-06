<?php

namespace Havvg\Component\Monitor\Tests;

use Havvg\Component\Monitor\Monitor;

/**
 * @covers Havvg\Component\Monitor\AbstractMonitor
 * @covers Havvg\Component\Monitor\AbstractSystemAwareMonitor
 * @covers Havvg\Component\Monitor\Monitor::<protected>
 */
class MonitorTest extends AbstractTest
{
    /**
     * @covers Havvg\Component\Monitor\Monitor::observe
     */
    public function testObserve()
    {
        $resultA = $this->getResultMock();
        $resultB = $this->getResultMock();

        $handler = $this->getHandlerMock();
        $handler
            ->expects($this->at(0))
            ->method('process')
            ->with($resultA)
        ;
        $handler
            ->expects($this->at(1))
            ->method('process')
            ->with($resultB)
        ;

        $resourceA = $this->getResourceMock();
        $resourceB = $this->getResourceMock();
        $resourceC = $this->getResourceMock();

        $measurementA = $this->getMeasurementMock();
        $measurementA
            ->expects($this->at(0))
            ->method('supports')
            ->with($resourceA)
            ->will($this->returnValue(false))
        ;
        $measurementA
            ->expects($this->at(1))
            ->method('supports')
            ->with($resourceB)
            ->will($this->returnValue(true))
        ;
        $measurementA
            ->expects($this->at(2))
            ->method('measure')
            ->with($resourceB)
            ->will($this->returnValue($resultA))
        ;
        $measurementA
            ->expects($this->at(3))
            ->method('supports')
            ->with($resourceC)
            ->will($this->returnValue(false))
        ;


        $measurementB = $this->getMeasurementMock();
        $measurementB
            ->expects($this->at(0))
            ->method('supports')
            ->with($resourceA)
            ->will($this->returnValue(false))
        ;
        $measurementB
            ->expects($this->at(1))
            ->method('supports')
            ->with($resourceB)
            ->will($this->returnValue(true))
        ;
        $measurementB
            ->expects($this->at(2))
            ->method('measure')
            ->with($resourceB)
            ->will($this->returnValue($resultB))
        ;
        $measurementB
            ->expects($this->at(3))
            ->method('supports')
            ->with($resourceC)
            ->will($this->returnValue(false))
        ;

        $monitor = new Monitor();
        $monitor->setMeasurements(array(
            $measurementA,
            $measurementB,
        ));
        $monitor->setResources(array(
            $resourceA,
            $resourceB,
            $resourceC,
        ));
        $monitor->setHandlers(array(
            $handler,
        ));

        $results = $monitor->observe();

        $this->assertCount(2, $results);
        $this->assertContainsOnlyInstancesOf('Havvg\Component\Monitor\Result\ResultInterface', $results);
    }

    /**
     * @covers Havvg\Component\Monitor\Monitor::observe
     */
    public function testObserveSystem()
    {
        $resultA = $this->getResultMock();
        $resultB = $this->getResultMock();
        $resultSA = $this->getResultMock();
        $resultSB = $this->getResultMock();

        $resourceA = $this->getResourceMock();
        $resourceB = $this->getResourceMock();

        $systemB = $this->getSystemMock();
        $systemB
            ->expects($this->at(0))
            ->method('getChildren')
            ->will($this->returnValue(array()))
        ;
        $systemB
            ->expects($this->at(1))
            ->method('getResources')
            ->will($this->returnValue(array($resourceB)))
        ;

        $systemA = $this->getSystemMock();
        $systemA
            ->expects($this->at(0))
            ->method('getChildren')
            ->will($this->returnValue(array($systemB)))
        ;
        $systemA
            ->expects($this->at(1))
            ->method('getResources')
            ->will($this->returnValue(array($resourceA)))
        ;

        $measurement = $this->getMeasurementMock();
        $measurement
            ->expects($this->at(0))
            ->method('supports')
            ->with($resourceB)
            ->will($this->returnValue(true))
        ;
        $measurement
            ->expects($this->at(1))
            ->method('measure')
            ->with($resourceA)
            ->will($this->returnValue($resultB))
        ;
        $measurement
            ->expects($this->at(2))
            ->method('supports')
            ->with($systemB)
            ->will($this->returnValue(true))
        ;
        $measurement
            ->expects($this->at(3))
            ->method('measure')
            ->with($systemB)
            ->will($this->returnValue($resultSB))
        ;
        $measurement
            ->expects($this->at(4))
            ->method('supports')
            ->with($resourceA)
            ->will($this->returnValue(true))
        ;
        $measurement
            ->expects($this->at(5))
            ->method('measure')
            ->with($resourceA)
            ->will($this->returnValue($resultA))
        ;
        $measurement
            ->expects($this->at(6))
            ->method('supports')
            ->with($systemA)
            ->will($this->returnValue(true))
        ;
        $measurement
            ->expects($this->at(7))
            ->method('measure')
            ->with($systemA)
            ->will($this->returnValue($resultSA))
        ;

        $monitor = new Monitor();
        $monitor->addMeasurement($measurement);
        $monitor->addResource($systemA);

        $results = $monitor->observe();

        $this->assertCount(4, $results);
        $this->assertContainsOnlyInstancesOf('Havvg\Component\Monitor\Result\ResultInterface', $results);
    }
}
