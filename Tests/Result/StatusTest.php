<?php

namespace Havvg\Component\Monitor\Tests\Result;

use Havvg\Component\Monitor\Tests\AbstractTest;

use Havvg\Component\Monitor\Result\Status;

/**
 * @covers Havvg\Component\Monitor\Result\Status
 */
class StatusTest extends AbstractTest
{
    public function setStatusProvider()
    {
        return array(
            array(-1, false),
            array(0.5, false),
            array(false, false),
            array(true, false),
            array('foobar', false),
            array(null, false),

            array(Status::OK),
            array(Status::INFO),
            array(Status::NOTICE),
            array(Status::WARNING),
            array(Status::ERROR),
            array(Status::UNKNOWN),
            array(Status::CRITICAL),
            array(Status::EMERGENCY),
        );
    }

    /**
     * @dataProvider setStatusProvider
     */
    public function testSetStatus($code, $expected = true)
    {
        $status = new Status();

        if (false === $expected) {
            $this->setExpectedException('Havvg\Component\Monitor\Exception\InvalidArgumentException');
        }

        // The assertion will not be executed on exception.
        $this->assertEquals($status, $status->setStatus($code));
    }

    public function testStatus()
    {
        $message = 'This is an example notice message.';

        $status = new Status();
        $status->setStatus(Status::NOTICE);
        $status->setMessage($message);

        $this->assertEquals(Status::NOTICE, $status->getStatus());
        $this->assertEquals($message, $status->getMessage());
    }
}
