<?php
  
declare(strict_types=1);

test('the component can be rendered', function () {
    expect($this->blade('<x-email/>'))->toMatchSnapshot();
});

test('specific attributes can be overwritten', function () {
    expect($this->blade(
        '<x-email name="email_address" id="emailAddress" class="p-4" />'
    ))->toMatchSnapshot();
});

test('inputs can have old values', function () {
    $this->flashOld(['email' => 'Eloquent']);

    expect($this->blade('<x-email/>'))->toMatchSnapshot();
});
