<?php

// Auto-generated -- do not edit

declare(strict_types=1);

namespace Gisl\Generated\Operations\Tests;

use PHPUnit\Framework\TestCase;
use Gisl\Generated\Operations\ConvertAudioBitrate;
use Gisl\Generated\Operations\ConvertAudioOptions;
use Gisl\Generated\Operations\ConvertAudioOutputFormat;
use Gisl\Generated\Operations\ConvertDocumentPdfOptions;
use Gisl\Generated\Operations\ConvertDocumentPdfOutputFormat;
use Gisl\Generated\Operations\ConvertImageColorProfile;
use Gisl\Generated\Operations\ConvertImageFit;
use Gisl\Generated\Operations\ConvertImageGifColorProfile;
use Gisl\Generated\Operations\ConvertImageGifFit;
use Gisl\Generated\Operations\ConvertImageGifOptions;
use Gisl\Generated\Operations\ConvertImageGifOutputFormat;
use Gisl\Generated\Operations\ConvertImageMetadata;
use Gisl\Generated\Operations\ConvertImageOptions;
use Gisl\Generated\Operations\ConvertImageOutputFormat;
use Gisl\Generated\Operations\ConvertImageSvgOptions;
use Gisl\Generated\Operations\ConvertImageSvgOutputFormat;
use Gisl\Generated\Operations\ConvertVideoDither;
use Gisl\Generated\Operations\ConvertVideoOptions;
use Gisl\Generated\Operations\ConvertVideoOutputFormat;

final class ConvertTest extends TestCase
{
    public function testConvertImageOutputFormatJpegBackingValue(): void
    {
        $enum = ConvertImageOutputFormat::from('jpeg');
        $this->assertSame(ConvertImageOutputFormat::Jpeg, $enum);
        $this->assertSame('jpeg', $enum->value);
    }

    public function testConvertImageOutputFormatPngBackingValue(): void
    {
        $enum = ConvertImageOutputFormat::from('png');
        $this->assertSame(ConvertImageOutputFormat::Png, $enum);
        $this->assertSame('png', $enum->value);
    }

    public function testConvertImageOutputFormatWebpBackingValue(): void
    {
        $enum = ConvertImageOutputFormat::from('webp');
        $this->assertSame(ConvertImageOutputFormat::Webp, $enum);
        $this->assertSame('webp', $enum->value);
    }

    public function testConvertImageOutputFormatAvifBackingValue(): void
    {
        $enum = ConvertImageOutputFormat::from('avif');
        $this->assertSame(ConvertImageOutputFormat::Avif, $enum);
        $this->assertSame('avif', $enum->value);
    }

    public function testConvertImageOutputFormatGifBackingValue(): void
    {
        $enum = ConvertImageOutputFormat::from('gif');
        $this->assertSame(ConvertImageOutputFormat::Gif, $enum);
        $this->assertSame('gif', $enum->value);
    }

    public function testConvertImageOutputFormatTiffBackingValue(): void
    {
        $enum = ConvertImageOutputFormat::from('tiff');
        $this->assertSame(ConvertImageOutputFormat::Tiff, $enum);
        $this->assertSame('tiff', $enum->value);
    }

    public function testConvertImageOutputFormatCaseCount(): void
    {
        $this->assertCount(6, ConvertImageOutputFormat::cases());
    }

    public function testConvertImageMetadataStripBackingValue(): void
    {
        $enum = ConvertImageMetadata::from('strip');
        $this->assertSame(ConvertImageMetadata::Strip, $enum);
        $this->assertSame('strip', $enum->value);
    }

    public function testConvertImageMetadataKeepBackingValue(): void
    {
        $enum = ConvertImageMetadata::from('keep');
        $this->assertSame(ConvertImageMetadata::Keep, $enum);
        $this->assertSame('keep', $enum->value);
    }

    public function testConvertImageMetadataCaseCount(): void
    {
        $this->assertCount(2, ConvertImageMetadata::cases());
    }

    public function testConvertImageFitMaxBackingValue(): void
    {
        $enum = ConvertImageFit::from('max');
        $this->assertSame(ConvertImageFit::Max, $enum);
        $this->assertSame('max', $enum->value);
    }

