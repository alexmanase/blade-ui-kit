<?php

  
declare(strict_types=1);
use BladeUIKit\Components\Support\Cron;
use PHPUnit\Framework\Attributes\Test;
test('the component can be rendered', function () {
    $expected = <<<'HTML'
            <span title="Every Sunday at 12:00am">
                @weekly
            </span>
            HTML;

    $this->assertComponentRenders($expected, '<x-cron schedule="@weekly"/>');
});
it('can translate a cron', function () {
    $cron = new Cron('0 16 * * 1');

    expect($cron->translate())->toBe('Every Monday at 4:00pm');
});
it('s component can be rendered as human readable', function () {
    $expected = <<<'HTML'
            <span title="@weekly">
                Every Sunday at 12:00am
            </span>
            HTML;

    $this->assertComponentRenders($expected, '<x-cron schedule="@weekly" human/>');
});
