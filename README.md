# mattermost-driver

The Laravel Driver to interact with the [Mattermost Web Service API](https://about.mattermost.com/).

Please read the [api documentation](https://api.mattermost.com/) for further information on using this application.

## Installation

---

### Composer

The best way to install mattermost-driver is to use Composer:

```shell
composer require arsentiyz/mattermost-driver
```

Read more about how to install and use Composer on your local machine [here](https://getcomposer.org/doc/00-intro.md#installation-linux-unix-osx).

### Laravel

After installation launch the command:

```shell
php artisan vendor:publish
```

to publish the configuration file. You'll find it at `config/mattermost.php`

## Configuration

---

Edit the file `config/mattermost.php` as you prefer.

## Usage

---

```php
use \Arsentiyz\MattermostDriver\Facades\Mattermost;
 
// Retrieve the driver
$driver = Mattermost::server('default');

// Retrieve the User Model
$userModel = $driver->getUserEndpoint();

// Retrieve the User Model directly (on the default server)
$userModel = Mattermost::server()->getUserEndpoint();
```

### Via dependency injection

```php
use \Arsentiyz\MattermostDriver\Contracts\DriverContract;

// Retrieve the driver
$mattermost = app()->make(DriverContract::class);

// Retrieve the User Model
$userModel = $driver->getUserEndpoint();
```