    public function testConvertImageFitCropBackingValue(): void
    {
        $enum = ConvertImageFit::from('crop');
        $this->assertSame(ConvertImageFit::Crop, $enum);
        $this->assertSame('crop', $enum->value);
    }

    public function testConvertImageFitScaleBackingValue(): void
    {
        $enum = ConvertImageFit::from('scale');
        $this->assertSame(ConvertImageFit::Scale, $enum);
        $this->assertSame('scale', $enum->value);
    }

    public function testConvertImageFitCaseCount(): void
    {
        $this->assertCount(3, ConvertImageFit::cases());
    }

    public function testConvertImageColorProfileKeepBackingValue(): void
    {
        $enum = ConvertImageColorProfile::from('keep');
        $this->assertSame(ConvertImageColorProfile::Keep, $enum);
        $this->assertSame('keep', $enum->value);
    }

    public function testConvertImageColorProfileSrgbBackingValue(): void
    {
        $enum = ConvertImageColorProfile::from('srgb');
        $this->assertSame(ConvertImageColorProfile::Srgb, $enum);
        $this->assertSame('srgb', $enum->value);
    }

    public function testConvertImageColorProfileStripBackingValue(): void
    {
        $enum = ConvertImageColorProfile::from('strip');
        $this->assertSame(ConvertImageColorProfile::Strip, $enum);
        $this->assertSame('strip', $enum->value);
    }

    public function testConvertImageColorProfileCaseCount(): void
    {
        $this->assertCount(3, ConvertImageColorProfile::cases());
    }

    public function testConvertImageOptionsDefaultConstruction(): void
    {
        $obj = new ConvertImageOptions(
            output_format: ConvertImageOutputFormat::Jpeg,
        );
        $this->assertInstanceOf(ConvertImageOptions::class, $obj);
        $this->assertSame(ConvertImageColorProfile::Keep, $obj->color_profile);
        $this->assertSame(true, $obj->auto_orient);
        $this->assertNull($obj->quality);
        $this->assertNull($obj->background);
        $this->assertNull($obj->metadata);
        $this->assertNull($obj->width);
        $this->assertNull($obj->height);
        $this->assertNull($obj->fit);
    }

    public function testConvertImageOptionsFullConstruction(): void
    {
        $obj = new ConvertImageOptions(
            output_format: ConvertImageOutputFormat::Jpeg,
            quality: 1,
            background: 'test_value',
            metadata: ConvertImageMetadata::Strip,
            width: 1,
            height: 1,
            fit: ConvertImageFit::Max,
            color_profile: ConvertImageColorProfile::Keep,
            auto_orient: true,
        );
        $this->assertInstanceOf(ConvertImageOptions::class, $obj);
    }

    public function testConvertImageSvgOutputFormatJpegBackingValue(): void
    {
        $enum = ConvertImageSvgOutputFormat::from('jpeg');
        $this->assertSame(ConvertImageSvgOutputFormat::Jpeg, $enum);
        $this->assertSame('jpeg', $enum->value);
    }

    public function testConvertImageSvgOutputFormatPngBackingValue(): void
    {
        $enum = ConvertImageSvgOutputFormat::from('png');
        $this->assertSame(ConvertImageSvgOutputFormat::Png, $enum);
        $this->assertSame('png', $enum->value);
    }

    public function testConvertImageSvgOutputFormatWebpBackingValue(): void
    {
        $enum = ConvertImageSvgOutputFormat::from('webp');
        $this->assertSame(ConvertImageSvgOutputFormat::Webp, $enum);
        $this->assertSame('webp', $enum->value);
    }

    public function testConvertImageSvgOutputFormatAvifBackingValue(): void
    {
        $enum = ConvertImageSvgOutputFormat::from('avif');
        $this->assertSame(ConvertImageSvgOutputFormat::Avif, $enum);
        $this->assertSame('avif', $enum->value);
    }

    public function testConvertImageSvgOutputFormatGifBackingValue(): void
    {
        $enum = ConvertImageSvgOutputFormat::from('gif');
        $this->assertSame(ConvertImageSvgOutputFormat::Gif, $enum);
        $this->assertSame('gif', $enum->value);
    }

