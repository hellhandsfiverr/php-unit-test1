# InComm Vendor SDK

This is the AllDigitalRewards InComm Vendor SDK. This tool is used 
for adding orders and fetching products to/from the vendor InComm

## Install

Via Composer

``` bash
composer config repositories.incomm-vendor-sdk vcs git@bitbucket.org:alldigitalrewards/incomm-vendor-sdk.git
composer require alldigitalrewards/incomm-vendor-sdk
```

## Usage
### Getting started
``` php
<?php
require __DIR__ . '/vendor/autoload.php';

# Connect
$client = new \AllDigitalRewards\Vendor\InComm\Client;
```

#### Examples
##### Submit an order
```

```