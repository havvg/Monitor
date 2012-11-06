<?php

namespace Havvg\Component\Monitor\Result;

use Havvg\Component\Monitor\Exception\InvalidArgumentException;

/**
 * A status reflects the result of a measurement.
 */
class Status
{
    /**
     * The system is working within its parameters.
     */
    const OK = 0;

    /**
     * The system is still OK, but its state is worth mentioning, e.g. logging.
     */
    const INFO =  200;

    /**
     * The system is usable, but someone should be notified about its state.
     */
    const NOTICE = 250;

    /**
     * The system is at its capacity and this state should be changed.
     */
    const WARNING = 300;

    /**
     * The systems behavior is erroneous and not working as expected.
     */
    const ERROR = 400;

    /**
     * The systems behavior could not be determined.
     */
    const UNKNOWN = 450;

    /**
     * The system has reached its critical state and may be down very soon.
     */
    const CRITICAL = 500;

    /**
     * The system is not available anymore.
     */
    const EMERGENCY = 600;

    /**
     * @var int
     */
    protected $status;

    /**
     * @var string
     */
    protected $message;

    /**
     * Check whether the given status is valid.
     *
     * @param int $status
     *
     * @return bool
     */
    protected function isValidStatus($status)
    {
        return in_array($status, array(
            static::OK,
            static::INFO,
            static::NOTICE,
            static::WARNING,
            static::ERROR,
            static::UNKNOWN,
            static::CRITICAL,
            static::EMERGENCY,
        ), true);
    }

    /**
     * Set the status code for this result status.
     *
     * @param int $status
     *
     * @return Status
     *
     * @throws InvalidArgumentException
     */
    public function setStatus($status)
    {
        if (!$this->isValidStatus($status)) {
            throw new InvalidArgumentException('The given status code is invalid.');
        }

        $this->status = $status;

        return $this;
    }

    /**
     * Return the status code of this status.
     *
     * @return int
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set a descriptive message on the status.
     *
     * @param string $message
     *
     * @return Status
     */
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Return the description on this result status.
     *
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }
}