    public function testConvertImageSvgOutputFormatTiffBackingValue(): void
    {
        $enum = ConvertImageSvgOutputFormat::from('tiff');
        $this->assertSame(ConvertImageSvgOutputFormat::Tiff, $enum);
        $this->assertSame('tiff', $enum->value);
    }

    public function testConvertImageSvgOutputFormatCaseCount(): void
    {
        $this->assertCount(6, ConvertImageSvgOutputFormat::cases());
    }

    public function testConvertImageSvgOptionsDefaultConstruction(): void
    {
        $obj = new ConvertImageSvgOptions(
            output_format: ConvertImageSvgOutputFormat::Jpeg,
        );
        $this->assertInstanceOf(ConvertImageSvgOptions::class, $obj);
        $this->assertNull($obj->quality);
        $this->assertNull($obj->background);
    }

    public function testConvertImageSvgOptionsFullConstruction(): void
    {
        $obj = new ConvertImageSvgOptions(
            output_format: ConvertImageSvgOutputFormat::Jpeg,
            quality: 1,
            background: 'test_value',
        );
        $this->assertInstanceOf(ConvertImageSvgOptions::class, $obj);
    }

    public function testConvertImageGifOutputFormatJpegBackingValue(): void
    {
        $enum = ConvertImageGifOutputFormat::from('jpeg');
        $this->assertSame(ConvertImageGifOutputFormat::Jpeg, $enum);
        $this->assertSame('jpeg', $enum->value);
    }

    public function testConvertImageGifOutputFormatPngBackingValue(): void
    {
        $enum = ConvertImageGifOutputFormat::from('png');
        $this->assertSame(ConvertImageGifOutputFormat::Png, $enum);
        $this->assertSame('png', $enum->value);
    }

    public function testConvertImageGifOutputFormatWebpBackingValue(): void
    {
        $enum = ConvertImageGifOutputFormat::from('webp');
        $this->assertSame(ConvertImageGifOutputFormat::Webp, $enum);
        $this->assertSame('webp', $enum->value);
    }

    public function testConvertImageGifOutputFormatAvifBackingValue(): void
    {
        $enum = ConvertImageGifOutputFormat::from('avif');
        $this->assertSame(ConvertImageGifOutputFormat::Avif, $enum);
        $this->assertSame('avif', $enum->value);
    }

    public function testConvertImageGifOutputFormatGifBackingValue(): void
    {
        $enum = ConvertImageGifOutputFormat::from('gif');
        $this->assertSame(ConvertImageGifOutputFormat::Gif, $enum);
        $this->assertSame('gif', $enum->value);
    }

    public function testConvertImageGifOutputFormatTiffBackingValue(): void
    {
        $enum = ConvertImageGifOutputFormat::from('tiff');
        $this->assertSame(ConvertImageGifOutputFormat::Tiff, $enum);
        $this->assertSame('tiff', $enum->value);
    }

    public function testConvertImageGifOutputFormatMp4BackingValue(): void
    {
        $enum = ConvertImageGifOutputFormat::from('mp4');
        $this->assertSame(ConvertImageGifOutputFormat::Mp4, $enum);
        $this->assertSame('mp4', $enum->value);
    }

    public function testConvertImageGifOutputFormatWebmBackingValue(): void
    {
        $enum = ConvertImageGifOutputFormat::from('webm');
        $this->assertSame(ConvertImageGifOutputFormat::Webm, $enum);
        $this->assertSame('webm', $enum->value);
    }

    public function testConvertImageGifOutputFormatCaseCount(): void
    {
        $this->assertCount(8, ConvertImageGifOutputFormat::cases());
    }

    public function testConvertImageGifFitMaxBackingValue(): void
    {
        $enum = ConvertImageGifFit::from('max');
        $this->assertSame(ConvertImageGifFit::Max, $enum);
        $this->assertSame('max', $enum->value);
    }

    public function testConvertImageGifFitCropBackingValue(): void
    {
        $enum = ConvertImageGifFit::from('crop');
        $this->assertSame(ConvertImageGifFit::Crop, $enum);
        $this->assertSame('crop', $enum->value);
    }

