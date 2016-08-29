<?php
/**
 * Application.php
 *
 * @copyright Copyright (c) 2016 Continuous S.A. (https://continuousphp.com)
 * @license   http://opensource.org/licenses/Apache-2.0 Apache License, Version 2.0
 * @file      Application.php
 * @link      http://github.com/continuousphp/aws-cf-killer the canonical source repo
 */

namespace Continuous\Aws\Killer;

use Aws\CloudFormation\CloudFormationClient;
use Continuous\Aws\Killer\Stack\Collection;
use Continuous\Aws\Killer\Stack\Hydrator;
use Continuous\Aws\Killer\Stack\Stack;

/**
 * Application
 *
 * @package    Continuous\Aws\Killer
 * @license    http://opensource.org/licenses/Apache-2.0 Apache License, Version 2.0
 */
class Application
{
    /** @var  array */
    protected $config;
    
    /** @var  CloudFormationClient */
    protected $client;
    
    /** @var  Hydrator */
    protected $hydrator;

    /**
     * Application constructor.
     * @param $config
     */
    public function __construct($config)
    {
        $this->config = $config;
    }

    /**
     * @return CloudFormationClient
     */
    public function getClient()
    {
        if (is_null($this->client)) {
            $this->setClient(new CloudFormationClient($this->config['aws']));
        }
        
        return $this->client;
    }

    /**
     * @param CloudFormationClient $client
     * @return $this
     */
    public function setClient(CloudFormationClient $client)
    {
        $this->client = $client;
        
        return $this;
    }

    /**
     * @return Hydrator
     */
    public function getHydrator()
    {
        if (is_null($this->hydrator)) {
            $this->setHydrator(new Hydrator());
        }
        
        return $this->hydrator;
    }

    /**
     * @param Hydrator $hydrator
     * @return Application
     */
    public function setHydrator($hydrator)
    {
        $this->hydrator = $hydrator;
        return $this;
    }

    /**
     * Run the application
     */
    public function run()
    {
        $stacks = $this->getStacks();
        
        foreach ($stacks as $stack) {
            $this->deleteStack($stack);
        }
    }

    /**
     * @param Stack $stack
     * @return bool
     */
    public function match(Stack $stack)
    {
        foreach ($this->config['tags'] as $key => $value) {
            if ($stack->getTag($key)!=$value) {
                return false;
            }
        }
        
        return true;
    }

    /**
     * @return Collection
     */
    public function getStacks()
    {
        $collection = new Collection();
        
        $rawResults = $this->getClient()->listStacks([
            'StackStatusFilter' => $this->config['statusList']
        ]);
        
        foreach ($rawResults['StackSummaries'] as $stackSummary) {
            $stackData = $this->getClient()->describeStacks([
                'StackName' => $stackSummary['StackName']
            ]);
            
            $stack = new Stack();
            $this->getHydrator()->hydrate($stackData['Stacks'][0], $stack);
            if ($this->match($stack)) {
                $collection->add($stack);
            }
        }
        
        return $collection;
    }

    /**
     * @param Stack $stack
     * @return $this
     */
    public function deleteStack(Stack $stack)
    {
        try {
            $this->getClient()->deleteStack([
                'StackName' => $stack->getStackName()
            ]);
            echo '[' . date('c') . '] Deleting stack ' . $stack->getStackName() . PHP_EOL;
        } catch (\Exception $e) {
            echo 'Unable to delete stack ' . $stack->getStackName() . PHP_EOL
               . $e->getMessage();
        }
        
        return $this;
    }
}
