<?php
/**
 * Created by PhpStorm.
 * User: fred
 * Date: 29/08/16
 * Time: 11:38
 */

namespace Continuous\Test\Aws\Killer;

use Aws\CloudFormation\CloudFormationClient;
use Continuous\Aws\Killer\Application;
use Continuous\Aws\Killer\Stack\Collection;
use Continuous\Aws\Killer\Stack\Stack;

class ApplicationTest extends \PHPUnit_Framework_TestCase
{

    public function testGetStackReturnAnHydratedStackCollection()
    {
        $config = require 'config/default.php';
        $application = new Application($config);
        $client = $this->getMockBuilder(CloudFormationClient::class)
            ->disableOriginalConstructor()
            ->setMethods(['listStacks', 'describeStacks'])
            ->getMock();
        
        $client->expects($this->once())
            ->method('listStacks')
            ->willReturn([
                'StackSummaries' =>
                [
                    [
                        'StackName' => 'toto'
                    ]
                ]
            ]);
        
        $client->expects($this->once())
            ->method('describeStacks')
            ->with(['StackName' => 'toto'])
            ->willReturn([
                'Stacks' => [
                    [
                        'StackName' => 'toto'
                    ]
                ]
            ]);
        
        $application->setClient($client);
        
        $result = $application->getStacks();
        $this->assertInstanceOf(Collection::class, $result);
        $this->assertInstanceOf(Stack::class, $result[0]);
        $this->assertEquals('toto', $result[0]->getStackName());
    }

    public function getStacks()
    {
        $stack0 = new Stack();
        $stack0->setTag('env', 'test');
        $stack1 = new Stack();
        
        return [
            [
                $stack0,
                [
                    'env' => 'test'
                ],
                true
            ],
            [
                $stack1,
                [
                    'env' => 'test'
                ],
                false
            ]
        ];
    }
    
    /**
     * @dataProvider getStacks
     * @param $stack
     * @param $tags
     * @param $match
     */
    public function testMatch($stack, $tags, $match)
    {
        $application = new Application([
            'tags' => $tags
        ]);
        
        $this->assertEquals($match, $application->match($stack));
    }
}
