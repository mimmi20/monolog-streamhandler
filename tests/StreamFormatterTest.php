<?php
/**
 * This file is part of the mimmi20/monolog-streamformatter package.
 *
 * Copyright (c) 2022, Thomas Mueller <mimmi20@live.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace Mimmi20Test\Monolog\Formatter;

use Mimmi20\Monolog\Formatter\StreamFormatter;
use Monolog\Formatter\NormalizerFormatter;
use PHPUnit\Framework\Exception;
use PHPUnit\Framework\TestCase;
use ReflectionException;
use ReflectionProperty;
use SebastianBergmann\RecursionContext\InvalidArgumentException;

final class StreamFormatterTest extends TestCase
{
    /**
     * @throws Exception
     * @throws InvalidArgumentException
     * @throws ReflectionException
     */
    public function testConstructWithDefaults(): void
    {
        $formatter = new StreamFormatter();

        self::assertSame(NormalizerFormatter::SIMPLE_DATE, $formatter->getDateFormat());
        self::assertSame(9, $formatter->getMaxNormalizeDepth());
        self::assertSame(1000, $formatter->getMaxNormalizeItemCount());

        $ailb = new ReflectionProperty($formatter, 'allowInlineLineBreaks');
        $ailb->setAccessible(true);

        self::assertFalse($ailb->getValue($formatter));

        $format = new ReflectionProperty($formatter, 'format');
        $format->setAccessible(true);

        self::assertSame(StreamFormatter::SIMPLE_FORMAT, $format->getValue($formatter));

        $st = new ReflectionProperty($formatter, 'includeStacktraces');
        $st->setAccessible(true);

        self::assertFalse($st->getValue($formatter));

        $ts = new ReflectionProperty($formatter, 'tableStyle');
        $ts->setAccessible(true);

        self::assertSame(StreamFormatter::BOX_STYLE, $ts->getValue($formatter));
    }

    /**
     * @throws Exception
     * @throws InvalidArgumentException
     * @throws ReflectionException
     */
    public function testConstructWithValues(): void
    {
        $format                = '[%level_name%] %message%';
        $tableStyle            = 'test-style';
        $dateFormat            = 'c';
        $allowInlineLineBreaks = true;

        $formatter = new StreamFormatter($format, $tableStyle, $dateFormat, true, false);

        self::assertSame($dateFormat, $formatter->getDateFormat());
        self::assertSame(9, $formatter->getMaxNormalizeDepth());
        self::assertSame(1000, $formatter->getMaxNormalizeItemCount());

        $ailb = new ReflectionProperty($formatter, 'allowInlineLineBreaks');
        $ailb->setAccessible(true);

        self::assertTrue($ailb->getValue($formatter));

        $formatP = new ReflectionProperty($formatter, 'format');
        $formatP->setAccessible(true);

        self::assertSame($format, $formatP->getValue($formatter));

        $st = new ReflectionProperty($formatter, 'includeStacktraces');
        $st->setAccessible(true);

        self::assertFalse($st->getValue($formatter));

        $ts = new ReflectionProperty($formatter, 'tableStyle');
        $ts->setAccessible(true);

        self::assertSame($tableStyle, $ts->getValue($formatter));
    }

    /**
     * @throws Exception
     * @throws InvalidArgumentException
     * @throws ReflectionException
     */
    public function testConstructWithValues2(): void
    {
        $format     = '[%level_name%] %message%';
        $tableStyle = 'test-style';
        $dateFormat = 'c';

        $formatter = new StreamFormatter($format, $tableStyle, $dateFormat, false, true);

        self::assertSame($dateFormat, $formatter->getDateFormat());
        self::assertSame(9, $formatter->getMaxNormalizeDepth());
        self::assertSame(1000, $formatter->getMaxNormalizeItemCount());

        $ailb = new ReflectionProperty($formatter, 'allowInlineLineBreaks');
        $ailb->setAccessible(true);

        self::assertTrue($ailb->getValue($formatter));

        $formatP = new ReflectionProperty($formatter, 'format');
        $formatP->setAccessible(true);

        self::assertSame($format, $formatP->getValue($formatter));

        $st = new ReflectionProperty($formatter, 'includeStacktraces');
        $st->setAccessible(true);

        self::assertTrue($st->getValue($formatter));

        $ts = new ReflectionProperty($formatter, 'tableStyle');
        $ts->setAccessible(true);

        self::assertSame($tableStyle, $ts->getValue($formatter));
    }

    /**
     * @throws Exception
     * @throws InvalidArgumentException
     * @throws ReflectionException
     */
    public function testConstructWithValues3(): void
    {
        $format     = '[%level_name%] %message%';
        $tableStyle = 'test-style';
        $dateFormat = 'c';

        $formatter = new StreamFormatter($format, $tableStyle, $dateFormat, false, false);

        self::assertSame($dateFormat, $formatter->getDateFormat());
        self::assertSame(9, $formatter->getMaxNormalizeDepth());
        self::assertSame(1000, $formatter->getMaxNormalizeItemCount());

        $ailb = new ReflectionProperty($formatter, 'allowInlineLineBreaks');
        $ailb->setAccessible(true);

        self::assertFalse($ailb->getValue($formatter));

        $formatter->allowInlineLineBreaks();

        $ailb = new ReflectionProperty($formatter, 'allowInlineLineBreaks');
        $ailb->setAccessible(true);

        self::assertTrue($ailb->getValue($formatter));

        $formatP = new ReflectionProperty($formatter, 'format');
        $formatP->setAccessible(true);

        self::assertSame($format, $formatP->getValue($formatter));

        $st = new ReflectionProperty($formatter, 'includeStacktraces');
        $st->setAccessible(true);

        self::assertFalse($st->getValue($formatter));

        $ts = new ReflectionProperty($formatter, 'tableStyle');
        $ts->setAccessible(true);

        self::assertSame($tableStyle, $ts->getValue($formatter));
    }

    /**
     * @throws Exception
     * @throws InvalidArgumentException
     * @throws ReflectionException
     */
    public function testConstructWithValues4(): void
    {
        $format     = '[%level_name%] %message%';
        $tableStyle = 'test-style';
        $dateFormat = 'c';

        $formatter = new StreamFormatter($format, $tableStyle, $dateFormat, true, false);

        self::assertSame($dateFormat, $formatter->getDateFormat());
        self::assertSame(9, $formatter->getMaxNormalizeDepth());
        self::assertSame(1000, $formatter->getMaxNormalizeItemCount());

        $ailb = new ReflectionProperty($formatter, 'allowInlineLineBreaks');
        $ailb->setAccessible(true);

        self::assertTrue($ailb->getValue($formatter));

        $formatter->allowInlineLineBreaks(false);

        $ailb = new ReflectionProperty($formatter, 'allowInlineLineBreaks');
        $ailb->setAccessible(true);

        self::assertFalse($ailb->getValue($formatter));

        $formatP = new ReflectionProperty($formatter, 'format');
        $formatP->setAccessible(true);

        self::assertSame($format, $formatP->getValue($formatter));

        $st = new ReflectionProperty($formatter, 'includeStacktraces');
        $st->setAccessible(true);

        self::assertFalse($st->getValue($formatter));

        $formatter->includeStacktraces();

        $ailb = new ReflectionProperty($formatter, 'allowInlineLineBreaks');
        $ailb->setAccessible(true);

        self::assertTrue($ailb->getValue($formatter));

        $st = new ReflectionProperty($formatter, 'includeStacktraces');
        $st->setAccessible(true);

        self::assertTrue($st->getValue($formatter));

        $ts = new ReflectionProperty($formatter, 'tableStyle');
        $ts->setAccessible(true);

        self::assertSame($tableStyle, $ts->getValue($formatter));
    }
}
