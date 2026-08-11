<?php

// Auto-generated -- do not edit

declare(strict_types=1);

namespace Gisl\Generated\Operations\Tests;

use PHPUnit\Framework\TestCase;
use Gisl\Generated\Operations\ThumbnailDocumentEpubFit;
use Gisl\Generated\Operations\ThumbnailDocumentEpubFormat;
use Gisl\Generated\Operations\ThumbnailDocumentEpubOptions;
use Gisl\Generated\Operations\ThumbnailDocumentEpubSource;
use Gisl\Generated\Operations\ThumbnailDocumentFit;
use Gisl\Generated\Operations\ThumbnailDocumentFormat;
use Gisl\Generated\Operations\ThumbnailDocumentOptions;
use Gisl\Generated\Operations\ThumbnailDocumentSource;
use Gisl\Generated\Operations\ThumbnailImageFit;
use Gisl\Generated\Operations\ThumbnailImageFormat;
use Gisl\Generated\Operations\ThumbnailImageOptions;
use Gisl\Generated\Operations\ThumbnailVideoFit;
use Gisl\Generated\Operations\ThumbnailVideoFormat;
use Gisl\Generated\Operations\ThumbnailVideoOptions;

final class ThumbnailTest extends TestCase
{
    public function testThumbnailImageFitMaxBackingValue(): void
    {
        $enum = ThumbnailImageFit::from('max');
        $this->assertSame(ThumbnailImageFit::Max, $enum);
        $this->assertSame('max', $enum->value);
    }

    public function testThumbnailImageFitCropBackingValue(): void
    {
        $enum = ThumbnailImageFit::from('crop');
        $this->assertSame(ThumbnailImageFit::Crop, $enum);
        $this->assertSame('crop', $enum->value);
    }

    public function testThumbnailImageFitScaleBackingValue(): void
    {
        $enum = ThumbnailImageFit::from('scale');
        $this->assertSame(ThumbnailImageFit::Scale, $enum);
        $this->assertSame('scale', $enum->value);
    }

    public function testThumbnailImageFitCaseCount(): void
    {
        $this->assertCount(3, ThumbnailImageFit::cases());
    }

    public function testThumbnailImageFormatJpgBackingValue(): void
    {
        $enum = ThumbnailImageFormat::from('jpg');
        $this->assertSame(ThumbnailImageFormat::Jpg, $enum);
        $this->assertSame('jpg', $enum->value);
    }

    public function testThumbnailImageFormatPngBackingValue(): void
    {
        $enum = ThumbnailImageFormat::from('png');
        $this->assertSame(ThumbnailImageFormat::Png, $enum);
        $this->assertSame('png', $enum->value);
    }

    public function testThumbnailImageFormatWebpBackingValue(): void
    {
        $enum = ThumbnailImageFormat::from('webp');
        $this->assertSame(ThumbnailImageFormat::Webp, $enum);
        $this->assertSame('webp', $enum->value);
    }

    public function testThumbnailImageFormatCaseCount(): void
    {
        $this->assertCount(3, ThumbnailImageFormat::cases());
    }

    public function testThumbnailImageOptionsDefaultConstruction(): void
    {
        $obj = new ThumbnailImageOptions();
        $this->assertInstanceOf(ThumbnailImageOptions::class, $obj);
        $this->assertSame(ThumbnailImageFit::Crop, $obj->fit);
        $this->assertSame(ThumbnailImageFormat::Jpg, $obj->format);
        $this->assertNull($obj->width);
        $this->assertNull($obj->height);
        $this->assertNull($obj->quality);
        $this->assertNull($obj->background);
    }

    public function testThumbnailImageOptionsFullConstruction(): void
    {
        $obj = new ThumbnailImageOptions(
            width: 1,
            height: 1,
            fit: ThumbnailImageFit::Max,
            format: ThumbnailImageFormat::Jpg,
            quality: 1,
            background: 'test_value',
        );
        $this->assertInstanceOf(ThumbnailImageOptions::class, $obj);
    }

    public function testThumbnailVideoFitMaxBackingValue(): void
    {
        $enum = ThumbnailVideoFit::from('max');
        $this->assertSame(ThumbnailVideoFit::Max, $enum);
        $this->assertSame('max', $enum->value);
    }

    public function testThumbnailVideoFitCropBackingValue(): void
    {
        $enum = ThumbnailVideoFit::from('crop');
        $this->assertSame(ThumbnailVideoFit::Crop, $enum);
        $this->assertSame('crop', $enum->value);
    }

    public function testThumbnailVideoFitScaleBackingValue(): void
    {
        $enum = ThumbnailVideoFit::from('scale');
        $this->assertSame(ThumbnailVideoFit::Scale, $enum);
        $this->assertSame('scale', $enum->value);
    }

