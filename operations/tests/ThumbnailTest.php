<?php

// Auto-generated -- do not edit

declare(strict_types=1);

namespace Gisl\Generated\Operations\Tests;

use PHPUnit\Framework\TestCase;
use Gisl\Generated\Operations\ThumbnailDocumentEpubFit;
use Gisl\Generated\Operations\ThumbnailDocumentEpubFormat;
use Gisl\Generated\Operations\ThumbnailDocumentEpubOptions;
use Gisl\Generated\Operations\ThumbnailDocumentEpubSource;
use Gisl\Generated\Operations\ThumbnailDocumentOfficeFit;
use Gisl\Generated\Operations\ThumbnailDocumentOfficeFormat;
use Gisl\Generated\Operations\ThumbnailDocumentOfficeOptions;
use Gisl\Generated\Operations\ThumbnailDocumentOfficeSource;
use Gisl\Generated\Operations\ThumbnailDocumentPdfFit;
use Gisl\Generated\Operations\ThumbnailDocumentPdfFormat;
use Gisl\Generated\Operations\ThumbnailDocumentPdfOptions;
use Gisl\Generated\Operations\ThumbnailDocumentPdfSource;
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

    public function testThumbnailDocumentPdfSourcePageBackingValue(): void
    {
        $enum = ThumbnailDocumentPdfSource::from('page');
        $this->assertSame(ThumbnailDocumentPdfSource::Page, $enum);
        $this->assertSame('page', $enum->value);
    }

    public function testThumbnailDocumentPdfSourceCoverBackingValue(): void
    {
        $enum = ThumbnailDocumentPdfSource::from('cover');
        $this->assertSame(ThumbnailDocumentPdfSource::Cover, $enum);
        $this->assertSame('cover', $enum->value);
    }

    public function testThumbnailDocumentPdfSourceCaseCount(): void
    {
        $this->assertCount(2, ThumbnailDocumentPdfSource::cases());
    }

    public function testThumbnailDocumentPdfFitMaxBackingValue(): void
    {
        $enum = ThumbnailDocumentPdfFit::from('max');
        $this->assertSame(ThumbnailDocumentPdfFit::Max, $enum);
        $this->assertSame('max', $enum->value);
    }

    public function testThumbnailDocumentPdfFitCropBackingValue(): void
    {
        $enum = ThumbnailDocumentPdfFit::from('crop');
        $this->assertSame(ThumbnailDocumentPdfFit::Crop, $enum);
        $this->assertSame('crop', $enum->value);
    }

    public function testThumbnailDocumentPdfFitScaleBackingValue(): void
    {
        $enum = ThumbnailDocumentPdfFit::from('scale');
        $this->assertSame(ThumbnailDocumentPdfFit::Scale, $enum);
        $this->assertSame('scale', $enum->value);
    }

    public function testThumbnailDocumentPdfFitCaseCount(): void
    {
        $this->assertCount(3, ThumbnailDocumentPdfFit::cases());
    }

    public function testThumbnailDocumentPdfFormatJpgBackingValue(): void
    {
        $enum = ThumbnailDocumentPdfFormat::from('jpg');
        $this->assertSame(ThumbnailDocumentPdfFormat::Jpg, $enum);
        $this->assertSame('jpg', $enum->value);
    }

    public function testThumbnailDocumentPdfFormatPngBackingValue(): void
    {
        $enum = ThumbnailDocumentPdfFormat::from('png');
        $this->assertSame(ThumbnailDocumentPdfFormat::Png, $enum);
        $this->assertSame('png', $enum->value);
    }

    public function testThumbnailDocumentPdfFormatWebpBackingValue(): void
    {
        $enum = ThumbnailDocumentPdfFormat::from('webp');
        $this->assertSame(ThumbnailDocumentPdfFormat::Webp, $enum);
        $this->assertSame('webp', $enum->value);
    }

    public function testThumbnailDocumentPdfFormatCaseCount(): void
    {
        $this->assertCount(3, ThumbnailDocumentPdfFormat::cases());
    }

    public function testThumbnailDocumentPdfOptionsDefaultConstruction(): void
    {
        $obj = new ThumbnailDocumentPdfOptions();
        $this->assertInstanceOf(ThumbnailDocumentPdfOptions::class, $obj);
        $this->assertSame(ThumbnailDocumentPdfSource::Page, $obj->source);
        $this->assertSame(ThumbnailDocumentPdfFit::Crop, $obj->fit);
        $this->assertSame(ThumbnailDocumentPdfFormat::Jpg, $obj->format);
        $this->assertNull($obj->page);
        $this->assertNull($obj->width);
        $this->assertNull($obj->height);
        $this->assertNull($obj->quality);
    }

    public function testThumbnailDocumentPdfOptionsFullConstruction(): void
    {
        $obj = new ThumbnailDocumentPdfOptions(
            source: ThumbnailDocumentPdfSource::Page,
            page: 1,
            width: 1,
            height: 1,
            fit: ThumbnailDocumentPdfFit::Max,
            format: ThumbnailDocumentPdfFormat::Jpg,
            quality: 1,
        );
        $this->assertInstanceOf(ThumbnailDocumentPdfOptions::class, $obj);
    }

    public function testThumbnailDocumentOfficeSourcePageBackingValue(): void
    {
        $enum = ThumbnailDocumentOfficeSource::from('page');
        $this->assertSame(ThumbnailDocumentOfficeSource::Page, $enum);
        $this->assertSame('page', $enum->value);
    }

    public function testThumbnailDocumentOfficeSourceCoverBackingValue(): void
    {
        $enum = ThumbnailDocumentOfficeSource::from('cover');
        $this->assertSame(ThumbnailDocumentOfficeSource::Cover, $enum);
        $this->assertSame('cover', $enum->value);
    }

    public function testThumbnailDocumentOfficeSourceCaseCount(): void
    {
        $this->assertCount(2, ThumbnailDocumentOfficeSource::cases());
    }

    public function testThumbnailDocumentOfficeFitMaxBackingValue(): void
    {
        $enum = ThumbnailDocumentOfficeFit::from('max');
        $this->assertSame(ThumbnailDocumentOfficeFit::Max, $enum);
        $this->assertSame('max', $enum->value);
    }

    public function testThumbnailDocumentOfficeFitCropBackingValue(): void
    {
        $enum = ThumbnailDocumentOfficeFit::from('crop');
        $this->assertSame(ThumbnailDocumentOfficeFit::Crop, $enum);
        $this->assertSame('crop', $enum->value);
    }

    public function testThumbnailDocumentOfficeFitScaleBackingValue(): void
    {
        $enum = ThumbnailDocumentOfficeFit::from('scale');
        $this->assertSame(ThumbnailDocumentOfficeFit::Scale, $enum);
        $this->assertSame('scale', $enum->value);
    }

    public function testThumbnailDocumentOfficeFitCaseCount(): void
    {
        $this->assertCount(3, ThumbnailDocumentOfficeFit::cases());
    }

    public function testThumbnailDocumentOfficeFormatJpgBackingValue(): void
    {
        $enum = ThumbnailDocumentOfficeFormat::from('jpg');
        $this->assertSame(ThumbnailDocumentOfficeFormat::Jpg, $enum);
        $this->assertSame('jpg', $enum->value);
    }

    public function testThumbnailDocumentOfficeFormatPngBackingValue(): void
    {
        $enum = ThumbnailDocumentOfficeFormat::from('png');
        $this->assertSame(ThumbnailDocumentOfficeFormat::Png, $enum);
        $this->assertSame('png', $enum->value);
    }

    public function testThumbnailDocumentOfficeFormatWebpBackingValue(): void
    {
        $enum = ThumbnailDocumentOfficeFormat::from('webp');
        $this->assertSame(ThumbnailDocumentOfficeFormat::Webp, $enum);
        $this->assertSame('webp', $enum->value);
    }

    public function testThumbnailDocumentOfficeFormatCaseCount(): void
    {
        $this->assertCount(3, ThumbnailDocumentOfficeFormat::cases());
    }

    public function testThumbnailDocumentOfficeOptionsDefaultConstruction(): void
    {
        $obj = new ThumbnailDocumentOfficeOptions();
        $this->assertInstanceOf(ThumbnailDocumentOfficeOptions::class, $obj);
        $this->assertSame(ThumbnailDocumentOfficeSource::Page, $obj->source);
        $this->assertSame(ThumbnailDocumentOfficeFit::Crop, $obj->fit);
        $this->assertSame(ThumbnailDocumentOfficeFormat::Jpg, $obj->format);
        $this->assertNull($obj->page);
        $this->assertNull($obj->width);
        $this->assertNull($obj->height);
        $this->assertNull($obj->quality);
    }

    public function testThumbnailDocumentOfficeOptionsFullConstruction(): void
    {
        $obj = new ThumbnailDocumentOfficeOptions(
            source: ThumbnailDocumentOfficeSource::Page,
            page: 1,
            width: 1,
            height: 1,
            fit: ThumbnailDocumentOfficeFit::Max,
            format: ThumbnailDocumentOfficeFormat::Jpg,
            quality: 1,
        );
        $this->assertInstanceOf(ThumbnailDocumentOfficeOptions::class, $obj);
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
