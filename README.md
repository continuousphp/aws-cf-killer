AWS Cloud Formation killer
==========================

[![Build Status](https://status.continuousphp.com/git-hub/continuousphp/aws-cf-killer?token=bd587eb4-e2d3-420a-beec-8765003fe0af&branch=master)](https://continuousphp.com/git-hub/continuousphp/aws-cf-killer)

An application to delete running stacks based on tags matching

## Requirements

* PHP 5.6+

# Installation

* Download [Composer](https://getcomposer.org/download/): `curl -sS https://getcomposer.org/composer.phar -o composer.phar`
* Install the Deploy Agent: `php composer.phar create-project -s dev continuousphp/aws-cf-killer`

## Setup the application

Create a `config/local.php` file as following:
```php

<?php

return [
    // AWS SDK configuration as describe in the doc
    'aws' =>
    [
        'region' => 'us-east-1',
        'credentials' =>
        [
            'key' => 'XXXXXXXXXXXXXXXXXXXX',
            'secret' => 'ZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZ'
        ]
    ],
    // tags to match for deletion
    'tags' =>
    [
        'env' => 'acceptance'
    ]
];

```
_More information about AWS SDK configuration could be found [here](http://docs.aws.amazon.com/aws-sdk-php/v3/api/class-Aws.AwsClient.html#___construct)_

Start using with: `./bin/kill`