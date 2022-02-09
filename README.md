# Installation

[//]: # (Add to composer.json:)

[//]: # (``` )

[//]: # ("repositories": [)

[//]: # (    {)

[//]: # (      "type": "composer",)

[//]: # (      "url": "https://asset-packagist.org")

[//]: # (    },)

[//]: # (    {)

[//]: # (      "type": "git",)

[//]: # (      "url":  "git@github.com:nimspy/quiqup.git")

[//]: # (    })

[//]: # (])

[//]: # (```)
Execute
``` bash
composer require nimspy/quiqup
```

## Usage
```php
use nimspy\quiqup\Quiqup;

$quiqup = new Quiqup([
    'api_url' => 'https://api.staging.quiqup.com/',
    'client_secret' => 'client_secret',
    'client_id' => 'client_id',
]);
```
## Create job
```php
$job = $quiqup->makeJob();

$pickup = new JobPickup();
$pickup->createItem('Pizza', 1);
$pickup->createItem('Tomato juice', 1);
$pickup->createContact('Tomas Eddison', '+380957773322');
$pickup->createLocation('1st Road', '104G', [55.1631158, 25.0559987]);
$pickup->setPartnerOrderId('XYZ123456');
$pickup->setNotes('Go directly to the kitchen on the first floor');

$dropoff = new JobDropoff();
$dropoff->createLocation('Emirattes Hills', '1006 B', [55.1599898, 25.0616772])
    ->setNotes('Please knock the door before entering as I might be naked')
    ->createContact('Tim Linssen Dropoff', '+971599999998');

$job->setPickups($pickup);
$job->setDropoffs($dropoff);

$quiqup->createJob($job);
```
## Submit job
```php
$quiqup->submitJob('20220210-39842c84');
```

## Cancel job
```php
$quiqup->cancelJob('20220210-39842c84');
```

## Retrieve job
```php
$quiqup->retrieveJob('20220210-39842c84');
```