    public function testConvertImageGifFitScaleBackingValue(): void
    {
        $enum = ConvertImageGifFit::from('scale');
        $this->assertSame(ConvertImageGifFit::Scale, $enum);
        $this->assertSame('scale', $enum->value);
    }

    public function testConvertImageGifFitCaseCount(): void
    {
        $this->assertCount(3, ConvertImageGifFit::cases());
    }

    public function testConvertImageGifColorProfileKeepBackingValue(): void
    {
        $enum = ConvertImageGifColorProfile::from('keep');
        $this->assertSame(ConvertImageGifColorProfile::Keep, $enum);
        $this->assertSame('keep', $enum->value);
    }

    public function testConvertImageGifColorProfileSrgbBackingValue(): void
    {
        $enum = ConvertImageGifColorProfile::from('srgb');
        $this->assertSame(ConvertImageGifColorProfile::Srgb, $enum);
        $this->assertSame('srgb', $enum->value);
    }

    public function testConvertImageGifColorProfileStripBackingValue(): void
    {
        $enum = ConvertImageGifColorProfile::from('strip');
        $this->assertSame(ConvertImageGifColorProfile::Strip, $enum);
        $this->assertSame('strip', $enum->value);
    }

    public function testConvertImageGifColorProfileCaseCount(): void
    {
        $this->assertCount(3, ConvertImageGifColorProfile::cases());
    }

    public function testConvertImageGifOptionsDefaultConstruction(): void
    {
        $obj = new ConvertImageGifOptions(
            output_format: ConvertImageGifOutputFormat::Jpeg,
        );
        $this->assertInstanceOf(ConvertImageGifOptions::class, $obj);
        $this->assertNull($obj->quality);
        $this->assertNull($obj->background);
        $this->assertNull($obj->width);
        $this->assertNull($obj->height);
        $this->assertNull($obj->fit);
        $this->assertNull($obj->color_profile);
        $this->assertNull($obj->auto_orient);
    }

    public function testConvertImageGifOptionsFullConstruction(): void
    {
        $obj = new ConvertImageGifOptions(
            output_format: ConvertImageGifOutputFormat::Jpeg,
            quality: 1,
            background: 'test_value',
            width: 1,
            height: 1,
            fit: ConvertImageGifFit::Max,
            color_profile: ConvertImageGifColorProfile::Keep,
            auto_orient: true,
        );
        $this->assertInstanceOf(ConvertImageGifOptions::class, $obj);
    }

    public function testConvertVideoOutputFormatMp4BackingValue(): void
    {
        $enum = ConvertVideoOutputFormat::from('mp4');
        $this->assertSame(ConvertVideoOutputFormat::Mp4, $enum);
        $this->assertSame('mp4', $enum->value);
    }

    public function testConvertVideoOutputFormatWebmBackingValue(): void
    {
        $enum = ConvertVideoOutputFormat::from('webm');
        $this->assertSame(ConvertVideoOutputFormat::Webm, $enum);
        $this->assertSame('webm', $enum->value);
    }

    public function testConvertVideoOutputFormatOggBackingValue(): void
    {
        $enum = ConvertVideoOutputFormat::from('ogg');
        $this->assertSame(ConvertVideoOutputFormat::Ogg, $enum);
        $this->assertSame('ogg', $enum->value);
    }

    public function testConvertVideoOutputFormatGifBackingValue(): void
    {
        $enum = ConvertVideoOutputFormat::from('gif');
        $this->assertSame(ConvertVideoOutputFormat::Gif, $enum);
        $this->assertSame('gif', $enum->value);
    }

    public function testConvertVideoOutputFormatMovBackingValue(): void
    {
        $enum = ConvertVideoOutputFormat::from('mov');
        $this->assertSame(ConvertVideoOutputFormat::Mov, $enum);
        $this->assertSame('mov', $enum->value);
    }

    public function testConvertVideoOutputFormatMkvBackingValue(): void
    {
        $enum = ConvertVideoOutputFormat::from('mkv');
        $this->assertSame(ConvertVideoOutputFormat::Mkv, $enum);
        $this->assertSame('mkv', $enum->value);
    }

