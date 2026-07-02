<?php

// Auto-generated -- do not edit

declare(strict_types=1);

namespace Gisl\Generated\Operations\Tests;

use PHPUnit\Framework\TestCase;
use Gisl\Generated\Operations\ImageWatermarkImageAnchor;
use Gisl\Generated\Operations\ImageWatermarkImageBmpAnchor;
use Gisl\Generated\Operations\ImageWatermarkImageBmpOptions;
use Gisl\Generated\Operations\ImageWatermarkImageGifAnchor;
use Gisl\Generated\Operations\ImageWatermarkImageGifOptions;
use Gisl\Generated\Operations\ImageWatermarkImageOptions;
use Gisl\Generated\Operations\ImageWatermarkImageOverlaysItem;
use Gisl\Generated\Operations\ImageWatermarkImageOverlaysItemAnchor;
use Gisl\Generated\Operations\ImageWatermarkImageTiffAnchor;
use Gisl\Generated\Operations\ImageWatermarkImageTiffOptions;

final class ImageWatermarkTest extends TestCase
{
    public function testImageWatermarkImageAnchorTopLeftBackingValue(): void
    {
        $enum = ImageWatermarkImageAnchor::from('top_left');
        $this->assertSame(ImageWatermarkImageAnchor::TopLeft, $enum);
        $this->assertSame('top_left', $enum->value);
    }

    public function testImageWatermarkImageAnchorTopCenterBackingValue(): void
    {
        $enum = ImageWatermarkImageAnchor::from('top_center');
        $this->assertSame(ImageWatermarkImageAnchor::TopCenter, $enum);
        $this->assertSame('top_center', $enum->value);
    }

    public function testImageWatermarkImageAnchorTopRightBackingValue(): void
    {
        $enum = ImageWatermarkImageAnchor::from('top_right');
        $this->assertSame(ImageWatermarkImageAnchor::TopRight, $enum);
        $this->assertSame('top_right', $enum->value);
    }

    public function testImageWatermarkImageAnchorCenterLeftBackingValue(): void
    {
        $enum = ImageWatermarkImageAnchor::from('center_left');
        $this->assertSame(ImageWatermarkImageAnchor::CenterLeft, $enum);
        $this->assertSame('center_left', $enum->value);
    }

    public function testImageWatermarkImageAnchorCenterBackingValue(): void
    {
        $enum = ImageWatermarkImageAnchor::from('center');
        $this->assertSame(ImageWatermarkImageAnchor::Center, $enum);
        $this->assertSame('center', $enum->value);
    }

    public function testImageWatermarkImageAnchorCenterRightBackingValue(): void
    {
        $enum = ImageWatermarkImageAnchor::from('center_right');
        $this->assertSame(ImageWatermarkImageAnchor::CenterRight, $enum);
        $this->assertSame('center_right', $enum->value);
    }

    public function testImageWatermarkImageAnchorBottomLeftBackingValue(): void
    {
        $enum = ImageWatermarkImageAnchor::from('bottom_left');
        $this->assertSame(ImageWatermarkImageAnchor::BottomLeft, $enum);
        $this->assertSame('bottom_left', $enum->value);
    }

    public function testImageWatermarkImageAnchorBottomCenterBackingValue(): void
    {
        $enum = ImageWatermarkImageAnchor::from('bottom_center');
        $this->assertSame(ImageWatermarkImageAnchor::BottomCenter, $enum);
        $this->assertSame('bottom_center', $enum->value);
    }

    public function testImageWatermarkImageAnchorBottomRightBackingValue(): void
    {
        $enum = ImageWatermarkImageAnchor::from('bottom_right');
        $this->assertSame(ImageWatermarkImageAnchor::BottomRight, $enum);
        $this->assertSame('bottom_right', $enum->value);
    }

    public function testImageWatermarkImageAnchorCaseCount(): void
    {
        $this->assertCount(9, ImageWatermarkImageAnchor::cases());
    }

    public function testImageWatermarkImageOptionsDefaultConstruction(): void
    {
        $obj = new ImageWatermarkImageOptions();
        $this->assertInstanceOf(ImageWatermarkImageOptions::class, $obj);
        $this->assertSame(ImageWatermarkImageAnchor::BottomRight, $obj->anchor);
        $this->assertSame('0px', $obj->margin_x);
        $this->assertSame('0px', $obj->margin_y);
        $this->assertSame(0.5, $obj->opacity);
        $this->assertNull($obj->overlay_width);
        $this->assertNull($obj->overlays);
    }

