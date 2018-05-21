<?php

namespace spec\Yproximite\Api;

use PhpSpec\ObjectBehavior;
use Yproximite\Api\Response;

class ResponseSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->beConstructedWith([]);
        $this->shouldHaveType(Response::class);
    }

    public function it_should_be_valid()
    {
        $data = [
            'me' => [
                'firstName' => 'Hugo',
                'lastName'  => 'Alliaume',
            ],
        ];

        $this->beConstructedWith(['data' => $data]);

        $this->getData()->shouldBeLike((object) $data);

        $this->hasErrors()->shouldReturn(false);
        $this->getErrors()->shouldReturn([]);

        $this->hasWarnings()->shouldReturn(false);
        $this->getWarnings()->shouldReturn([]);
    }

    public function it_should_has_errors()
    {
        $errors = [
            [
                'message' => 'An error message.',
                'path'    => ['path', 'to', 'field'],
            ],
        ];

        $this->beConstructedWith([
            'data'   => null,
            'errors' => $errors,
        ]);

        $this->getData()->shouldReturn(null);

        $this->hasErrors()->shouldReturn(true);
        $this->getErrors()->shouldReturn($errors);

        $this->hasWarnings()->shouldReturn(false);
        $this->getWarnings()->shouldReturn([]);
    }

    public function it_should_has_warnings()
    {
        $data = [
            'foo' => [
                'bar'  => null,
                'site' => ['id' => 123],
            ],
        ];

        $warnings = [
            [
                'message' => 'Access denied to this field',
                'path'    => ['foo', 'bar'],
            ],
        ];

        $this->beConstructedWith([
            'data'       => $data,
            'extensions' => [
                'warnings' => $warnings,
            ],
        ]);

        $this->getData()->shouldBeLike((object) $data);

        $this->hasErrors()->shouldReturn(false);
        $this->getErrors()->shouldReturn([]);

        $this->hasWarnings()->shouldReturn(true);
        $this->getWarnings()->shouldReturn($warnings);
    }
}
