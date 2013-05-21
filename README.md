# ManneWHipChatBundle

[![Build Status](https://travis-ci.org/ManneW/HipChatBundle.png?branch=master)](https://travis-ci.org/ManneW/HipChatBundle)

A wrapper around the HipChat PHP library, for accessing the HipChat REST API.

## Installation

### Download using composer

To install using composer, add the following to your composer.json:

```json
{
    "require": {
        "mannew/hipchat-bundle": "*"
    }
}
```

### Enable the bundle

Enable the bundle by adding it to the application kernel.

``` php
<?php
// app/AppKernel.php

public function registerBundles()
{
    $bundles = array(
        // ...
        new ManneW\HipChatBundle\ManneWHipChatBundle(),
    );
} ?>
```

### Configure the bundle

Update your config.yml to contain the a section for this bundle.

```yaml
mannew_hipchat:
	auth_token: YOUR_HIPCHAT_AUTH_TOKEN_HERE
```

## Usage

The bundle provides the DIC with a service named hipchat. To access this service you can use:

```php
<?php

$hipChat = $this->container->get('hipchat');

```


# Further reading

The service is an instance of the HipChat\HipChat class from the [HipChat PHP library](https://github.com/hipchat/hipchat-php).