    public function testConvertVideoOutputFormatCaseCount(): void
    {
        $this->assertCount(6, ConvertVideoOutputFormat::cases());
    }

    public function testConvertVideoDitherNoneBackingValue(): void
    {
        $enum = ConvertVideoDither::from('none');
        $this->assertSame(ConvertVideoDither::None, $enum);
        $this->assertSame('none', $enum->value);
    }

    public function testConvertVideoDitherBayerBackingValue(): void
    {
        $enum = ConvertVideoDither::from('bayer');
        $this->assertSame(ConvertVideoDither::Bayer, $enum);
        $this->assertSame('bayer', $enum->value);
    }

    public function testConvertVideoDitherFloydSteinbergBackingValue(): void
    {
        $enum = ConvertVideoDither::from('floyd_steinberg');
        $this->assertSame(ConvertVideoDither::FloydSteinberg, $enum);
        $this->assertSame('floyd_steinberg', $enum->value);
    }

    public function testConvertVideoDitherSierra2BackingValue(): void
    {
        $enum = ConvertVideoDither::from('sierra2');
        $this->assertSame(ConvertVideoDither::Sierra2, $enum);
        $this->assertSame('sierra2', $enum->value);
    }

    public function testConvertVideoDitherSierra24aBackingValue(): void
    {
        $enum = ConvertVideoDither::from('sierra2_4a');
        $this->assertSame(ConvertVideoDither::Sierra24a, $enum);
        $this->assertSame('sierra2_4a', $enum->value);
    }

    public function testConvertVideoDitherCaseCount(): void
    {
        $this->assertCount(5, ConvertVideoDither::cases());
    }

    public function testConvertVideoOptionsDefaultConstruction(): void
    {
        $obj = new ConvertVideoOptions(
            output_format: ConvertVideoOutputFormat::Mp4,
        );
        $this->assertInstanceOf(ConvertVideoOptions::class, $obj);
        $this->assertNull($obj->crf);
        $this->assertNull($obj->trim_start);
        $this->assertNull($obj->trim_end);
        $this->assertNull($obj->fps);
        $this->assertNull($obj->width);
        $this->assertNull($obj->max_colors);
        $this->assertNull($obj->loop);
        $this->assertNull($obj->dither);
    }

    public function testConvertVideoOptionsFullConstruction(): void
    {
        $obj = new ConvertVideoOptions(
            output_format: ConvertVideoOutputFormat::Mp4,
            crf: 0,
            trim_start: 0.0,
            trim_end: 0.0,
            fps: 1.0,
            width: 1,
            max_colors: 2,
            loop: -1,
            dither: ConvertVideoDither::None,
        );
        $this->assertInstanceOf(ConvertVideoOptions::class, $obj);
    }

    public function testConvertAudioOutputFormatMp3BackingValue(): void
    {
        $enum = ConvertAudioOutputFormat::from('mp3');
        $this->assertSame(ConvertAudioOutputFormat::Mp3, $enum);
        $this->assertSame('mp3', $enum->value);
    }

    public function testConvertAudioOutputFormatAacBackingValue(): void
    {
        $enum = ConvertAudioOutputFormat::from('aac');
        $this->assertSame(ConvertAudioOutputFormat::Aac, $enum);
        $this->assertSame('aac', $enum->value);
    }

    public function testConvertAudioOutputFormatOggBackingValue(): void
    {
        $enum = ConvertAudioOutputFormat::from('ogg');
        $this->assertSame(ConvertAudioOutputFormat::Ogg, $enum);
        $this->assertSame('ogg', $enum->value);
    }

    public function testConvertAudioOutputFormatOpusBackingValue(): void
    {
        $enum = ConvertAudioOutputFormat::from('opus');
        $this->assertSame(ConvertAudioOutputFormat::Opus, $enum);
        $this->assertSame('opus', $enum->value);
    }

    public function testConvertAudioOutputFormatFlacBackingValue(): void
    {
        $enum = ConvertAudioOutputFormat::from('flac');
        $this->assertSame(ConvertAudioOutputFormat::Flac, $enum);
        $this->assertSame('flac', $enum->value);
    }