    public function testThumbnailVideoFitCaseCount(): void
    {
        $this->assertCount(3, ThumbnailVideoFit::cases());
    }

    public function testThumbnailVideoFormatJpgBackingValue(): void
    {
        $enum = ThumbnailVideoFormat::from('jpg');
        $this->assertSame(ThumbnailVideoFormat::Jpg, $enum);
        $this->assertSame('jpg', $enum->value);
    }

    public function testThumbnailVideoFormatPngBackingValue(): void
    {
        $enum = ThumbnailVideoFormat::from('png');
        $this->assertSame(ThumbnailVideoFormat::Png, $enum);
        $this->assertSame('png', $enum->value);
    }

    public function testThumbnailVideoFormatWebpBackingValue(): void
    {
        $enum = ThumbnailVideoFormat::from('webp');
        $this->assertSame(ThumbnailVideoFormat::Webp, $enum);
        $this->assertSame('webp', $enum->value);
    }

    public function testThumbnailVideoFormatCaseCount(): void
    {
        $this->assertCount(3, ThumbnailVideoFormat::cases());
    }

    public function testThumbnailVideoOptionsDefaultConstruction(): void
    {
        $obj = new ThumbnailVideoOptions();
        $this->assertInstanceOf(ThumbnailVideoOptions::class, $obj);
        $this->assertSame('00:00:01', $obj->timestamp);
        $this->assertSame(ThumbnailVideoFit::Crop, $obj->fit);
        $this->assertSame(ThumbnailVideoFormat::Jpg, $obj->format);
        $this->assertNull($obj->width);
        $this->assertNull($obj->height);
        $this->assertNull($obj->quality);
    }

    public function testThumbnailVideoOptionsFullConstruction(): void
    {
        $obj = new ThumbnailVideoOptions(
            timestamp: 'test_value',
            width: 1,
            height: 1,
            fit: ThumbnailVideoFit::Max,
            format: ThumbnailVideoFormat::Jpg,
            quality: 1,
        );
        $this->assertInstanceOf(ThumbnailVideoOptions::class, $obj);
    }

    public function testThumbnailDocumentSourcePageBackingValue(): void
    {
        $enum = ThumbnailDocumentSource::from('page');
        $this->assertSame(ThumbnailDocumentSource::Page, $enum);
        $this->assertSame('page', $enum->value);
    }

    public function testThumbnailDocumentSourceCoverBackingValue(): void
    {
        $enum = ThumbnailDocumentSource::from('cover');
        $this->assertSame(ThumbnailDocumentSource::Cover, $enum);
        $this->assertSame('cover', $enum->value);
    }

    public function testThumbnailDocumentSourceCaseCount(): void
    {
        $this->assertCount(2, ThumbnailDocumentSource::cases());
    }

    public function testThumbnailDocumentFitMaxBackingValue(): void
    {
        $enum = ThumbnailDocumentFit::from('max');
        $this->assertSame(ThumbnailDocumentFit::Max, $enum);
        $this->assertSame('max', $enum->value);
    }

    public function testThumbnailDocumentFitCropBackingValue(): void
    {
        $enum = ThumbnailDocumentFit::from('crop');
        $this->assertSame(ThumbnailDocumentFit::Crop, $enum);
        $this->assertSame('crop', $enum->value);
    }

    public function testThumbnailDocumentFitScaleBackingValue(): void
    {
        $enum = ThumbnailDocumentFit::from('scale');
        $this->assertSame(ThumbnailDocumentFit::Scale, $enum);
        $this->assertSame('scale', $enum->value);
    }

    public function testThumbnailDocumentFitCaseCount(): void
    {
        $this->assertCount(3, ThumbnailDocumentFit::cases());
    }

    public function testThumbnailDocumentFormatJpgBackingValue(): void
    {
        $enum = ThumbnailDocumentFormat::from('jpg');
        $this->assertSame(ThumbnailDocumentFormat::Jpg, $enum);
        $this->assertSame('jpg', $enum->value);
    }

    public function testThumbnailDocumentFormatPngBackingValue(): void
    {
        $enum = ThumbnailDocumentFormat::from('png');
        $this->assertSame(ThumbnailDocumentFormat::Png, $enum);
        $this->assertSame('png', $enum->value);
    }

    public function testThumbnailDocumentFormatWebpBackingValue(): void
    {
        $enum = ThumbnailDocumentFormat::from('webp');
        $this->assertSame(ThumbnailDocumentFormat::Webp, $enum);
        $this->assertSame('webp', $enum->value);
    }

    public function testThumbnailDocumentFormatCaseCount(): void
    {
        $this->assertCount(3, ThumbnailDocumentFormat::cases());
    }

