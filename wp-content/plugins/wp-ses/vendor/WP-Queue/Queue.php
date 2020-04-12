<?php

namespace DeliciousBrains\WP_Offload_SES\WP_Queue;

use DeliciousBrains\WP_Offload_SES\WP_Queue\Connections\ConnectionInterface;
class Queue
{
    /**
     * @var ConnectionInterface
     */
    protected $connection;
    /**
     * @var Cron
     */
    protected $cron;
    /**
     * Queue constructor.
     *
     * @param ConnectionInterface $connection
     */
    public function __construct(\DeliciousBrains\WP_Offload_SES\WP_Queue\Connections\ConnectionInterface $connection)
    {
        $this->connection = $connection;
    }
    /**
     * Push a job onto the queue;
     *
     * @param Job $job
     * @param int $delay
     *
     * @return bool|int
     */
    public function push(\DeliciousBrains\WP_Offload_SES\WP_Queue\Job $job, $delay = 0)
    {
        return $this->connection->push($job, $delay);
    }
    /**
     * Create a cron worker.
     *
     * @param int $attempts
     * @param int $interval
     *
     * @return Cron
     */
    public function cron($attempts = 3, $interval = 5)
    {
        if (is_null($this->cron)) {
            $this->cron = new \DeliciousBrains\WP_Offload_SES\WP_Queue\Cron(get_class($this->connection), $this->worker($attempts), $interval);
            $this->cron->init();
        }
        return $this->cron;
    }
    /**
     * Create a new worker.
     *
     * @param int $attempts
     *
     * @return Worker
     */
    public function worker($attempts)
    {
        return new \DeliciousBrains\WP_Offload_SES\WP_Queue\Worker($this->connection, $attempts);
    }
}
