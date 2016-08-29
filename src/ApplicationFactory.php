<?php
/**
 * ApplicationFactory.php
 *
 * @copyright Copyright (c) 2016 Continuous S.A. (https://continuousphp.com)
 * @license   http://opensource.org/licenses/Apache-2.0 Apache License, Version 2.0
 * @file      ApplicationFactory.php
 * @link      http://github.com/continuousphp/aws-cf-killer the canonical source repo
 */

namespace Continuous\Aws\Killer;

/**
 * ApplicationFactory
 *
 * @package    Continuous\Aws\Killer
 * @license    http://opensource.org/licenses/Apache-2.0 Apache License, Version 2.0
 */
class ApplicationFactory
{
    /**
     * @return array
     */
    public function getConfig()
    {
        $config = require 'config/default.php';
        
        if (file_exists('config/local.php')) {
            $config = array_merge_recursive($config, require 'config/local.php');
        }
        
        return $config;
    }

    /**
     * @return Application
     */
    public function createApplication()
    {
        return new Application($this->getConfig());
    }
}