    public function testThumbnailDocumentOptionsDefaultConstruction(): void
    {
        $obj = new ThumbnailDocumentOptions();
        $this->assertInstanceOf(ThumbnailDocumentOptions::class, $obj);
        $this->assertSame(ThumbnailDocumentSource::Page, $obj->source);
        $this->assertSame(ThumbnailDocumentFit::Crop, $obj->fit);
        $this->assertSame(ThumbnailDocumentFormat::Jpg, $obj->format);
        $this->assertNull($obj->page);
        $this->assertNull($obj->width);
        $this->assertNull($obj->height);
        $this->assertNull($obj->quality);
    }

    public function testThumbnailDocumentOptionsFullConstruction(): void
    {
        $obj = new ThumbnailDocumentOptions(
            source: ThumbnailDocumentSource::Page,
            page: 1,
            width: 1,
            height: 1,
            fit: ThumbnailDocumentFit::Max,
            format: ThumbnailDocumentFormat::Jpg,
            quality: 1,
        );
        $this->assertInstanceOf(ThumbnailDocumentOptions::class, $obj);
    }

    public function testThumbnailDocumentEpubSourceCoverBackingValue(): void
    {
        $enum = ThumbnailDocumentEpubSource::from('cover');
        $this->assertSame(ThumbnailDocumentEpubSource::Cover, $enum);
        $this->assertSame('cover', $enum->value);
    }

    public function testThumbnailDocumentEpubSourceCaseCount(): void
    {
        $this->assertCount(1, ThumbnailDocumentEpubSource::cases());
    }

    public function testThumbnailDocumentEpubFitMaxBackingValue(): void
    {
        $enum = ThumbnailDocumentEpubFit::from('max');
        $this->assertSame(ThumbnailDocumentEpubFit::Max, $enum);
        $this->assertSame('max', $enum->value);
    }

    public function testThumbnailDocumentEpubFitCropBackingValue(): void
    {
        $enum = ThumbnailDocumentEpubFit::from('crop');
        $this->assertSame(ThumbnailDocumentEpubFit::Crop, $enum);
        $this->assertSame('crop', $enum->value);
    }

    public function testThumbnailDocumentEpubFitScaleBackingValue(): void
    {
        $enum = ThumbnailDocumentEpubFit::from('scale');
        $this->assertSame(ThumbnailDocumentEpubFit::Scale, $enum);
        $this->assertSame('scale', $enum->value);
    }

    public function testThumbnailDocumentEpubFitCaseCount(): void
    {
        $this->assertCount(3, ThumbnailDocumentEpubFit::cases());
    }

    public function testThumbnailDocumentEpubFormatJpgBackingValue(): void
    {
        $enum = ThumbnailDocumentEpubFormat::from('jpg');
        $this->assertSame(ThumbnailDocumentEpubFormat::Jpg, $enum);
        $this->assertSame('jpg', $enum->value);
    }

    public function testThumbnailDocumentEpubFormatPngBackingValue(): void
    {
        $enum = ThumbnailDocumentEpubFormat::from('png');
        $this->assertSame(ThumbnailDocumentEpubFormat::Png, $enum);
        $this->assertSame('png', $enum->value);
    }

    public function testThumbnailDocumentEpubFormatWebpBackingValue(): void
    {
        $enum = ThumbnailDocumentEpubFormat::from('webp');
        $this->assertSame(ThumbnailDocumentEpubFormat::Webp, $enum);
        $this->assertSame('webp', $enum->value);
    }

    public function testThumbnailDocumentEpubFormatCaseCount(): void
    {
        $this->assertCount(3, ThumbnailDocumentEpubFormat::cases());
    }

    public function testThumbnailDocumentEpubOptionsDefaultConstruction(): void
    {
        $obj = new ThumbnailDocumentEpubOptions();
        $this->assertInstanceOf(ThumbnailDocumentEpubOptions::class, $obj);
        $this->assertSame(ThumbnailDocumentEpubSource::Cover, $obj->source);
        $this->assertSame(ThumbnailDocumentEpubFit::Crop, $obj->fit);
        $this->assertSame(ThumbnailDocumentEpubFormat::Jpg, $obj->format);
        $this->assertNull($obj->width);
        $this->assertNull($obj->height);
        $this->assertNull($obj->quality);
    }

    public function testThumbnailDocumentEpubOptionsFullConstruction(): void
    {
        $obj = new ThumbnailDocumentEpubOptions(
            source: ThumbnailDocumentEpubSource::Cover,
            width: 1,
            height: 1,
            fit: ThumbnailDocumentEpubFit::Max,
            format: ThumbnailDocumentEpubFormat::Jpg,
            quality: 1,
        );
        $this->assertInstanceOf(ThumbnailDocumentEpubOptions::class, $obj);
    }

}
