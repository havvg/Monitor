<?php

namespace Havvg\Component\Monitor\Tests\Result\Handler;

use Havvg\Component\Monitor\Tests\AbstractTest;

use Havvg\Component\Monitor\Result\Handler\StorageHandler;

/**
 * @covers Havvg\Component\Monitor\Result\Handler\StorageHandler
 */
class StorageHandlerTest extends AbstractTest
{
    public function testExpandStorage()
    {
        $storage = $this->getMock('SplObjectStorage');

        $handler = new StorageHandler(null, $storage);

        $this->assertSame($storage, $handler->getStorage());
    }

    public function testProcessSystemAwareResource()
    {
        $system = $this->getSystemMock();

        $resource = $this->getSystemAwareResourceMock();
        $resource
            ->expects($this->once())
            ->method('getSystem')
            ->will($this->returnValue($system))
        ;

        $result = $this->getResultMock();
        $result
            ->expects($this->once())
            ->method('getResource')
            ->will($this->returnValue($resource))
        ;

        $handler = new StorageHandler();
        $handler->process($result);

        $results = $handler->getResultsForResource($resource);
        $this->assertCount(1, $results);
        $this->assertInstanceOf('Havvg\Component\Monitor\Result\ResultInterface', $results[0]);
        $this->assertSame($result, $results[0]);

        $results = $handler->getResultsForResource($system);
        $this->assertCount(1, $results);
        $this->assertContainsOnlyInstancesOf('Havvg\Component\Monitor\Result\ResultInterface', $results);
        $this->assertSame($result, $results[0]);
    }

    public function testProcessMultipleResultsSameResource()
    {
        $resource = $this->getResourceMock();

        $resultA = $this->getResultMock();
        $resultA
            ->expects($this->once())
            ->method('getResource')
            ->will($this->returnValue($resource))
        ;

        $resultB = $this->getResultMock();
        $resultB
            ->expects($this->once())
            ->method('getResource')
            ->will($this->returnValue($resource))
        ;

        $handler = new StorageHandler();
        $handler->process($resultA);
        $handler->process($resultB);

        $results = $handler->getResultsForResource($resource);
        $this->assertCount(2, $results);
        $this->assertContainsOnlyInstancesOf('Havvg\Component\Monitor\Result\ResultInterface', $results);
        $this->assertContains($resultA, $results);
        $this->assertContains($resultB, $results);
    }
}
