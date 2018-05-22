<?php

namespace spec\Yproximite\Api\Client;

use Http\Client\HttpClient;
use Http\Message\MessageFactory;
use PhpSpec\ObjectBehavior;
use Yproximite\Api\Client\AuthClient;
use Yproximite\Api\Client\GraphQLClient;

class GraphQLClientSpec extends ObjectBehavior
{
    const GRAPHQL_ENDPOINT = 'https://graphql.yproximite.fr';

    function it_is_initializable()
    {
        $this->shouldHaveType(GraphQLClient::class);
    }

    function let(HttpClient $httpClient, AuthClient $authClient, MessageFactory $messageFactory)
    {
        $this->beConstructedWith($authClient, self::GRAPHQL_ENDPOINT, $httpClient, $messageFactory);
    }

    function it_should_send_auth_request_before_graphql_request()
    {
    }

    function it_should_handle_case_where_api_token_is_invalid()
    {
    }

    function it_should_handle_case_auth_response_returns_401()
    {
    }

    function it_should_handle_case_auth_response_is_invalid_json()
    {
    }

    function it_should_send_graphql_query()
    {
    }

    function it_should_send_graphql_query_with_variables()
    {
    }

    function it_should_handle_case_when_graphql_query_returns_errors()
    {
    }

    function it_should_handle_case_when_graphql_query_returns_warnings()
    {
    }

    function it_should_send_graphql_mutation()
    {
    }

    function it_should_send_graphql_mutation_with_variables()
    {
    }

    function it_should_handle_case_when_mutation_query_returns_errors()
    {
    }

    function it_should_handle_case_when_mutation_query_returns_warnings()
    {
    }

    function it_should_upload_files_and_respect_client_immutability()
    {
    }

    function it_should_handle_case_when_uploading_is_failing()
    {
    }
}
