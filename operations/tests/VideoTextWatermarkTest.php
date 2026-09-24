<?php

// Auto-generated -- do not edit

declare(strict_types=1);

namespace Gisl\Generated\Operations\Tests;

use PHPUnit\Framework\TestCase;
use Gisl\Generated\Operations\VideoTextWatermarkVideoAnchor;
use Gisl\Generated\Operations\VideoTextWatermarkVideoFontFamily;
use Gisl\Generated\Operations\VideoTextWatermarkVideoOptions;
use Gisl\Generated\Operations\VideoTextWatermarkVideoWatermarkMode;

final class VideoTextWatermarkTest extends TestCase
{
    public function testVideoTextWatermarkVideoFontFamilyLiberationSansBackingValue(): void
    {
        $enum = VideoTextWatermarkVideoFontFamily::from('liberation_sans');
        $this->assertSame(VideoTextWatermarkVideoFontFamily::LiberationSans, $enum);
        $this->assertSame('liberation_sans', $enum->value);
    }

    public function testVideoTextWatermarkVideoFontFamilyCaseCount(): void
    {
        $this->assertCount(1, VideoTextWatermarkVideoFontFamily::cases());
    }

    public function testVideoTextWatermarkVideoWatermarkModeSingleBackingValue(): void
    {
        $enum = VideoTextWatermarkVideoWatermarkMode::from('single');
        $this->assertSame(VideoTextWatermarkVideoWatermarkMode::Single, $enum);
        $this->assertSame('single', $enum->value);
    }

    public function testVideoTextWatermarkVideoWatermarkModeTiledBackingValue(): void
    {
        $enum = VideoTextWatermarkVideoWatermarkMode::from('tiled');
        $this->assertSame(VideoTextWatermarkVideoWatermarkMode::Tiled, $enum);
        $this->assertSame('tiled', $enum->value);
    }

    public function testVideoTextWatermarkVideoWatermarkModeCaseCount(): void
    {
        $this->assertCount(2, VideoTextWatermarkVideoWatermarkMode::cases());
    }

    public function testVideoTextWatermarkVideoAnchorTopLeftBackingValue(): void
    {
        $enum = VideoTextWatermarkVideoAnchor::from('top_left');
        $this->assertSame(VideoTextWatermarkVideoAnchor::TopLeft, $enum);
        $this->assertSame('top_left', $enum->value);
    }

    public function testVideoTextWatermarkVideoAnchorTopCenterBackingValue(): void
    {
        $enum = VideoTextWatermarkVideoAnchor::from('top_center');
        $this->assertSame(VideoTextWatermarkVideoAnchor::TopCenter, $enum);
        $this->assertSame('top_center', $enum->value);
    }

    public function testVideoTextWatermarkVideoAnchorTopRightBackingValue(): void
    {
        $enum = VideoTextWatermarkVideoAnchor::from('top_right');
        $this->assertSame(VideoTextWatermarkVideoAnchor::TopRight, $enum);
        $this->assertSame('top_right', $enum->value);
    }

    public function testVideoTextWatermarkVideoAnchorCenterLeftBackingValue(): void
    {
        $enum = VideoTextWatermarkVideoAnchor::from('center_left');
        $this->assertSame(VideoTextWatermarkVideoAnchor::CenterLeft, $enum);
        $this->assertSame('center_left', $enum->value);
    }

    public function testVideoTextWatermarkVideoAnchorCenterBackingValue(): void
    {
        $enum = VideoTextWatermarkVideoAnchor::from('center');
        $this->assertSame(VideoTextWatermarkVideoAnchor::Center, $enum);
        $this->assertSame('center', $enum->value);
    }

    public function testVideoTextWatermarkVideoAnchorCenterRightBackingValue(): void
    {
        $enum = VideoTextWatermarkVideoAnchor::from('center_right');
        $this->assertSame(VideoTextWatermarkVideoAnchor::CenterRight, $enum);
        $this->assertSame('center_right', $enum->value);
    }

    public function testVideoTextWatermarkVideoAnchorBottomLeftBackingValue(): void
    {
        $enum = VideoTextWatermarkVideoAnchor::from('bottom_left');
        $this->assertSame(VideoTextWatermarkVideoAnchor::BottomLeft, $enum);
        $this->assertSame('bottom_left', $enum->value);
    }

    public function testVideoTextWatermarkVideoAnchorBottomCenterBackingValue(): void
    {
        $enum = VideoTextWatermarkVideoAnchor::from('bottom_center');
        $this->assertSame(VideoTextWatermarkVideoAnchor::BottomCenter, $enum);
        $this->assertSame('bottom_center', $enum->value);
    }

    public function testVideoTextWatermarkVideoAnchorBottomRightBackingValue(): void
    {
        $enum = VideoTextWatermarkVideoAnchor::from('bottom_right');
        $this->assertSame(VideoTextWatermarkVideoAnchor::BottomRight, $enum);
        $this->assertSame('bottom_right', $enum->value);
    }

    public function testVideoTextWatermarkVideoAnchorCaseCount(): void
    {
        $this->assertCount(9, VideoTextWatermarkVideoAnchor::cases());
    }

    public function testVideoTextWatermarkVideoOptionsDefaultConstruction(): void
    {
        $obj = new VideoTextWatermarkVideoOptions(
            text: 'test_value',
        );
        $this->assertInstanceOf(VideoTextWatermarkVideoOptions::class, $obj);
        $this->assertSame(48.0, $obj->font_size);
        $this->assertSame('#FFFFFF80', $obj->color);
        $this->assertSame(VideoTextWatermarkVideoFontFamily::LiberationSans, $obj->font_family);
        $this->assertSame(VideoTextWatermarkVideoWatermarkMode::Single, $obj->watermark_mode);
        $this->assertSame(VideoTextWatermarkVideoAnchor::BottomRight, $obj->anchor);
        $this->assertSame('2%', $obj->margin_x);
        $this->assertSame('2%', $obj->margin_y);
        $this->assertSame(1.0, $obj->opacity);
        $this->assertNull($obj->rotation);
        $this->assertNull($obj->tile_spacing);
    }

    public function testVideoTextWatermarkVideoOptionsFullConstruction(): void
    {
        $obj = new VideoTextWatermarkVideoOptions(
            text: 'test_value',
            font_size: 8.0,
            color: 'test_value',
            font_family: VideoTextWatermarkVideoFontFamily::LiberationSans,
            rotation: -360.0,
            watermark_mode: VideoTextWatermarkVideoWatermarkMode::Single,
            tile_spacing: 0,
            anchor: VideoTextWatermarkVideoAnchor::TopLeft,
            margin_x: 'test_value',
            margin_y: 'test_value',
            opacity: 0.0,
        );
        $this->assertInstanceOf(VideoTextWatermarkVideoOptions::class, $obj);
    }

}
