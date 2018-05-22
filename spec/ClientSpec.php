<?php

namespace spec\Yproximite\Api;

use Http\Client\HttpClient;
use Http\Message\MessageFactory;
use PhpSpec\ObjectBehavior;
use Yproximite\Api\Client;

class ClientSpec extends ObjectBehavior
{
    const GRAPHQL_ENDPOINT = 'https://graphql.yproximite.fr';

    function it_is_initializable()
    {
        $this->shouldHaveType(Client::class);
    }

    function let(HttpClient $httpClient, MessageFactory $messageFactory)
    {
        $this->beConstructedWith($httpClient, '<api_key>', self::GRAPHQL_ENDPOINT, $messageFactory);
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
