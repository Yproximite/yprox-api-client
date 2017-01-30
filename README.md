Client library for yProx API
============================

# Usage

```php
use Http\Client\HttpClient;
use Http\Message\MessageFactory;

use Yproximite\Api\Client\Client;
use Yproximite\Api\Model\Article\Article;
use Yproximite\Api\Service\ServiceAggregator;
use Yproximite\Api\Message\ArticlePostMessage;
use Yproximite\Api\Message\ArticleMediaMessage;
use Yproximite\Api\Message\ArticleTranslationMessage;

// Step 1: Create a client

$client = new Client(
    HttpClient $httpClient,               // An implementation of the http client (see http://httplug.io/)
    $apiKey = 'xxxxxx',                   // API key
    $baseUrl = Client::BASE_URL,          // Base url for API-calls
    MessageFactory $messageFactory = null // An implementation of the http message factory (see http://httplug.io/)
);

// Step 2: Inject the client to the service aggregator

$api = new ServiceAggregator($client);

// Step 3: Enjoy the API

$translation = new ArticleTranslationMessage();
$translation->setLocale('en');
$translation->setTitle('My article');
$translation->setBody('Some content');

$media = new ArticleMediaMessage();
$media->setMediaId(1);
$media->setDisplayOrder(5);

$message = new ArticlePostMessage();
$message->setStatus(Article::STATUS_PUBLISHED);
$message->setCategoryIds([1, 2]);
$message->setMediaLimit(5);
$message->setShareOnFacebook(true);
$message->addTranslation($translation);
$message->addMedia($media);

// Yproximite\Api\Model\Article
$article = $api->article()->postArticle($message);
```

# Data flow diagram

![Data flow](./doc/data_flow.png)
