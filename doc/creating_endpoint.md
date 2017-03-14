# Creating a new endpoint

* [Task](#task)
* [Implementation](#implementation)
* [Testing](#testing)
* [Usage](#usage)

### Task

Request:

```
POST /cars HTTP/1.1
Host: api.yproximite.fr
Content-Type: application/json

{
    "api_car": {
        "name": "My car",
        "color": "red"
    }
}
```

Response:

```json
{
  "id": 1,
  "name": "My car",
  "color": "red"
}
```

### Implementation

Before start, we need to take a look on the [architecture](./architecture.md) and on the [naming conventions](./naming.md).
As we see, we need to implement `Message`, `Service` and `Model`.

To implement the endpoint, using the following , we need to create:

- the `CarService` that will have the `postCar()` method;
- add the `CarService` into the `ServiceAggregator` to be able to access it using the `car()` method;
- the `CarPostMessage` that we will send;
- the `Car` model that we will receive.

**CarService.php**

```php
<?php
declare(strict_types=1);

namespace Yproximite\Api\Service;

use Yproximite\Api\Model\Car\Car;
use Yproximite\Api\Message\Car\CarPostMessage;

/**
 * Class CarService
 */
class CarService extends AbstractService implements ServiceInterface
{
    /**
     * @param CarPostMessage $message
     *
     * @return Car
     */
    public function postCar(CarPostMessage $message): Car
    {
        $path = 'cars';
        $data = ['api_car' => $message->build()];

        $response = $this->getClient()->sendRequest('POST', $path, $data);

        /** @var Car $model */
        $model = $this->getModelFactory()->create(Car::class, $response);

        return $model;
    }
}
```

**ServiceAggregator.php**

```php
<?php
// ...

/**
 * Class ServiceAggregator
 */
class ServiceAggregator
{
    // ...

    /**
     * @return CarService
     */
    public function car(): CarService
    {
        /** @var CarService $service */
        $service = $this->getService(CarService::class);

        return $service;
    }

    // ...
}
```

**CarPostMessage.php**

You can use the following traits simplify the message class:

- `Yproximite\Api\Message\IdentityAwareMessageTrait`
- `Yproximite\Api\Message\LocaleAwareMessageTrait`
- `Yproximite\Api\Message\SiteAwareMessageTrait`

```php
<?php
declare(strict_types=1);

namespace Yproximite\Api\Message\Car;

use Yproximite\Api\Model\Car\Car;
use Yproximite\Api\Message\MessageInterface;

/**
 * Class CarPostMessage
 */
abstract class CarPostMessage implements MessageInterface
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var string|null
     */
    private $color;

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }

    /**
     * @see Car::getColors()
     *
     * @return null|string
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * @param null|string $color
     */
    public function setColor(string $color = null)
    {
        $this->color = $color;
    }

    /**
     * {@inheritdoc}
     */
    public function build()
    {
        return [
            'name'  => $this->getName(),
            'color' => $this->getColor(),
        ];
    }
}
```

**Car.php**

```php
<?php
declare(strict_types=1);

namespace Yproximite\Api\Model\Car;

use Yproximite\Api\Model\ModelInterface;

/**
 * Class Car
 */
class Car implements ModelInterface
{
    const COLOR_RED   = 'red';
    const COLOR_GREEN = 'green';
    const COLOR_BLUE  = 'blue';

    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string|null
     */
    private $color;

    /**
     * @return string[]
     */
    public static function getColors(): array
    {
        return [
            self::COLOR_RED,
            self::COLOR_GREEN,
            self::COLOR_BLUE,
        ];
    }

    /**
     * Car constructor.
     *
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->id    = (int) $data['id'];
        $this->name  = (string) $data['name'];
        $this->color = !empty($data['color']) ? (string) $data['color'] : null;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @see Car::getColors()
     *
     * @return string|null
     */
    public function getColor()
    {
        return $this->color;
    }
}
```

### Testing

**CarServiceSpec.php**

```php
<?php

namespace spec\Yproximite\Api\Service;

use PhpSpec\ObjectBehavior;

use Yproximite\Api\Client\Client;
use Yproximite\Api\Model\Car\Car;
use Yproximite\Api\Service\CarService;
use Yproximite\Api\Factory\ModelFactory;
use Yproximite\Api\Message\Car\CarPostMessage;

class CarServiceSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(CarService::class);
    }

    function let(Client $client, ModelFactory $factory)
    {
        $this->beConstructedWith($client, $factory);
    }

    function it_should_post_Car(
        Client $client,
        ModelFactory $factory,
        CarPostMessage $message,
        Car $car
    ) {
        $message->build()->willReturn([]);

        $method = 'POST';
        $path   = 'cars';
        $data   = ['api_car' => []];

        $client->sendRequest($method, $path, $data)->willReturn([]);
        $client->sendRequest($method, $path, $data)->shouldBeCalled();

        $factory->create(Car::class, [])->willReturn($car);

        $this->postCar($message);
    }
}
```

**CarPostMessageSpec.php**

```php
<?php

namespace spec\Yproximite\Api\Message\Car;

use PhpSpec\ObjectBehavior;

use Yproximite\Api\Model\Car\Car;
use Yproximite\Api\Message\Car\CarPostMessage;

class CarPostMessageSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(CarPostMessage::class);
    }

    function it_should_build()
    {
        $this->setName('First car');
        $this->setColor(Car::COLOR_GREEN);

        $data = [
            'name'  => 'First car',
            'color' => 'green',
        ];

        $this->build()->shouldReturn($data);
    }
}
```

**CarSpec.php**

```php
<?php

namespace spec\Yproximite\Api\Model\Car;

use PhpSpec\ObjectBehavior;

use Yproximite\Api\Model\Car\Car;

class CarSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Car::class);
    }

    function let()
    {
        $data = [
            'id'      => '4',
            'carName' => 'First car',
            'color'   => 'green',
        ];

        $this->beConstructedWith($data);
    }

    function it_should_be_hydrated()
    {
        $this->getId()->shouldReturn(4);
        $this->getName()->shouldReturn('First car');
        $this->getColor()->shouldReturn(Car::COLOR_GREEN);
    }
}
```

### Usage

```php
use Yproximite\Api\Model\Car\Car;
use Yproximite\Api\Message\Car\CarPostMessage;

// .. set up a client, a service aggregator

$message = new CarPostMessage();
$message->setName('My car');
$message->setColor(Car::COLOR_RED);

// Yproximite\Api\Model\Car\Car
$car = $api->car()->postCar($message);

print_r([
    'id'    => $car->getId(),
    'name'  => $car->getName(),
    'color' => $car->getColor(),
]);
```

```
Array
(
    [id] => 1
    [name] => My car
    [color] => red
)
```