    public function testImageWatermarkImageOptionsFullConstruction(): void
    {
        $obj = new ImageWatermarkImageOptions(
            anchor: ImageWatermarkImageAnchor::TopLeft,
            margin_x: 'test_value',
            margin_y: 'test_value',
            opacity: 0.0,
            overlay_width: 'test_value',
            overlays: [new ImageWatermarkImageOverlaysItem(anchor: ImageWatermarkImageOverlaysItemAnchor::TopLeft, margin_x: 'x', margin_y: 'x', opacity: 0.0, overlay_width: 'x')],
        );
        $this->assertInstanceOf(ImageWatermarkImageOptions::class, $obj);
    }

    public function testImageWatermarkImageGifAnchorTopLeftBackingValue(): void
    {
        $enum = ImageWatermarkImageGifAnchor::from('top_left');
        $this->assertSame(ImageWatermarkImageGifAnchor::TopLeft, $enum);
        $this->assertSame('top_left', $enum->value);
    }

    public function testImageWatermarkImageGifAnchorTopCenterBackingValue(): void
    {
        $enum = ImageWatermarkImageGifAnchor::from('top_center');
        $this->assertSame(ImageWatermarkImageGifAnchor::TopCenter, $enum);
        $this->assertSame('top_center', $enum->value);
    }

    public function testImageWatermarkImageGifAnchorTopRightBackingValue(): void
    {
        $enum = ImageWatermarkImageGifAnchor::from('top_right');
        $this->assertSame(ImageWatermarkImageGifAnchor::TopRight, $enum);
        $this->assertSame('top_right', $enum->value);
    }

    public function testImageWatermarkImageGifAnchorCenterLeftBackingValue(): void
    {
        $enum = ImageWatermarkImageGifAnchor::from('center_left');
        $this->assertSame(ImageWatermarkImageGifAnchor::CenterLeft, $enum);
        $this->assertSame('center_left', $enum->value);
    }

    public function testImageWatermarkImageGifAnchorCenterBackingValue(): void
    {
        $enum = ImageWatermarkImageGifAnchor::from('center');
        $this->assertSame(ImageWatermarkImageGifAnchor::Center, $enum);
        $this->assertSame('center', $enum->value);
    }

    public function testImageWatermarkImageGifAnchorCenterRightBackingValue(): void
    {
        $enum = ImageWatermarkImageGifAnchor::from('center_right');
        $this->assertSame(ImageWatermarkImageGifAnchor::CenterRight, $enum);
        $this->assertSame('center_right', $enum->value);
    }

    public function testImageWatermarkImageGifAnchorBottomLeftBackingValue(): void
    {
        $enum = ImageWatermarkImageGifAnchor::from('bottom_left');
        $this->assertSame(ImageWatermarkImageGifAnchor::BottomLeft, $enum);
        $this->assertSame('bottom_left', $enum->value);
    }

    public function testImageWatermarkImageGifAnchorBottomCenterBackingValue(): void
    {
        $enum = ImageWatermarkImageGifAnchor::from('bottom_center');
        $this->assertSame(ImageWatermarkImageGifAnchor::BottomCenter, $enum);
        $this->assertSame('bottom_center', $enum->value);
    }

    public function testImageWatermarkImageGifAnchorBottomRightBackingValue(): void
    {
        $enum = ImageWatermarkImageGifAnchor::from('bottom_right');
        $this->assertSame(ImageWatermarkImageGifAnchor::BottomRight, $enum);
        $this->assertSame('bottom_right', $enum->value);
    }

    public function testImageWatermarkImageGifAnchorCaseCount(): void
    {
        $this->assertCount(9, ImageWatermarkImageGifAnchor::cases());
    }

    public function testImageWatermarkImageGifOptionsDefaultConstruction(): void
    {
        $obj = new ImageWatermarkImageGifOptions();
        $this->assertInstanceOf(ImageWatermarkImageGifOptions::class, $obj);
        $this->assertSame(ImageWatermarkImageGifAnchor::BottomRight, $obj->anchor);
        $this->assertSame('0px', $obj->margin_x);
        $this->assertSame('0px', $obj->margin_y);
        $this->assertSame(0.5, $obj->opacity);
        $this->assertNull($obj->overlay_width);
    }

