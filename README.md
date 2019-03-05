# Fitbit Vendor SDK

This is the AllDigitalRewards Fitbit Vendor SDK. This tool is used 
for adding orders and fetching products to/from the vendor Fitbit

## Install

Via Composer

``` bash
composer config repositories.fitbit-vendor-sdk vcs git@bitbucket.org:alldigitalrewards/fitbit-vendor-sdk.git
composer require alldigitalrewards/fitbit-vendor-sdk
```

## Usage
### Getting started
``` php
<?php
require __DIR__ . '/vendor/autoload.php';

# Connect
$client = new \AllDigitalRewards\Vendor\Fitbit\Client;
```