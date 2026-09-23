<?php

// Auto-generated -- do not edit

declare(strict_types=1);

namespace Gisl\Generated\Operations\Tests;

use PHPUnit\Framework\TestCase;
use Gisl\Generated\Operations\VideoWatermarkVideoAnchor;
use Gisl\Generated\Operations\VideoWatermarkVideoOptions;

final class VideoWatermarkTest extends TestCase
{
    public function testVideoWatermarkVideoAnchorTopLeftBackingValue(): void
    {
        $enum = VideoWatermarkVideoAnchor::from('top_left');
        $this->assertSame(VideoWatermarkVideoAnchor::TopLeft, $enum);
        $this->assertSame('top_left', $enum->value);
    }

    public function testVideoWatermarkVideoAnchorTopCenterBackingValue(): void
    {
        $enum = VideoWatermarkVideoAnchor::from('top_center');
        $this->assertSame(VideoWatermarkVideoAnchor::TopCenter, $enum);
        $this->assertSame('top_center', $enum->value);
    }

    public function testVideoWatermarkVideoAnchorTopRightBackingValue(): void
    {
        $enum = VideoWatermarkVideoAnchor::from('top_right');
        $this->assertSame(VideoWatermarkVideoAnchor::TopRight, $enum);
        $this->assertSame('top_right', $enum->value);
    }

    public function testVideoWatermarkVideoAnchorCenterLeftBackingValue(): void
    {
        $enum = VideoWatermarkVideoAnchor::from('center_left');
        $this->assertSame(VideoWatermarkVideoAnchor::CenterLeft, $enum);
        $this->assertSame('center_left', $enum->value);
    }

    public function testVideoWatermarkVideoAnchorCenterBackingValue(): void
    {
        $enum = VideoWatermarkVideoAnchor::from('center');
        $this->assertSame(VideoWatermarkVideoAnchor::Center, $enum);
        $this->assertSame('center', $enum->value);
    }

    public function testVideoWatermarkVideoAnchorCenterRightBackingValue(): void
    {
        $enum = VideoWatermarkVideoAnchor::from('center_right');
        $this->assertSame(VideoWatermarkVideoAnchor::CenterRight, $enum);
        $this->assertSame('center_right', $enum->value);
    }

    public function testVideoWatermarkVideoAnchorBottomLeftBackingValue(): void
    {
        $enum = VideoWatermarkVideoAnchor::from('bottom_left');
        $this->assertSame(VideoWatermarkVideoAnchor::BottomLeft, $enum);
        $this->assertSame('bottom_left', $enum->value);
    }

    public function testVideoWatermarkVideoAnchorBottomCenterBackingValue(): void
    {
        $enum = VideoWatermarkVideoAnchor::from('bottom_center');
        $this->assertSame(VideoWatermarkVideoAnchor::BottomCenter, $enum);
        $this->assertSame('bottom_center', $enum->value);
    }

    public function testVideoWatermarkVideoAnchorBottomRightBackingValue(): void
    {
        $enum = VideoWatermarkVideoAnchor::from('bottom_right');
        $this->assertSame(VideoWatermarkVideoAnchor::BottomRight, $enum);
        $this->assertSame('bottom_right', $enum->value);
    }

    public function testVideoWatermarkVideoAnchorCaseCount(): void
    {
        $this->assertCount(9, VideoWatermarkVideoAnchor::cases());
    }

    public function testVideoWatermarkVideoOptionsDefaultConstruction(): void
    {
        $obj = new VideoWatermarkVideoOptions();
        $this->assertInstanceOf(VideoWatermarkVideoOptions::class, $obj);
        $this->assertSame(VideoWatermarkVideoAnchor::BottomRight, $obj->anchor);
        $this->assertSame('2%', $obj->margin_x);
        $this->assertSame('2%', $obj->margin_y);
        $this->assertSame(0.5, $obj->opacity);
        $this->assertNull($obj->overlay_width);
    }

    public function testVideoWatermarkVideoOptionsFullConstruction(): void
    {
        $obj = new VideoWatermarkVideoOptions(
            anchor: VideoWatermarkVideoAnchor::TopLeft,
            margin_x: 'test_value',
            margin_y: 'test_value',
            opacity: 0.0,
            overlay_width: 'test_value',
        );
        $this->assertInstanceOf(VideoWatermarkVideoOptions::class, $obj);
    }

}
