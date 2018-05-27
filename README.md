Client library for yProx API
============================

> A small PHP wrapper for [Yproximite GraphQL API](http://graphql-doc.yproximite.com).

[![PHP Version](https://img.shields.io/badge/PHP-%5E7.1-blue.svg)](https://img.shields.io/badge/PHP-%5E7.1-blue.svg)
[![Build Status](https://travis-ci.org/Yproximite/yprox-api-client.svg?branch=master)](https://travis-ci.org/Yproximite/yprox-api-client)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/Yproximite/yprox-api-client/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/Yproximite/yprox-api-client/?branch=master)

## Usage

### Instantiation

```php
<?php

use Yproximite\Api\Client\AuthClient;
use Yproximite\Api\Client\GraphQLClient;

$authClient = new AuthClient('<Your Yproximite API Key>');
$client = new GraphQLClient($authClient);
```

### Query 

```php
<?php

// Simple query
$response = $client->query('{ me { firstName } }');

// You can pass variables
$variables = ['siteId' => 123];
$response  = $client->query('
  query FetchSite($siteId: Int!) { 
    site(siteId: $siteId) {
      host
      ...
    }
  }
', $variables);

$response->getData(); // ['site' => ['host' => '...', ...]];
```

### Mutation

```php
<?php

$variables = [
    'siteId' => 123, 
    'input' => [
        'title' => 'My category',
    ]
];

$response  = $client->mutation('
  mutation CreateMediaCategory($siteId: Int!, $input: CreateMediaCategoryInput!) {
    createMediaCategory(input: $input, siteId: $siteId) {
      id
    }
  }
', $variables);

$response->getData(); // ['createMediaCategory' => ['id' => 123]]

```

### Upload

You need to specify a Site's id where you want to upload medias.

```php
<?php

$siteId = 123;
$files = [
    '/full/path/to/file.jpg',
    ['path' => 'full/path/to/file.jpg', 'name' => 'Custom filename.jpg'],
];

$response = $client->upload($siteId, $files);
$response->getUploadedMedias(); // returns array of Media 

```

### Handling errors

When the response payload contains errors.

```php
<?php

$response = $client->query();
// or
$response = $client->mutation();
// or
$response = $client->uploadFiles();

// Then handle errors
$response->hasErrors(); // boolean
$response->getErrors(); // array of errors, if any
```

### Handling warnings

When sometimes you don't have access to a field.

```php
<?php

$response = $client->query();
// or
$response = $client->mutation();

// Then handle errors
$response->hasWarnings(); // boolean
$response->getWarnings(); // array of warnings, if any
```

## Examples

### Create a new Article

We will use `createArticle` [mutation](https://graphql-doc.yproximite.com/mutation.doc.html).
We should specify [input data](https://graphql-doc.yproximite.com/createarticleinput.doc.html) and a Site id.

```php
<?php

use Yproximite\Api\Client\AuthClient;
use Yproximite\Api\Client\GraphQLClient;

$authClient = new AuthClient('<Your Yproximite API Key>');
$client = new GraphQLClient($authClient);

// Since GraphQL query can sometimes be very long, you can export them into .graphql files.
$mutation = '
    mutation CreateArticle($input: CreateArticleInput!, $siteId: Int!) {
      createArticle(input: $input, siteId: $siteId) {
        id
        inheritanceStatus
        mediaLimit
        status
        shareOnFacebook
        categories {
          enabled
          createdAt
          updatedAt
          translations {
            locale
            title
          }
        }
        translations {
          title
          slug
          locale
        }
        articleMedias {
          id
          displayOrder
          media {
            id
            fullpathFilename
          }
        }
      }
    }
';

$variables = [
    'siteId' => 123,
    'input' => [ // we should follow `CreateArticleInput` format
        'translations' => [
            [
                'locale' => 'en',
                'title' => 'Hello world',
                'body' => 'This is my first mutation!',
            ]
        ],
        'categories' => [1, 2, 3], // ID of Categories that belongs to your Site
        'articlesMedias' => [1, 2], // ID of Medias that belongs to your Site
        'status' => 'PUBLISHED'
    ]
];

// Send mutation
$response = $client->mutation($mutation, $variables);

if ($response->hasErrors()) {
   // Handle errors if any...
}

$createdArticle = $response->getData()['createArticle'];

var_dump($createdArticle['id']);
var_dump($createdArticle['categories']);
var_dump($createdArticle['translations']);

```


## Development

```
$ make install-git-hooks
$ ./bin/php-cs-fixer fix
```
