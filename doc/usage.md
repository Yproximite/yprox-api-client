# Usage

### Bootstrapping

```php
<?php
use Yproximite\Api\Client\Client;
use Yproximite\Api\Service\ServiceAggregator;

// Step 1: Create a client

$client = new Client(
    // Http\Client\HttpClient
    $httpClient,                        // An implementation of the http client (see http://httplug.io/)
    $apiKey = 'xxxxxx',                 // API key
    $baseUrl = Client::BASE_URL,        // Base url for API-calls
    // Http\Message\MessageFactory|null
    $messageFactory = null              // An implementation of the http message factory (see http://httplug.io/)
);

// Step 2: Inject the client to the service aggregator

$api = new ServiceAggregator($client);

// Step 3: Enjoy the API

// ..
```

### Retrieving a list of articles

```php
<?php
use Yproximite\Api\Message\Article\ArticleListMessage;

$message = new ArticleListMessage();
$message->setSiteId(1);

// Yproximite\Api\Model\Article\Article[]
$articles = $api->article()->getArticles($message);
```

### Posting an article

```php
<?php
use Yproximite\Api\Model\Article\Article;
use Yproximite\Api\Message\Article\ArticlePostMessage;
use Yproximite\Api\Message\Article\ArticleMediaMessage;
use Yproximite\Api\Message\Article\ArticleTranslationMessage;

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

// Yproximite\Api\Model\Article\Article
$article = $api->article()->postArticle($message);
```

### Unpublishing articles

```php
<?php
use Yproximite\Api\Message\Article\ArticleUnpublishMessage;

$message = new ArticleUnpublishMessage();
$message->setSiteId(5);
$message->setArticleIds([1, 5, 30]);

// Yproximite\Api\Model\Article\Article[]
$api->article()->unpublishArticles($message);
```