    public function testImageWatermarkImageGifOptionsFullConstruction(): void
    {
        $obj = new ImageWatermarkImageGifOptions(
            anchor: ImageWatermarkImageGifAnchor::TopLeft,
            margin_x: 'test_value',
            margin_y: 'test_value',
            opacity: 0.0,
            overlay_width: 'test_value',
        );
        $this->assertInstanceOf(ImageWatermarkImageGifOptions::class, $obj);
    }

    public function testImageWatermarkImageTiffAnchorTopLeftBackingValue(): void
    {
        $enum = ImageWatermarkImageTiffAnchor::from('top_left');
        $this->assertSame(ImageWatermarkImageTiffAnchor::TopLeft, $enum);
        $this->assertSame('top_left', $enum->value);
    }

    public function testImageWatermarkImageTiffAnchorTopCenterBackingValue(): void
    {
        $enum = ImageWatermarkImageTiffAnchor::from('top_center');
        $this->assertSame(ImageWatermarkImageTiffAnchor::TopCenter, $enum);
        $this->assertSame('top_center', $enum->value);
    }

    public function testImageWatermarkImageTiffAnchorTopRightBackingValue(): void
    {
        $enum = ImageWatermarkImageTiffAnchor::from('top_right');
        $this->assertSame(ImageWatermarkImageTiffAnchor::TopRight, $enum);
        $this->assertSame('top_right', $enum->value);
    }

    public function testImageWatermarkImageTiffAnchorCenterLeftBackingValue(): void
    {
        $enum = ImageWatermarkImageTiffAnchor::from('center_left');
        $this->assertSame(ImageWatermarkImageTiffAnchor::CenterLeft, $enum);
        $this->assertSame('center_left', $enum->value);
    }

    public function testImageWatermarkImageTiffAnchorCenterBackingValue(): void
    {
        $enum = ImageWatermarkImageTiffAnchor::from('center');
        $this->assertSame(ImageWatermarkImageTiffAnchor::Center, $enum);
        $this->assertSame('center', $enum->value);
    }

    public function testImageWatermarkImageTiffAnchorCenterRightBackingValue(): void
    {
        $enum = ImageWatermarkImageTiffAnchor::from('center_right');
        $this->assertSame(ImageWatermarkImageTiffAnchor::CenterRight, $enum);
        $this->assertSame('center_right', $enum->value);
    }

    public function testImageWatermarkImageTiffAnchorBottomLeftBackingValue(): void
    {
        $enum = ImageWatermarkImageTiffAnchor::from('bottom_left');
        $this->assertSame(ImageWatermarkImageTiffAnchor::BottomLeft, $enum);
        $this->assertSame('bottom_left', $enum->value);
    }

    public function testImageWatermarkImageTiffAnchorBottomCenterBackingValue(): void
    {
        $enum = ImageWatermarkImageTiffAnchor::from('bottom_center');
        $this->assertSame(ImageWatermarkImageTiffAnchor::BottomCenter, $enum);
        $this->assertSame('bottom_center', $enum->value);
    }

    public function testImageWatermarkImageTiffAnchorBottomRightBackingValue(): void
    {
        $enum = ImageWatermarkImageTiffAnchor::from('bottom_right');
        $this->assertSame(ImageWatermarkImageTiffAnchor::BottomRight, $enum);
        $this->assertSame('bottom_right', $enum->value);
    }

    public function testImageWatermarkImageTiffAnchorCaseCount(): void
    {
        $this->assertCount(9, ImageWatermarkImageTiffAnchor::cases());
    }

    public function testImageWatermarkImageTiffOptionsDefaultConstruction(): void
    {
        $obj = new ImageWatermarkImageTiffOptions();
        $this->assertInstanceOf(ImageWatermarkImageTiffOptions::class, $obj);
        $this->assertSame(ImageWatermarkImageTiffAnchor::BottomRight, $obj->anchor);
        $this->assertSame('0px', $obj->margin_x);
        $this->assertSame('0px', $obj->margin_y);
        $this->assertSame(0.5, $obj->opacity);
        $this->assertNull($obj->overlay_width);
    }

