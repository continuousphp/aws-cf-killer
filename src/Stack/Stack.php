<?php
/**
 * Stack.php
 *
 * @copyright Copyright (c) 2016 Continuous S.A. (https://continuousphp.com)
 * @license   http://opensource.org/licenses/Apache-2.0 Apache License, Version 2.0
 * @file      Stack.php
 * @link      http://github.com/continuousphp/aws-cf-killer the canonical source repo
 */

namespace Continuous\Aws\Killer\Stack;

use Aws\Api\DateTimeResult;

/**
 * Stack
 *
 * @package    Continuous\Aws\Killer
 * @subpackage Stack
 * @license    http://opensource.org/licenses/Apache-2.0 Apache License, Version 2.0
 */
class Stack
{
    /** @var  string */
    protected $stackId;
    
    /** @var  string */
    protected $stackName;
    
    /** @var  string */
    protected $description;
    
    /** @var  array */
    protected $parameters;
    
    /** @var  DateTimeResult */
    protected $creationTime;
    
    /** @var  DateTimeResult */
    protected $lastUpdatedTime;
    
    /** @var  string */
    protected $stackStatus;
    
    /** @var  bool */
    protected $disableRollback;
    
    /** @var array  */
    protected $notificationARNs = array();
    
    /** @var array  */
    protected $capabilities = array();
    
    /** @var array  */
    protected $outputs = array();
    
    /** @var array  */
    protected $tags = array();

    /**
     * @return string
     */
    public function getStackId()
    {
        return $this->stackId;
    }

    /**
     * @param string $stackId
     * @return Stack
     */
    public function setStackId($stackId)
    {
        $this->stackId = $stackId;
        return $this;
    }

    /**
     * @return string
     */
    public function getStackName()
    {
        return $this->stackName;
    }

    /**
     * @param string $stackName
     * @return Stack
     */
    public function setStackName($stackName)
    {
        $this->stackName = $stackName;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return Stack
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return array
     */
    public function getParameters()
    {
        return $this->parameters;
    }

    /**
     * @param array $parameters
     * @return Stack
     */
    public function setParameters($parameters)
    {
        $this->parameters = $parameters;
        return $this;
    }

    /**
     * @return DateTimeResult
     */
    public function getCreationTime()
    {
        return $this->creationTime;
    }

    /**
     * @param DateTimeResult $creationTime
     * @return Stack
     */
    public function setCreationTime(DateTimeResult $creationTime)
    {
        $this->creationTime = $creationTime;
        return $this;
    }

    /**
     * @return DateTimeResult
     */
    public function getLastUpdatedTime()
    {
        return $this->lastUpdatedTime;
    }

    /**
     * @param DateTimeResult $lastUpdatedTime
     * @return Stack
     */
    public function setLastUpdatedTime(DateTimeResult $lastUpdatedTime)
    {
        $this->lastUpdatedTime = $lastUpdatedTime;
        return $this;
    }

    /**
     * @return string
     */
    public function getStackStatus()
    {
        return $this->stackStatus;
    }

    /**
     * @param string $stackStatus
     * @return Stack
     */
    public function setStackStatus($stackStatus)
    {
        $this->stackStatus = $stackStatus;
        return $this;
    }

    /**
     * @return boolean
     */
    public function isDisableRollback()
    {
        return $this->disableRollback;
    }

    /**
     * @param boolean $disableRollback
     * @return Stack
     */
    public function setDisableRollback($disableRollback)
    {
        $this->disableRollback = $disableRollback;
        return $this;
    }

    /**
     * @return array
     */
    public function getNotificationARNs()
    {
        return $this->notificationARNs;
    }

    /**
     * @param array $notificationARNs
     * @return Stack
     */
    public function setNotificationARNs($notificationARNs)
    {
        $this->notificationARNs = $notificationARNs;
        return $this;
    }

    /**
     * @return array
     */
    public function getCapabilities()
    {
        return $this->capabilities;
    }

    /**
     * @param array $capabilities
     * @return Stack
     */
    public function setCapabilities($capabilities)
    {
        $this->capabilities = $capabilities;
        return $this;
    }

    /**
     * @return array
     */
    public function getOutputs()
    {
        return $this->outputs;
    }

    /**
     * @param array $outputs
     * @return Stack
     */
    public function setOutputs($outputs)
    {
        $this->outputs = $outputs;
        return $this;
    }

    /**
     * @return array
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * @param array $tags
     * @return Stack
     */
    public function setTags(array $tags)
    {
        foreach ($tags as $tag) {
            $this->setTag($tag['Key'], $tag['Value']);
        }
        
        return $this;
    }

    /**
     * @param $key
     * @param $value
     * @return $this
     */
    public function setTag($key, $value)
    {
        $this->tags[$key] = $value;
        return $this;
    }

    /**
     * @param $key
     * @return mixed|null
     */
    public function getTag($key)
    {
        return isset($this->tags[$key]) ? $this->tags[$key] : null;
    }
}
