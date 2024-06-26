<?php

declare(strict_types=1);

use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Http;
use Illuminate\View\ViewException;

beforeEach(function () {
    config()->set('services.unsplash.access_key', 'testing');
});

it('can be rendered', function () {
    $url = 'https://images.unsplash.com/photo-1550340499-a6c60fc8287c?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEzNDg5Mn0';

    Http::fake([
        'unsplash.com/*' => Http::response(['urls' => ['raw' => $url]], 200, ['Headers']),
    ]);

    expect(blade('<x-unsplash photo="t9Td0zfDTwI"/>'))->toMatchSnapshot();
});

it('can set a specific width or height', function () {
    $url = 'https://images.unsplash.com/photo-1550340499-a6c60fc8287c?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEzNDg5Mn0&';

    Http::fake([
        'unsplash.com/*' => Http::response(['urls' => ['raw' => $url]], 200, ['Headers']),
    ]);

    expect(blade('<x-unsplash photo="t9Td0zfDTwI" width="200"/>'))->toMatchSnapshot();
});

it('throws an error when the photo url in invalid', function () {
    $url = 'https://images.unsplash.com/does-not-exist';

    Http::fake([
        'unsplash.com/*' => Http::response(['urls' => ['raw' => $url]], 404, ['Headers']),
    ]);

    blade('<x-unsplash photo="foo" width="200"/>');
})->throws(ViewException::class);