    public function testImageWatermarkImageTiffOptionsFullConstruction(): void
    {
        $obj = new ImageWatermarkImageTiffOptions(
            anchor: ImageWatermarkImageTiffAnchor::TopLeft,
            margin_x: 'test_value',
            margin_y: 'test_value',
            opacity: 0.0,
            overlay_width: 'test_value',
        );
        $this->assertInstanceOf(ImageWatermarkImageTiffOptions::class, $obj);
    }

    public function testImageWatermarkImageBmpAnchorTopLeftBackingValue(): void
    {
        $enum = ImageWatermarkImageBmpAnchor::from('top_left');
        $this->assertSame(ImageWatermarkImageBmpAnchor::TopLeft, $enum);
        $this->assertSame('top_left', $enum->value);
    }

    public function testImageWatermarkImageBmpAnchorTopCenterBackingValue(): void
    {
        $enum = ImageWatermarkImageBmpAnchor::from('top_center');
        $this->assertSame(ImageWatermarkImageBmpAnchor::TopCenter, $enum);
        $this->assertSame('top_center', $enum->value);
    }

    public function testImageWatermarkImageBmpAnchorTopRightBackingValue(): void
    {
        $enum = ImageWatermarkImageBmpAnchor::from('top_right');
        $this->assertSame(ImageWatermarkImageBmpAnchor::TopRight, $enum);
        $this->assertSame('top_right', $enum->value);
    }

    public function testImageWatermarkImageBmpAnchorCenterLeftBackingValue(): void
    {
        $enum = ImageWatermarkImageBmpAnchor::from('center_left');
        $this->assertSame(ImageWatermarkImageBmpAnchor::CenterLeft, $enum);
        $this->assertSame('center_left', $enum->value);
    }

    public function testImageWatermarkImageBmpAnchorCenterBackingValue(): void
    {
        $enum = ImageWatermarkImageBmpAnchor::from('center');
        $this->assertSame(ImageWatermarkImageBmpAnchor::Center, $enum);
        $this->assertSame('center', $enum->value);
    }

    public function testImageWatermarkImageBmpAnchorCenterRightBackingValue(): void
    {
        $enum = ImageWatermarkImageBmpAnchor::from('center_right');
        $this->assertSame(ImageWatermarkImageBmpAnchor::CenterRight, $enum);
        $this->assertSame('center_right', $enum->value);
    }

    public function testImageWatermarkImageBmpAnchorBottomLeftBackingValue(): void
    {
        $enum = ImageWatermarkImageBmpAnchor::from('bottom_left');
        $this->assertSame(ImageWatermarkImageBmpAnchor::BottomLeft, $enum);
        $this->assertSame('bottom_left', $enum->value);
    }

    public function testImageWatermarkImageBmpAnchorBottomCenterBackingValue(): void
    {
        $enum = ImageWatermarkImageBmpAnchor::from('bottom_center');
        $this->assertSame(ImageWatermarkImageBmpAnchor::BottomCenter, $enum);
        $this->assertSame('bottom_center', $enum->value);
    }

    public function testImageWatermarkImageBmpAnchorBottomRightBackingValue(): void
    {
        $enum = ImageWatermarkImageBmpAnchor::from('bottom_right');
        $this->assertSame(ImageWatermarkImageBmpAnchor::BottomRight, $enum);
        $this->assertSame('bottom_right', $enum->value);
    }

    public function testImageWatermarkImageBmpAnchorCaseCount(): void
    {
        $this->assertCount(9, ImageWatermarkImageBmpAnchor::cases());
    }

    public function testImageWatermarkImageBmpOptionsDefaultConstruction(): void
    {
        $obj = new ImageWatermarkImageBmpOptions();
        $this->assertInstanceOf(ImageWatermarkImageBmpOptions::class, $obj);
        $this->assertSame(ImageWatermarkImageBmpAnchor::BottomRight, $obj->anchor);
        $this->assertSame('0px', $obj->margin_x);
        $this->assertSame('0px', $obj->margin_y);
        $this->assertSame(0.5, $obj->opacity);
        $this->assertNull($obj->overlay_width);
    }

    public function testImageWatermarkImageBmpOptionsFullConstruction(): void
    {
        $obj = new ImageWatermarkImageBmpOptions(
            anchor: ImageWatermarkImageBmpAnchor::TopLeft,
            margin_x: 'test_value',
            margin_y: 'test_value',
            opacity: 0.0,
            overlay_width: 'test_value',
        );
        $this->assertInstanceOf(ImageWatermarkImageBmpOptions::class, $obj);
    }

}