    public function testConvertAudioOutputFormatWavBackingValue(): void
    {
        $enum = ConvertAudioOutputFormat::from('wav');
        $this->assertSame(ConvertAudioOutputFormat::Wav, $enum);
        $this->assertSame('wav', $enum->value);
    }

    public function testConvertAudioOutputFormatCaseCount(): void
    {
        $this->assertCount(6, ConvertAudioOutputFormat::cases());
    }

    public function testConvertAudioBitrate_64BackingValue(): void
    {
        $enum = ConvertAudioBitrate::from(64);
        $this->assertSame(ConvertAudioBitrate::_64, $enum);
        $this->assertSame(64, $enum->value);
    }

    public function testConvertAudioBitrate_96BackingValue(): void
    {
        $enum = ConvertAudioBitrate::from(96);
        $this->assertSame(ConvertAudioBitrate::_96, $enum);
        $this->assertSame(96, $enum->value);
    }

    public function testConvertAudioBitrate_128BackingValue(): void
    {
        $enum = ConvertAudioBitrate::from(128);
        $this->assertSame(ConvertAudioBitrate::_128, $enum);
        $this->assertSame(128, $enum->value);
    }

    public function testConvertAudioBitrate_192BackingValue(): void
    {
        $enum = ConvertAudioBitrate::from(192);
        $this->assertSame(ConvertAudioBitrate::_192, $enum);
        $this->assertSame(192, $enum->value);
    }

    public function testConvertAudioBitrate_256BackingValue(): void
    {
        $enum = ConvertAudioBitrate::from(256);
        $this->assertSame(ConvertAudioBitrate::_256, $enum);
        $this->assertSame(256, $enum->value);
    }

    public function testConvertAudioBitrate_320BackingValue(): void
    {
        $enum = ConvertAudioBitrate::from(320);
        $this->assertSame(ConvertAudioBitrate::_320, $enum);
        $this->assertSame(320, $enum->value);
    }

    public function testConvertAudioBitrateCaseCount(): void
    {
        $this->assertCount(6, ConvertAudioBitrate::cases());
    }

    public function testConvertAudioOptionsDefaultConstruction(): void
    {
        $obj = new ConvertAudioOptions(
            output_format: ConvertAudioOutputFormat::Mp3,
        );
        $this->assertInstanceOf(ConvertAudioOptions::class, $obj);
        $this->assertNull($obj->bitrate);
    }

    public function testConvertAudioOptionsFullConstruction(): void
    {
        $obj = new ConvertAudioOptions(
            output_format: ConvertAudioOutputFormat::Mp3,
            bitrate: ConvertAudioBitrate::_64,
        );
        $this->assertInstanceOf(ConvertAudioOptions::class, $obj);
    }

    public function testConvertDocumentPdfOutputFormatPngBackingValue(): void
    {
        $enum = ConvertDocumentPdfOutputFormat::from('png');
        $this->assertSame(ConvertDocumentPdfOutputFormat::Png, $enum);
        $this->assertSame('png', $enum->value);
    }

    public function testConvertDocumentPdfOutputFormatJpegBackingValue(): void
    {
        $enum = ConvertDocumentPdfOutputFormat::from('jpeg');
        $this->assertSame(ConvertDocumentPdfOutputFormat::Jpeg, $enum);
        $this->assertSame('jpeg', $enum->value);
    }

    public function testConvertDocumentPdfOutputFormatCaseCount(): void
    {
        $this->assertCount(2, ConvertDocumentPdfOutputFormat::cases());
    }

    public function testConvertDocumentPdfOptionsDefaultConstruction(): void
    {
        $obj = new ConvertDocumentPdfOptions(
            output_format: ConvertDocumentPdfOutputFormat::Png,
        );
        $this->assertInstanceOf(ConvertDocumentPdfOptions::class, $obj);
        $this->assertSame('1', $obj->pages);
        $this->assertSame(150, $obj->dpi);
    }

    public function testConvertDocumentPdfOptionsFullConstruction(): void
    {
        $obj = new ConvertDocumentPdfOptions(
            output_format: ConvertDocumentPdfOutputFormat::Png,
            pages: 'test_value',
            dpi: 72,
        );
        $this->assertInstanceOf(ConvertDocumentPdfOptions::class, $obj);
    }

}
