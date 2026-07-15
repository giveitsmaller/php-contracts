<?php

// Auto-generated -- do not edit

declare(strict_types=1);

namespace Gisl\Generated\Operations\Tests;

use PHPUnit\Framework\TestCase;
use Gisl\Generated\Operations\CompressAudioBitrate;
use Gisl\Generated\Operations\CompressAudioOptions;
use Gisl\Generated\Operations\CompressAudioOutputFormat;
use Gisl\Generated\Operations\CompressAudioSampleRate;
use Gisl\Generated\Operations\CompressDocumentEpubOptions;
use Gisl\Generated\Operations\CompressDocumentOdfOptions;
use Gisl\Generated\Operations\CompressDocumentOfficeOptions;
use Gisl\Generated\Operations\CompressImageAvifColorProfile;
use Gisl\Generated\Operations\CompressImageAvifEncodingMode;
use Gisl\Generated\Operations\CompressImageAvifFit;
use Gisl\Generated\Operations\CompressImageAvifMetadata;
use Gisl\Generated\Operations\CompressImageAvifOptions;
use Gisl\Generated\Operations\CompressImageAvifOutputFormat;
use Gisl\Generated\Operations\CompressImageAvifQualityPreset;
use Gisl\Generated\Operations\CompressImageColorProfile;
use Gisl\Generated\Operations\CompressImageFit;
use Gisl\Generated\Operations\CompressImageJpegChromaSubsampling;
use Gisl\Generated\Operations\CompressImageJpegColorProfile;
use Gisl\Generated\Operations\CompressImageJpegEncodingMode;
use Gisl\Generated\Operations\CompressImageJpegFit;
use Gisl\Generated\Operations\CompressImageJpegMetadata;
use Gisl\Generated\Operations\CompressImageJpegOptions;
use Gisl\Generated\Operations\CompressImageJpegOutputFormat;
use Gisl\Generated\Operations\CompressImageJpegQualityPreset;
use Gisl\Generated\Operations\CompressImageMetadata;
use Gisl\Generated\Operations\CompressImageOptions;
use Gisl\Generated\Operations\CompressImageOutputFormat;
use Gisl\Generated\Operations\CompressImagePngColorProfile;
use Gisl\Generated\Operations\CompressImagePngFit;
use Gisl\Generated\Operations\CompressImagePngMetadata;
use Gisl\Generated\Operations\CompressImagePngOptions;
use Gisl\Generated\Operations\CompressImagePngOutputFormat;
use Gisl\Generated\Operations\CompressImageSvgMetadata;
use Gisl\Generated\Operations\CompressImageSvgOptions;
use Gisl\Generated\Operations\CompressImageSvgOutputFormat;
use Gisl\Generated\Operations\CompressImageWebpColorProfile;
use Gisl\Generated\Operations\CompressImageWebpEncodingMode;
use Gisl\Generated\Operations\CompressImageWebpFit;
use Gisl\Generated\Operations\CompressImageWebpMetadata;
use Gisl\Generated\Operations\CompressImageWebpOptions;
use Gisl\Generated\Operations\CompressImageWebpOutputFormat;
use Gisl\Generated\Operations\CompressImageWebpQualityPreset;
use Gisl\Generated\Operations\CompressVideoAudioBitrate;
use Gisl\Generated\Operations\CompressVideoAudioCodec;
use Gisl\Generated\Operations\CompressVideoCodec;
use Gisl\Generated\Operations\CompressVideoEncodingMode;
use Gisl\Generated\Operations\CompressVideoFit;
use Gisl\Generated\Operations\CompressVideoOptions;
use Gisl\Generated\Operations\CompressVideoOutputFormat;
use Gisl\Generated\Operations\CompressVideoPreset;

final class CompressTest extends TestCase
{
    public function testCompressImageJpegEncodingModeQualityBackingValue(): void
    {
        $enum = CompressImageJpegEncodingMode::from('quality');
        $this->assertSame(CompressImageJpegEncodingMode::Quality, $enum);
        $this->assertSame('quality', $enum->value);
    }

    public function testCompressImageJpegEncodingModeTargetSizeBackingValue(): void
    {
        $enum = CompressImageJpegEncodingMode::from('target_size');
        $this->assertSame(CompressImageJpegEncodingMode::TargetSize, $enum);
        $this->assertSame('target_size', $enum->value);
    }

    public function testCompressImageJpegEncodingModeAutoQualityBackingValue(): void
    {
        $enum = CompressImageJpegEncodingMode::from('auto_quality');
        $this->assertSame(CompressImageJpegEncodingMode::AutoQuality, $enum);
        $this->assertSame('auto_quality', $enum->value);
    }

    public function testCompressImageJpegEncodingModeCaseCount(): void
    {
        $this->assertCount(3, CompressImageJpegEncodingMode::cases());
    }

    public function testCompressImageJpegQualityPresetBestBackingValue(): void
    {
        $enum = CompressImageJpegQualityPreset::from('best');
        $this->assertSame(CompressImageJpegQualityPreset::Best, $enum);
        $this->assertSame('best', $enum->value);
    }

    public function testCompressImageJpegQualityPresetGoodBackingValue(): void
    {
        $enum = CompressImageJpegQualityPreset::from('good');
        $this->assertSame(CompressImageJpegQualityPreset::Good, $enum);
        $this->assertSame('good', $enum->value);
    }

    public function testCompressImageJpegQualityPresetFairBackingValue(): void
    {
        $enum = CompressImageJpegQualityPreset::from('fair');
        $this->assertSame(CompressImageJpegQualityPreset::Fair, $enum);
        $this->assertSame('fair', $enum->value);
    }

    public function testCompressImageJpegQualityPresetLowBackingValue(): void
    {
        $enum = CompressImageJpegQualityPreset::from('low');
        $this->assertSame(CompressImageJpegQualityPreset::Low, $enum);
        $this->assertSame('low', $enum->value);
    }

    public function testCompressImageJpegQualityPresetCaseCount(): void
    {
        $this->assertCount(4, CompressImageJpegQualityPreset::cases());
    }

    public function testCompressImageJpegMetadataStripBackingValue(): void
    {
        $enum = CompressImageJpegMetadata::from('strip');
        $this->assertSame(CompressImageJpegMetadata::Strip, $enum);
        $this->assertSame('strip', $enum->value);
    }

    public function testCompressImageJpegMetadataKeepBackingValue(): void
    {
        $enum = CompressImageJpegMetadata::from('keep');
        $this->assertSame(CompressImageJpegMetadata::Keep, $enum);
        $this->assertSame('keep', $enum->value);
    }

    public function testCompressImageJpegMetadataAllBackingValue(): void
    {
        $enum = CompressImageJpegMetadata::from('all');
        $this->assertSame(CompressImageJpegMetadata::All, $enum);
        $this->assertSame('all', $enum->value);
    }

    public function testCompressImageJpegMetadataCaseCount(): void
    {
        $this->assertCount(3, CompressImageJpegMetadata::cases());
    }

    public function testCompressImageJpegChromaSubsampling_420BackingValue(): void
    {
        $enum = CompressImageJpegChromaSubsampling::from('420');
        $this->assertSame(CompressImageJpegChromaSubsampling::_420, $enum);
        $this->assertSame('420', $enum->value);
    }

    public function testCompressImageJpegChromaSubsampling_422BackingValue(): void
    {
        $enum = CompressImageJpegChromaSubsampling::from('422');
        $this->assertSame(CompressImageJpegChromaSubsampling::_422, $enum);
        $this->assertSame('422', $enum->value);
    }

    public function testCompressImageJpegChromaSubsampling_444BackingValue(): void
    {
        $enum = CompressImageJpegChromaSubsampling::from('444');
        $this->assertSame(CompressImageJpegChromaSubsampling::_444, $enum);
        $this->assertSame('444', $enum->value);
    }

    public function testCompressImageJpegChromaSubsamplingCaseCount(): void
    {
        $this->assertCount(3, CompressImageJpegChromaSubsampling::cases());
    }

    public function testCompressImageJpegOutputFormatOriginalBackingValue(): void
    {
        $enum = CompressImageJpegOutputFormat::from('original');
        $this->assertSame(CompressImageJpegOutputFormat::Original, $enum);
        $this->assertSame('original', $enum->value);
    }

    public function testCompressImageJpegOutputFormatWebpBackingValue(): void
    {
        $enum = CompressImageJpegOutputFormat::from('webp');
        $this->assertSame(CompressImageJpegOutputFormat::Webp, $enum);
        $this->assertSame('webp', $enum->value);
    }

    public function testCompressImageJpegOutputFormatAutoBackingValue(): void
    {
        $enum = CompressImageJpegOutputFormat::from('auto');
        $this->assertSame(CompressImageJpegOutputFormat::Auto, $enum);
        $this->assertSame('auto', $enum->value);
    }

    public function testCompressImageJpegOutputFormatSmallestBackingValue(): void
    {
        $enum = CompressImageJpegOutputFormat::from('smallest');
        $this->assertSame(CompressImageJpegOutputFormat::Smallest, $enum);
        $this->assertSame('smallest', $enum->value);
    }

    public function testCompressImageJpegOutputFormatCaseCount(): void
    {
        $this->assertCount(4, CompressImageJpegOutputFormat::cases());
    }

    public function testCompressImageJpegFitMaxBackingValue(): void
    {
        $enum = CompressImageJpegFit::from('max');
        $this->assertSame(CompressImageJpegFit::Max, $enum);
        $this->assertSame('max', $enum->value);
    }

    public function testCompressImageJpegFitCropBackingValue(): void
    {
        $enum = CompressImageJpegFit::from('crop');
        $this->assertSame(CompressImageJpegFit::Crop, $enum);
        $this->assertSame('crop', $enum->value);
    }

    public function testCompressImageJpegFitScaleBackingValue(): void
    {
        $enum = CompressImageJpegFit::from('scale');
        $this->assertSame(CompressImageJpegFit::Scale, $enum);
        $this->assertSame('scale', $enum->value);
    }

    public function testCompressImageJpegFitCaseCount(): void
    {
        $this->assertCount(3, CompressImageJpegFit::cases());
    }

    public function testCompressImageJpegColorProfileKeepBackingValue(): void
    {
        $enum = CompressImageJpegColorProfile::from('keep');
        $this->assertSame(CompressImageJpegColorProfile::Keep, $enum);
        $this->assertSame('keep', $enum->value);
    }

    public function testCompressImageJpegColorProfileSrgbBackingValue(): void
    {
        $enum = CompressImageJpegColorProfile::from('srgb');
        $this->assertSame(CompressImageJpegColorProfile::Srgb, $enum);
        $this->assertSame('srgb', $enum->value);
    }

    public function testCompressImageJpegColorProfileStripBackingValue(): void
    {
        $enum = CompressImageJpegColorProfile::from('strip');
        $this->assertSame(CompressImageJpegColorProfile::Strip, $enum);
        $this->assertSame('strip', $enum->value);
    }

    public function testCompressImageJpegColorProfileCaseCount(): void
    {
        $this->assertCount(3, CompressImageJpegColorProfile::cases());
    }

    public function testCompressImageJpegOptionsDefaultConstruction(): void
    {
        $obj = new CompressImageJpegOptions();
        $this->assertInstanceOf(CompressImageJpegOptions::class, $obj);
        $this->assertSame(CompressImageJpegEncodingMode::Quality, $obj->encoding_mode);
        $this->assertSame(CompressImageJpegMetadata::Strip, $obj->metadata);
        $this->assertSame(true, $obj->progressive);
        $this->assertSame(CompressImageJpegOutputFormat::Original, $obj->output_format);
        $this->assertSame(CompressImageJpegColorProfile::Keep, $obj->color_profile);
        $this->assertSame(true, $obj->auto_orient);
        $this->assertNull($obj->quality);
        $this->assertNull($obj->target_size_bytes);
        $this->assertNull($obj->quality_preset);
        $this->assertNull($obj->chroma_subsampling);
        $this->assertNull($obj->lossless);
        $this->assertNull($obj->width);
        $this->assertNull($obj->height);
        $this->assertNull($obj->fit);
    }

    public function testCompressImageJpegOptionsFullConstruction(): void
    {
        $obj = new CompressImageJpegOptions(
            quality: 1,
            encoding_mode: CompressImageJpegEncodingMode::Quality,
            target_size_bytes: 1024,
            quality_preset: CompressImageJpegQualityPreset::Best,
            metadata: CompressImageJpegMetadata::Strip,
            progressive: true,
            chroma_subsampling: CompressImageJpegChromaSubsampling::_420,
            output_format: CompressImageJpegOutputFormat::Original,
            lossless: true,
            width: 1,
            height: 1,
            fit: CompressImageJpegFit::Max,
            color_profile: CompressImageJpegColorProfile::Keep,
            auto_orient: true,
        );
        $this->assertInstanceOf(CompressImageJpegOptions::class, $obj);
    }

    public function testCompressImagePngMetadataStripBackingValue(): void
    {
        $enum = CompressImagePngMetadata::from('strip');
        $this->assertSame(CompressImagePngMetadata::Strip, $enum);
        $this->assertSame('strip', $enum->value);
    }

    public function testCompressImagePngMetadataKeepBackingValue(): void
    {
        $enum = CompressImagePngMetadata::from('keep');
        $this->assertSame(CompressImagePngMetadata::Keep, $enum);
        $this->assertSame('keep', $enum->value);
    }

    public function testCompressImagePngMetadataAllBackingValue(): void
    {
        $enum = CompressImagePngMetadata::from('all');
        $this->assertSame(CompressImagePngMetadata::All, $enum);
        $this->assertSame('all', $enum->value);
    }

    public function testCompressImagePngMetadataCaseCount(): void
    {
        $this->assertCount(3, CompressImagePngMetadata::cases());
    }

    public function testCompressImagePngOutputFormatOriginalBackingValue(): void
    {
        $enum = CompressImagePngOutputFormat::from('original');
        $this->assertSame(CompressImagePngOutputFormat::Original, $enum);
        $this->assertSame('original', $enum->value);
    }

    public function testCompressImagePngOutputFormatWebpBackingValue(): void
    {
        $enum = CompressImagePngOutputFormat::from('webp');
        $this->assertSame(CompressImagePngOutputFormat::Webp, $enum);
        $this->assertSame('webp', $enum->value);
    }

    public function testCompressImagePngOutputFormatAutoBackingValue(): void
    {
        $enum = CompressImagePngOutputFormat::from('auto');
        $this->assertSame(CompressImagePngOutputFormat::Auto, $enum);
        $this->assertSame('auto', $enum->value);
    }

    public function testCompressImagePngOutputFormatSmallestBackingValue(): void
    {
        $enum = CompressImagePngOutputFormat::from('smallest');
        $this->assertSame(CompressImagePngOutputFormat::Smallest, $enum);
        $this->assertSame('smallest', $enum->value);
    }

    public function testCompressImagePngOutputFormatCaseCount(): void
    {
        $this->assertCount(4, CompressImagePngOutputFormat::cases());
    }

    public function testCompressImagePngFitMaxBackingValue(): void
    {
        $enum = CompressImagePngFit::from('max');
        $this->assertSame(CompressImagePngFit::Max, $enum);
        $this->assertSame('max', $enum->value);
    }

    public function testCompressImagePngFitCropBackingValue(): void
    {
        $enum = CompressImagePngFit::from('crop');
        $this->assertSame(CompressImagePngFit::Crop, $enum);
        $this->assertSame('crop', $enum->value);
    }

    public function testCompressImagePngFitScaleBackingValue(): void
    {
        $enum = CompressImagePngFit::from('scale');
        $this->assertSame(CompressImagePngFit::Scale, $enum);
        $this->assertSame('scale', $enum->value);
    }

    public function testCompressImagePngFitCaseCount(): void
    {
        $this->assertCount(3, CompressImagePngFit::cases());
    }

    public function testCompressImagePngColorProfileKeepBackingValue(): void
    {
        $enum = CompressImagePngColorProfile::from('keep');
        $this->assertSame(CompressImagePngColorProfile::Keep, $enum);
        $this->assertSame('keep', $enum->value);
    }

    public function testCompressImagePngColorProfileSrgbBackingValue(): void
    {
        $enum = CompressImagePngColorProfile::from('srgb');
        $this->assertSame(CompressImagePngColorProfile::Srgb, $enum);
        $this->assertSame('srgb', $enum->value);
    }

    public function testCompressImagePngColorProfileStripBackingValue(): void
    {
        $enum = CompressImagePngColorProfile::from('strip');
        $this->assertSame(CompressImagePngColorProfile::Strip, $enum);
        $this->assertSame('strip', $enum->value);
    }

    public function testCompressImagePngColorProfileCaseCount(): void
    {
        $this->assertCount(3, CompressImagePngColorProfile::cases());
    }

    public function testCompressImagePngOptionsDefaultConstruction(): void
    {
        $obj = new CompressImagePngOptions();
        $this->assertInstanceOf(CompressImagePngOptions::class, $obj);
        $this->assertSame(80, $obj->quality);
        $this->assertSame(CompressImagePngMetadata::Strip, $obj->metadata);
        $this->assertSame(3, $obj->optimization_level);
        $this->assertSame(CompressImagePngOutputFormat::Original, $obj->output_format);
        $this->assertSame(CompressImagePngColorProfile::Keep, $obj->color_profile);
        $this->assertSame(true, $obj->auto_orient);
        $this->assertNull($obj->width);
        $this->assertNull($obj->height);
        $this->assertNull($obj->fit);
    }

    public function testCompressImagePngOptionsFullConstruction(): void
    {
        $obj = new CompressImagePngOptions(
            quality: 1,
            metadata: CompressImagePngMetadata::Strip,
            optimization_level: 0,
            output_format: CompressImagePngOutputFormat::Original,
            width: 1,
            height: 1,
            fit: CompressImagePngFit::Max,
            color_profile: CompressImagePngColorProfile::Keep,
            auto_orient: true,
        );
        $this->assertInstanceOf(CompressImagePngOptions::class, $obj);
    }

    public function testCompressImageAvifEncodingModeQualityBackingValue(): void
    {
        $enum = CompressImageAvifEncodingMode::from('quality');
        $this->assertSame(CompressImageAvifEncodingMode::Quality, $enum);
        $this->assertSame('quality', $enum->value);
    }

    public function testCompressImageAvifEncodingModeTargetSizeBackingValue(): void
    {
        $enum = CompressImageAvifEncodingMode::from('target_size');
        $this->assertSame(CompressImageAvifEncodingMode::TargetSize, $enum);
        $this->assertSame('target_size', $enum->value);
    }

    public function testCompressImageAvifEncodingModeAutoQualityBackingValue(): void
    {
        $enum = CompressImageAvifEncodingMode::from('auto_quality');
        $this->assertSame(CompressImageAvifEncodingMode::AutoQuality, $enum);
        $this->assertSame('auto_quality', $enum->value);
    }

    public function testCompressImageAvifEncodingModeCaseCount(): void
    {
        $this->assertCount(3, CompressImageAvifEncodingMode::cases());
    }

    public function testCompressImageAvifQualityPresetBestBackingValue(): void
    {
        $enum = CompressImageAvifQualityPreset::from('best');
        $this->assertSame(CompressImageAvifQualityPreset::Best, $enum);
        $this->assertSame('best', $enum->value);
    }

    public function testCompressImageAvifQualityPresetGoodBackingValue(): void
    {
        $enum = CompressImageAvifQualityPreset::from('good');
        $this->assertSame(CompressImageAvifQualityPreset::Good, $enum);
        $this->assertSame('good', $enum->value);
    }

    public function testCompressImageAvifQualityPresetFairBackingValue(): void
    {
        $enum = CompressImageAvifQualityPreset::from('fair');
        $this->assertSame(CompressImageAvifQualityPreset::Fair, $enum);
        $this->assertSame('fair', $enum->value);
    }

    public function testCompressImageAvifQualityPresetLowBackingValue(): void
    {
        $enum = CompressImageAvifQualityPreset::from('low');
        $this->assertSame(CompressImageAvifQualityPreset::Low, $enum);
        $this->assertSame('low', $enum->value);
    }

    public function testCompressImageAvifQualityPresetCaseCount(): void
    {
        $this->assertCount(4, CompressImageAvifQualityPreset::cases());
    }

    public function testCompressImageAvifMetadataStripBackingValue(): void
    {
        $enum = CompressImageAvifMetadata::from('strip');
        $this->assertSame(CompressImageAvifMetadata::Strip, $enum);
        $this->assertSame('strip', $enum->value);
    }

    public function testCompressImageAvifMetadataAllBackingValue(): void
    {
        $enum = CompressImageAvifMetadata::from('all');
        $this->assertSame(CompressImageAvifMetadata::All, $enum);
        $this->assertSame('all', $enum->value);
    }

    public function testCompressImageAvifMetadataCaseCount(): void
    {
        $this->assertCount(2, CompressImageAvifMetadata::cases());
    }

    public function testCompressImageAvifOutputFormatOriginalBackingValue(): void
    {
        $enum = CompressImageAvifOutputFormat::from('original');
        $this->assertSame(CompressImageAvifOutputFormat::Original, $enum);
        $this->assertSame('original', $enum->value);
    }

    public function testCompressImageAvifOutputFormatWebpBackingValue(): void
    {
        $enum = CompressImageAvifOutputFormat::from('webp');
        $this->assertSame(CompressImageAvifOutputFormat::Webp, $enum);
        $this->assertSame('webp', $enum->value);
    }

    public function testCompressImageAvifOutputFormatAutoBackingValue(): void
    {
        $enum = CompressImageAvifOutputFormat::from('auto');
        $this->assertSame(CompressImageAvifOutputFormat::Auto, $enum);
        $this->assertSame('auto', $enum->value);
    }

    public function testCompressImageAvifOutputFormatSmallestBackingValue(): void
    {
        $enum = CompressImageAvifOutputFormat::from('smallest');
        $this->assertSame(CompressImageAvifOutputFormat::Smallest, $enum);
        $this->assertSame('smallest', $enum->value);
    }

    public function testCompressImageAvifOutputFormatCaseCount(): void
    {
        $this->assertCount(4, CompressImageAvifOutputFormat::cases());
    }

    public function testCompressImageAvifFitMaxBackingValue(): void
    {
        $enum = CompressImageAvifFit::from('max');
        $this->assertSame(CompressImageAvifFit::Max, $enum);
        $this->assertSame('max', $enum->value);
    }

    public function testCompressImageAvifFitCropBackingValue(): void
    {
        $enum = CompressImageAvifFit::from('crop');
        $this->assertSame(CompressImageAvifFit::Crop, $enum);
        $this->assertSame('crop', $enum->value);
    }

    public function testCompressImageAvifFitScaleBackingValue(): void
    {
        $enum = CompressImageAvifFit::from('scale');
        $this->assertSame(CompressImageAvifFit::Scale, $enum);
        $this->assertSame('scale', $enum->value);
    }

    public function testCompressImageAvifFitCaseCount(): void
    {
        $this->assertCount(3, CompressImageAvifFit::cases());
    }

    public function testCompressImageAvifColorProfileKeepBackingValue(): void
    {
        $enum = CompressImageAvifColorProfile::from('keep');
        $this->assertSame(CompressImageAvifColorProfile::Keep, $enum);
        $this->assertSame('keep', $enum->value);
    }

    public function testCompressImageAvifColorProfileSrgbBackingValue(): void
    {
        $enum = CompressImageAvifColorProfile::from('srgb');
        $this->assertSame(CompressImageAvifColorProfile::Srgb, $enum);
        $this->assertSame('srgb', $enum->value);
    }

    public function testCompressImageAvifColorProfileStripBackingValue(): void
    {
        $enum = CompressImageAvifColorProfile::from('strip');
        $this->assertSame(CompressImageAvifColorProfile::Strip, $enum);
        $this->assertSame('strip', $enum->value);
    }

    public function testCompressImageAvifColorProfileCaseCount(): void
    {
        $this->assertCount(3, CompressImageAvifColorProfile::cases());
    }

    public function testCompressImageAvifOptionsDefaultConstruction(): void
    {
        $obj = new CompressImageAvifOptions();
        $this->assertInstanceOf(CompressImageAvifOptions::class, $obj);
        $this->assertSame(CompressImageAvifEncodingMode::Quality, $obj->encoding_mode);
        $this->assertSame(CompressImageAvifMetadata::Strip, $obj->metadata);
        $this->assertSame(4, $obj->avif_speed);
        $this->assertSame(CompressImageAvifOutputFormat::Original, $obj->output_format);
        $this->assertSame(CompressImageAvifColorProfile::Keep, $obj->color_profile);
        $this->assertSame(true, $obj->auto_orient);
        $this->assertNull($obj->quality);
        $this->assertNull($obj->target_size_bytes);
        $this->assertNull($obj->quality_preset);
        $this->assertNull($obj->width);
        $this->assertNull($obj->height);
        $this->assertNull($obj->fit);
    }

    public function testCompressImageAvifOptionsFullConstruction(): void
    {
        $obj = new CompressImageAvifOptions(
            quality: 1,
            encoding_mode: CompressImageAvifEncodingMode::Quality,
            target_size_bytes: 1024,
            quality_preset: CompressImageAvifQualityPreset::Best,
            metadata: CompressImageAvifMetadata::Strip,
            avif_speed: 1,
            output_format: CompressImageAvifOutputFormat::Original,
            width: 1,
            height: 1,
            fit: CompressImageAvifFit::Max,
            color_profile: CompressImageAvifColorProfile::Keep,
            auto_orient: true,
        );
        $this->assertInstanceOf(CompressImageAvifOptions::class, $obj);
    }

    public function testCompressImageWebpEncodingModeQualityBackingValue(): void
    {
        $enum = CompressImageWebpEncodingMode::from('quality');
        $this->assertSame(CompressImageWebpEncodingMode::Quality, $enum);
        $this->assertSame('quality', $enum->value);
    }

    public function testCompressImageWebpEncodingModeTargetSizeBackingValue(): void
    {
        $enum = CompressImageWebpEncodingMode::from('target_size');
        $this->assertSame(CompressImageWebpEncodingMode::TargetSize, $enum);
        $this->assertSame('target_size', $enum->value);
    }

    public function testCompressImageWebpEncodingModeAutoQualityBackingValue(): void
    {
        $enum = CompressImageWebpEncodingMode::from('auto_quality');
        $this->assertSame(CompressImageWebpEncodingMode::AutoQuality, $enum);
        $this->assertSame('auto_quality', $enum->value);
    }

    public function testCompressImageWebpEncodingModeCaseCount(): void
    {
        $this->assertCount(3, CompressImageWebpEncodingMode::cases());
    }

    public function testCompressImageWebpQualityPresetBestBackingValue(): void
    {
        $enum = CompressImageWebpQualityPreset::from('best');
        $this->assertSame(CompressImageWebpQualityPreset::Best, $enum);
        $this->assertSame('best', $enum->value);
    }

    public function testCompressImageWebpQualityPresetGoodBackingValue(): void
    {
        $enum = CompressImageWebpQualityPreset::from('good');
        $this->assertSame(CompressImageWebpQualityPreset::Good, $enum);
        $this->assertSame('good', $enum->value);
    }

    public function testCompressImageWebpQualityPresetFairBackingValue(): void
    {
        $enum = CompressImageWebpQualityPreset::from('fair');
        $this->assertSame(CompressImageWebpQualityPreset::Fair, $enum);
        $this->assertSame('fair', $enum->value);
    }

    public function testCompressImageWebpQualityPresetLowBackingValue(): void
    {
        $enum = CompressImageWebpQualityPreset::from('low');
        $this->assertSame(CompressImageWebpQualityPreset::Low, $enum);
        $this->assertSame('low', $enum->value);
    }

    public function testCompressImageWebpQualityPresetCaseCount(): void
    {
        $this->assertCount(4, CompressImageWebpQualityPreset::cases());
    }

    public function testCompressImageWebpMetadataStripBackingValue(): void
    {
        $enum = CompressImageWebpMetadata::from('strip');
        $this->assertSame(CompressImageWebpMetadata::Strip, $enum);
        $this->assertSame('strip', $enum->value);
    }

    public function testCompressImageWebpMetadataKeepBackingValue(): void
    {
        $enum = CompressImageWebpMetadata::from('keep');
        $this->assertSame(CompressImageWebpMetadata::Keep, $enum);
        $this->assertSame('keep', $enum->value);
    }

    public function testCompressImageWebpMetadataAllBackingValue(): void
    {
        $enum = CompressImageWebpMetadata::from('all');
        $this->assertSame(CompressImageWebpMetadata::All, $enum);
        $this->assertSame('all', $enum->value);
    }

    public function testCompressImageWebpMetadataCaseCount(): void
    {
        $this->assertCount(3, CompressImageWebpMetadata::cases());
    }

    public function testCompressImageWebpOutputFormatOriginalBackingValue(): void
    {
        $enum = CompressImageWebpOutputFormat::from('original');
        $this->assertSame(CompressImageWebpOutputFormat::Original, $enum);
        $this->assertSame('original', $enum->value);
    }

    public function testCompressImageWebpOutputFormatWebpBackingValue(): void
    {
        $enum = CompressImageWebpOutputFormat::from('webp');
        $this->assertSame(CompressImageWebpOutputFormat::Webp, $enum);
        $this->assertSame('webp', $enum->value);
    }

    public function testCompressImageWebpOutputFormatAutoBackingValue(): void
    {
        $enum = CompressImageWebpOutputFormat::from('auto');
        $this->assertSame(CompressImageWebpOutputFormat::Auto, $enum);
        $this->assertSame('auto', $enum->value);
    }

    public function testCompressImageWebpOutputFormatSmallestBackingValue(): void
    {
        $enum = CompressImageWebpOutputFormat::from('smallest');
        $this->assertSame(CompressImageWebpOutputFormat::Smallest, $enum);
        $this->assertSame('smallest', $enum->value);
    }

    public function testCompressImageWebpOutputFormatCaseCount(): void
    {
        $this->assertCount(4, CompressImageWebpOutputFormat::cases());
    }

    public function testCompressImageWebpFitMaxBackingValue(): void
    {
        $enum = CompressImageWebpFit::from('max');
        $this->assertSame(CompressImageWebpFit::Max, $enum);
        $this->assertSame('max', $enum->value);
    }

    public function testCompressImageWebpFitCropBackingValue(): void
    {
        $enum = CompressImageWebpFit::from('crop');
        $this->assertSame(CompressImageWebpFit::Crop, $enum);
        $this->assertSame('crop', $enum->value);
    }

    public function testCompressImageWebpFitScaleBackingValue(): void
    {
        $enum = CompressImageWebpFit::from('scale');
        $this->assertSame(CompressImageWebpFit::Scale, $enum);
        $this->assertSame('scale', $enum->value);
    }

    public function testCompressImageWebpFitCaseCount(): void
    {
        $this->assertCount(3, CompressImageWebpFit::cases());
    }

    public function testCompressImageWebpColorProfileKeepBackingValue(): void
    {
        $enum = CompressImageWebpColorProfile::from('keep');
        $this->assertSame(CompressImageWebpColorProfile::Keep, $enum);
        $this->assertSame('keep', $enum->value);
    }

    public function testCompressImageWebpColorProfileSrgbBackingValue(): void
    {
        $enum = CompressImageWebpColorProfile::from('srgb');
        $this->assertSame(CompressImageWebpColorProfile::Srgb, $enum);
        $this->assertSame('srgb', $enum->value);
    }

    public function testCompressImageWebpColorProfileStripBackingValue(): void
    {
        $enum = CompressImageWebpColorProfile::from('strip');
        $this->assertSame(CompressImageWebpColorProfile::Strip, $enum);
        $this->assertSame('strip', $enum->value);
    }

    public function testCompressImageWebpColorProfileCaseCount(): void
    {
        $this->assertCount(3, CompressImageWebpColorProfile::cases());
    }

    public function testCompressImageWebpOptionsDefaultConstruction(): void
    {
        $obj = new CompressImageWebpOptions();
        $this->assertInstanceOf(CompressImageWebpOptions::class, $obj);
        $this->assertSame(CompressImageWebpEncodingMode::Quality, $obj->encoding_mode);
        $this->assertSame(CompressImageWebpMetadata::Strip, $obj->metadata);
        $this->assertSame(CompressImageWebpOutputFormat::Original, $obj->output_format);
        $this->assertSame(CompressImageWebpColorProfile::Keep, $obj->color_profile);
        $this->assertSame(true, $obj->auto_orient);
        $this->assertNull($obj->quality);
        $this->assertNull($obj->target_size_bytes);
        $this->assertNull($obj->quality_preset);
        $this->assertNull($obj->lossless);
        $this->assertNull($obj->width);
        $this->assertNull($obj->height);
        $this->assertNull($obj->fit);
    }

    public function testCompressImageWebpOptionsFullConstruction(): void
    {
        $obj = new CompressImageWebpOptions(
            quality: 1,
            encoding_mode: CompressImageWebpEncodingMode::Quality,
            target_size_bytes: 1024,
            quality_preset: CompressImageWebpQualityPreset::Best,
            metadata: CompressImageWebpMetadata::Strip,
            output_format: CompressImageWebpOutputFormat::Original,
            lossless: true,
            width: 1,
            height: 1,
            fit: CompressImageWebpFit::Max,
            color_profile: CompressImageWebpColorProfile::Keep,
            auto_orient: true,
        );
        $this->assertInstanceOf(CompressImageWebpOptions::class, $obj);
    }

    public function testCompressImageSvgMetadataStripBackingValue(): void
    {
        $enum = CompressImageSvgMetadata::from('strip');
        $this->assertSame(CompressImageSvgMetadata::Strip, $enum);
        $this->assertSame('strip', $enum->value);
    }

    public function testCompressImageSvgMetadataAllBackingValue(): void
    {
        $enum = CompressImageSvgMetadata::from('all');
        $this->assertSame(CompressImageSvgMetadata::All, $enum);
        $this->assertSame('all', $enum->value);
    }

    public function testCompressImageSvgMetadataCaseCount(): void
    {
        $this->assertCount(2, CompressImageSvgMetadata::cases());
    }

    public function testCompressImageSvgOutputFormatOriginalBackingValue(): void
    {
        $enum = CompressImageSvgOutputFormat::from('original');
        $this->assertSame(CompressImageSvgOutputFormat::Original, $enum);
        $this->assertSame('original', $enum->value);
    }

    public function testCompressImageSvgOutputFormatWebpBackingValue(): void
    {
        $enum = CompressImageSvgOutputFormat::from('webp');
        $this->assertSame(CompressImageSvgOutputFormat::Webp, $enum);
        $this->assertSame('webp', $enum->value);
    }

    public function testCompressImageSvgOutputFormatAutoBackingValue(): void
    {
        $enum = CompressImageSvgOutputFormat::from('auto');
        $this->assertSame(CompressImageSvgOutputFormat::Auto, $enum);
        $this->assertSame('auto', $enum->value);
    }

    public function testCompressImageSvgOutputFormatSmallestBackingValue(): void
    {
        $enum = CompressImageSvgOutputFormat::from('smallest');
        $this->assertSame(CompressImageSvgOutputFormat::Smallest, $enum);
        $this->assertSame('smallest', $enum->value);
    }

    public function testCompressImageSvgOutputFormatCaseCount(): void
    {
        $this->assertCount(4, CompressImageSvgOutputFormat::cases());
    }

    public function testCompressImageSvgOptionsDefaultConstruction(): void
    {
        $obj = new CompressImageSvgOptions();
        $this->assertInstanceOf(CompressImageSvgOptions::class, $obj);
        $this->assertSame(CompressImageSvgMetadata::Strip, $obj->metadata);
        $this->assertSame(CompressImageSvgOutputFormat::Original, $obj->output_format);
    }

    public function testCompressImageSvgOptionsFullConstruction(): void
    {
        $obj = new CompressImageSvgOptions(
            metadata: CompressImageSvgMetadata::Strip,
            output_format: CompressImageSvgOutputFormat::Original,
        );
        $this->assertInstanceOf(CompressImageSvgOptions::class, $obj);
    }

    public function testCompressImageMetadataStripBackingValue(): void
    {
        $enum = CompressImageMetadata::from('strip');
        $this->assertSame(CompressImageMetadata::Strip, $enum);
        $this->assertSame('strip', $enum->value);
    }

    public function testCompressImageMetadataKeepBackingValue(): void
    {
        $enum = CompressImageMetadata::from('keep');
        $this->assertSame(CompressImageMetadata::Keep, $enum);
        $this->assertSame('keep', $enum->value);
    }

    public function testCompressImageMetadataAllBackingValue(): void
    {
        $enum = CompressImageMetadata::from('all');
        $this->assertSame(CompressImageMetadata::All, $enum);
        $this->assertSame('all', $enum->value);
    }

    public function testCompressImageMetadataCaseCount(): void
    {
        $this->assertCount(3, CompressImageMetadata::cases());
    }

    public function testCompressImageOutputFormatOriginalBackingValue(): void
    {
        $enum = CompressImageOutputFormat::from('original');
        $this->assertSame(CompressImageOutputFormat::Original, $enum);
        $this->assertSame('original', $enum->value);
    }

    public function testCompressImageOutputFormatWebpBackingValue(): void
    {
        $enum = CompressImageOutputFormat::from('webp');
        $this->assertSame(CompressImageOutputFormat::Webp, $enum);
        $this->assertSame('webp', $enum->value);
    }

    public function testCompressImageOutputFormatAutoBackingValue(): void
    {
        $enum = CompressImageOutputFormat::from('auto');
        $this->assertSame(CompressImageOutputFormat::Auto, $enum);
        $this->assertSame('auto', $enum->value);
    }

    public function testCompressImageOutputFormatSmallestBackingValue(): void
    {
        $enum = CompressImageOutputFormat::from('smallest');
        $this->assertSame(CompressImageOutputFormat::Smallest, $enum);
        $this->assertSame('smallest', $enum->value);
    }

    public function testCompressImageOutputFormatCaseCount(): void
    {
        $this->assertCount(4, CompressImageOutputFormat::cases());
    }

    public function testCompressImageFitMaxBackingValue(): void
    {
        $enum = CompressImageFit::from('max');
        $this->assertSame(CompressImageFit::Max, $enum);
        $this->assertSame('max', $enum->value);
    }

    public function testCompressImageFitCropBackingValue(): void
    {
        $enum = CompressImageFit::from('crop');
        $this->assertSame(CompressImageFit::Crop, $enum);
        $this->assertSame('crop', $enum->value);
    }

    public function testCompressImageFitScaleBackingValue(): void
    {
        $enum = CompressImageFit::from('scale');
        $this->assertSame(CompressImageFit::Scale, $enum);
        $this->assertSame('scale', $enum->value);
    }

    public function testCompressImageFitCaseCount(): void
    {
        $this->assertCount(3, CompressImageFit::cases());
    }

    public function testCompressImageColorProfileKeepBackingValue(): void
    {
        $enum = CompressImageColorProfile::from('keep');
        $this->assertSame(CompressImageColorProfile::Keep, $enum);
        $this->assertSame('keep', $enum->value);
    }

    public function testCompressImageColorProfileSrgbBackingValue(): void
    {
        $enum = CompressImageColorProfile::from('srgb');
        $this->assertSame(CompressImageColorProfile::Srgb, $enum);
        $this->assertSame('srgb', $enum->value);
    }

    public function testCompressImageColorProfileStripBackingValue(): void
    {
        $enum = CompressImageColorProfile::from('strip');
        $this->assertSame(CompressImageColorProfile::Strip, $enum);
        $this->assertSame('strip', $enum->value);
    }

    public function testCompressImageColorProfileCaseCount(): void
    {
        $this->assertCount(3, CompressImageColorProfile::cases());
    }

    public function testCompressImageOptionsDefaultConstruction(): void
    {
        $obj = new CompressImageOptions();
        $this->assertInstanceOf(CompressImageOptions::class, $obj);
        $this->assertSame(80, $obj->quality);
        $this->assertSame(CompressImageMetadata::Strip, $obj->metadata);
        $this->assertSame(CompressImageOutputFormat::Original, $obj->output_format);
        $this->assertSame(CompressImageColorProfile::Keep, $obj->color_profile);
        $this->assertSame(true, $obj->auto_orient);
        $this->assertNull($obj->width);
        $this->assertNull($obj->height);
        $this->assertNull($obj->fit);
    }

    public function testCompressImageOptionsFullConstruction(): void
    {
        $obj = new CompressImageOptions(
            quality: 1,
            metadata: CompressImageMetadata::Strip,
            output_format: CompressImageOutputFormat::Original,
            width: 1,
            height: 1,
            fit: CompressImageFit::Max,
            color_profile: CompressImageColorProfile::Keep,
            auto_orient: true,
        );
        $this->assertInstanceOf(CompressImageOptions::class, $obj);
    }

    public function testCompressAudioOutputFormatOriginalBackingValue(): void
    {
        $enum = CompressAudioOutputFormat::from('original');
        $this->assertSame(CompressAudioOutputFormat::Original, $enum);
        $this->assertSame('original', $enum->value);
    }

    public function testCompressAudioOutputFormatMp3BackingValue(): void
    {
        $enum = CompressAudioOutputFormat::from('mp3');
        $this->assertSame(CompressAudioOutputFormat::Mp3, $enum);
        $this->assertSame('mp3', $enum->value);
    }

    public function testCompressAudioOutputFormatAacBackingValue(): void
    {
        $enum = CompressAudioOutputFormat::from('aac');
        $this->assertSame(CompressAudioOutputFormat::Aac, $enum);
        $this->assertSame('aac', $enum->value);
    }

    public function testCompressAudioOutputFormatOggBackingValue(): void
    {
        $enum = CompressAudioOutputFormat::from('ogg');
        $this->assertSame(CompressAudioOutputFormat::Ogg, $enum);
        $this->assertSame('ogg', $enum->value);
    }

    public function testCompressAudioOutputFormatOpusBackingValue(): void
    {
        $enum = CompressAudioOutputFormat::from('opus');
        $this->assertSame(CompressAudioOutputFormat::Opus, $enum);
        $this->assertSame('opus', $enum->value);
    }

    public function testCompressAudioOutputFormatFlacBackingValue(): void
    {
        $enum = CompressAudioOutputFormat::from('flac');
        $this->assertSame(CompressAudioOutputFormat::Flac, $enum);
        $this->assertSame('flac', $enum->value);
    }

    public function testCompressAudioOutputFormatWavBackingValue(): void
    {
        $enum = CompressAudioOutputFormat::from('wav');
        $this->assertSame(CompressAudioOutputFormat::Wav, $enum);
        $this->assertSame('wav', $enum->value);
    }

    public function testCompressAudioOutputFormatCaseCount(): void
    {
        $this->assertCount(7, CompressAudioOutputFormat::cases());
    }

    public function testCompressAudioBitrate_64BackingValue(): void
    {
        $enum = CompressAudioBitrate::from(64);
        $this->assertSame(CompressAudioBitrate::_64, $enum);
        $this->assertSame(64, $enum->value);
    }

    public function testCompressAudioBitrate_96BackingValue(): void
    {
        $enum = CompressAudioBitrate::from(96);
        $this->assertSame(CompressAudioBitrate::_96, $enum);
        $this->assertSame(96, $enum->value);
    }

    public function testCompressAudioBitrate_128BackingValue(): void
    {
        $enum = CompressAudioBitrate::from(128);
        $this->assertSame(CompressAudioBitrate::_128, $enum);
        $this->assertSame(128, $enum->value);
    }

    public function testCompressAudioBitrate_192BackingValue(): void
    {
        $enum = CompressAudioBitrate::from(192);
        $this->assertSame(CompressAudioBitrate::_192, $enum);
        $this->assertSame(192, $enum->value);
    }

    public function testCompressAudioBitrate_256BackingValue(): void
    {
        $enum = CompressAudioBitrate::from(256);
        $this->assertSame(CompressAudioBitrate::_256, $enum);
        $this->assertSame(256, $enum->value);
    }

    public function testCompressAudioBitrate_320BackingValue(): void
    {
        $enum = CompressAudioBitrate::from(320);
        $this->assertSame(CompressAudioBitrate::_320, $enum);
        $this->assertSame(320, $enum->value);
    }

    public function testCompressAudioBitrateCaseCount(): void
    {
        $this->assertCount(6, CompressAudioBitrate::cases());
    }

    public function testCompressAudioSampleRate_22050BackingValue(): void
    {
        $enum = CompressAudioSampleRate::from(22050);
        $this->assertSame(CompressAudioSampleRate::_22050, $enum);
        $this->assertSame(22050, $enum->value);
    }

    public function testCompressAudioSampleRate_44100BackingValue(): void
    {
        $enum = CompressAudioSampleRate::from(44100);
        $this->assertSame(CompressAudioSampleRate::_44100, $enum);
        $this->assertSame(44100, $enum->value);
    }

    public function testCompressAudioSampleRate_48000BackingValue(): void
    {
        $enum = CompressAudioSampleRate::from(48000);
        $this->assertSame(CompressAudioSampleRate::_48000, $enum);
        $this->assertSame(48000, $enum->value);
    }

    public function testCompressAudioSampleRateCaseCount(): void
    {
        $this->assertCount(3, CompressAudioSampleRate::cases());
    }

    public function testCompressAudioOptionsDefaultConstruction(): void
    {
        $obj = new CompressAudioOptions();
        $this->assertInstanceOf(CompressAudioOptions::class, $obj);
        $this->assertSame(CompressAudioOutputFormat::Original, $obj->output_format);
        $this->assertSame(CompressAudioBitrate::_128, $obj->bitrate);
        $this->assertSame(false, $obj->normalize);
        $this->assertNull($obj->channels);
        $this->assertNull($obj->sample_rate);
        $this->assertNull($obj->trim_start);
        $this->assertNull($obj->trim_end);
    }

    public function testCompressAudioOptionsFullConstruction(): void
    {
        $obj = new CompressAudioOptions(
            output_format: CompressAudioOutputFormat::Original,
            bitrate: CompressAudioBitrate::_64,
            channels: 1,
            sample_rate: CompressAudioSampleRate::_22050,
            normalize: true,
            trim_start: 0.0,
            trim_end: 0.0,
        );
        $this->assertInstanceOf(CompressAudioOptions::class, $obj);
    }

    public function testCompressVideoOutputFormatOriginalBackingValue(): void
    {
        $enum = CompressVideoOutputFormat::from('original');
        $this->assertSame(CompressVideoOutputFormat::Original, $enum);
        $this->assertSame('original', $enum->value);
    }

    public function testCompressVideoOutputFormatMp4BackingValue(): void
    {
        $enum = CompressVideoOutputFormat::from('mp4');
        $this->assertSame(CompressVideoOutputFormat::Mp4, $enum);
        $this->assertSame('mp4', $enum->value);
    }

    public function testCompressVideoOutputFormatWebmBackingValue(): void
    {
        $enum = CompressVideoOutputFormat::from('webm');
        $this->assertSame(CompressVideoOutputFormat::Webm, $enum);
        $this->assertSame('webm', $enum->value);
    }

    public function testCompressVideoOutputFormatOggBackingValue(): void
    {
        $enum = CompressVideoOutputFormat::from('ogg');
        $this->assertSame(CompressVideoOutputFormat::Ogg, $enum);
        $this->assertSame('ogg', $enum->value);
    }

    public function testCompressVideoOutputFormatCaseCount(): void
    {
        $this->assertCount(4, CompressVideoOutputFormat::cases());
    }

    public function testCompressVideoCodecH264BackingValue(): void
    {
        $enum = CompressVideoCodec::from('h264');
        $this->assertSame(CompressVideoCodec::H264, $enum);
        $this->assertSame('h264', $enum->value);
    }

    public function testCompressVideoCodecH265BackingValue(): void
    {
        $enum = CompressVideoCodec::from('h265');
        $this->assertSame(CompressVideoCodec::H265, $enum);
        $this->assertSame('h265', $enum->value);
    }

    public function testCompressVideoCodecVp9BackingValue(): void
    {
        $enum = CompressVideoCodec::from('vp9');
        $this->assertSame(CompressVideoCodec::Vp9, $enum);
        $this->assertSame('vp9', $enum->value);
    }

    public function testCompressVideoCodecAv1BackingValue(): void
    {
        $enum = CompressVideoCodec::from('av1');
        $this->assertSame(CompressVideoCodec::Av1, $enum);
        $this->assertSame('av1', $enum->value);
    }

    public function testCompressVideoCodecCaseCount(): void
    {
        $this->assertCount(4, CompressVideoCodec::cases());
    }

    public function testCompressVideoEncodingModeCrfBackingValue(): void
    {
        $enum = CompressVideoEncodingMode::from('crf');
        $this->assertSame(CompressVideoEncodingMode::Crf, $enum);
        $this->assertSame('crf', $enum->value);
    }

    public function testCompressVideoEncodingModeTargetSizeBackingValue(): void
    {
        $enum = CompressVideoEncodingMode::from('target_size');
        $this->assertSame(CompressVideoEncodingMode::TargetSize, $enum);
        $this->assertSame('target_size', $enum->value);
    }

    public function testCompressVideoEncodingModeCaseCount(): void
    {
        $this->assertCount(2, CompressVideoEncodingMode::cases());
    }

    public function testCompressVideoPresetUltrafastBackingValue(): void
    {
        $enum = CompressVideoPreset::from('ultrafast');
        $this->assertSame(CompressVideoPreset::Ultrafast, $enum);
        $this->assertSame('ultrafast', $enum->value);
    }

    public function testCompressVideoPresetSuperfastBackingValue(): void
    {
        $enum = CompressVideoPreset::from('superfast');
        $this->assertSame(CompressVideoPreset::Superfast, $enum);
        $this->assertSame('superfast', $enum->value);
    }

    public function testCompressVideoPresetVeryfastBackingValue(): void
    {
        $enum = CompressVideoPreset::from('veryfast');
        $this->assertSame(CompressVideoPreset::Veryfast, $enum);
        $this->assertSame('veryfast', $enum->value);
    }

    public function testCompressVideoPresetFasterBackingValue(): void
    {
        $enum = CompressVideoPreset::from('faster');
        $this->assertSame(CompressVideoPreset::Faster, $enum);
        $this->assertSame('faster', $enum->value);
    }

    public function testCompressVideoPresetFastBackingValue(): void
    {
        $enum = CompressVideoPreset::from('fast');
        $this->assertSame(CompressVideoPreset::Fast, $enum);
        $this->assertSame('fast', $enum->value);
    }

    public function testCompressVideoPresetMediumBackingValue(): void
    {
        $enum = CompressVideoPreset::from('medium');
        $this->assertSame(CompressVideoPreset::Medium, $enum);
        $this->assertSame('medium', $enum->value);
    }

    public function testCompressVideoPresetSlowBackingValue(): void
    {
        $enum = CompressVideoPreset::from('slow');
        $this->assertSame(CompressVideoPreset::Slow, $enum);
        $this->assertSame('slow', $enum->value);
    }

    public function testCompressVideoPresetSlowerBackingValue(): void
    {
        $enum = CompressVideoPreset::from('slower');
        $this->assertSame(CompressVideoPreset::Slower, $enum);
        $this->assertSame('slower', $enum->value);
    }

    public function testCompressVideoPresetVeryslowBackingValue(): void
    {
        $enum = CompressVideoPreset::from('veryslow');
        $this->assertSame(CompressVideoPreset::Veryslow, $enum);
        $this->assertSame('veryslow', $enum->value);
    }

    public function testCompressVideoPresetCaseCount(): void
    {
        $this->assertCount(9, CompressVideoPreset::cases());
    }

    public function testCompressVideoFitMaxBackingValue(): void
    {
        $enum = CompressVideoFit::from('max');
        $this->assertSame(CompressVideoFit::Max, $enum);
        $this->assertSame('max', $enum->value);
    }

    public function testCompressVideoFitCropBackingValue(): void
    {
        $enum = CompressVideoFit::from('crop');
        $this->assertSame(CompressVideoFit::Crop, $enum);
        $this->assertSame('crop', $enum->value);
    }

    public function testCompressVideoFitScaleBackingValue(): void
    {
        $enum = CompressVideoFit::from('scale');
        $this->assertSame(CompressVideoFit::Scale, $enum);
        $this->assertSame('scale', $enum->value);
    }

    public function testCompressVideoFitPadBackingValue(): void
    {
        $enum = CompressVideoFit::from('pad');
        $this->assertSame(CompressVideoFit::Pad, $enum);
        $this->assertSame('pad', $enum->value);
    }

    public function testCompressVideoFitCaseCount(): void
    {
        $this->assertCount(4, CompressVideoFit::cases());
    }

    public function testCompressVideoAudioCodecAacBackingValue(): void
    {
        $enum = CompressVideoAudioCodec::from('aac');
        $this->assertSame(CompressVideoAudioCodec::Aac, $enum);
        $this->assertSame('aac', $enum->value);
    }

    public function testCompressVideoAudioCodecOpusBackingValue(): void
    {
        $enum = CompressVideoAudioCodec::from('opus');
        $this->assertSame(CompressVideoAudioCodec::Opus, $enum);
        $this->assertSame('opus', $enum->value);
    }

    public function testCompressVideoAudioCodecVorbisBackingValue(): void
    {
        $enum = CompressVideoAudioCodec::from('vorbis');
        $this->assertSame(CompressVideoAudioCodec::Vorbis, $enum);
        $this->assertSame('vorbis', $enum->value);
    }

    public function testCompressVideoAudioCodecCopyBackingValue(): void
    {
        $enum = CompressVideoAudioCodec::from('copy');
        $this->assertSame(CompressVideoAudioCodec::Copy, $enum);
        $this->assertSame('copy', $enum->value);
    }

    public function testCompressVideoAudioCodecCaseCount(): void
    {
        $this->assertCount(4, CompressVideoAudioCodec::cases());
    }

    public function testCompressVideoAudioBitrate_64BackingValue(): void
    {
        $enum = CompressVideoAudioBitrate::from(64);
        $this->assertSame(CompressVideoAudioBitrate::_64, $enum);
        $this->assertSame(64, $enum->value);
    }

    public function testCompressVideoAudioBitrate_96BackingValue(): void
    {
        $enum = CompressVideoAudioBitrate::from(96);
        $this->assertSame(CompressVideoAudioBitrate::_96, $enum);
        $this->assertSame(96, $enum->value);
    }

    public function testCompressVideoAudioBitrate_128BackingValue(): void
    {
        $enum = CompressVideoAudioBitrate::from(128);
        $this->assertSame(CompressVideoAudioBitrate::_128, $enum);
        $this->assertSame(128, $enum->value);
    }

    public function testCompressVideoAudioBitrate_192BackingValue(): void
    {
        $enum = CompressVideoAudioBitrate::from(192);
        $this->assertSame(CompressVideoAudioBitrate::_192, $enum);
        $this->assertSame(192, $enum->value);
    }

    public function testCompressVideoAudioBitrate_256BackingValue(): void
    {
        $enum = CompressVideoAudioBitrate::from(256);
        $this->assertSame(CompressVideoAudioBitrate::_256, $enum);
        $this->assertSame(256, $enum->value);
    }

    public function testCompressVideoAudioBitrate_320BackingValue(): void
    {
        $enum = CompressVideoAudioBitrate::from(320);
        $this->assertSame(CompressVideoAudioBitrate::_320, $enum);
        $this->assertSame(320, $enum->value);
    }

    public function testCompressVideoAudioBitrateCaseCount(): void
    {
        $this->assertCount(6, CompressVideoAudioBitrate::cases());
    }

    public function testCompressVideoOptionsDefaultConstruction(): void
    {
        $obj = new CompressVideoOptions();
        $this->assertInstanceOf(CompressVideoOptions::class, $obj);
        $this->assertSame(CompressVideoOutputFormat::Original, $obj->output_format);
        $this->assertSame(CompressVideoCodec::H264, $obj->codec);
        $this->assertSame(CompressVideoEncodingMode::Crf, $obj->encoding_mode);
        $this->assertSame(CompressVideoPreset::Medium, $obj->preset);
        $this->assertSame(true, $obj->faststart);
        $this->assertSame(CompressVideoAudioCodec::Copy, $obj->audio_codec);
        $this->assertSame(1.0, $obj->speed);
        $this->assertNull($obj->crf);
        $this->assertNull($obj->target_size_bytes);
        $this->assertNull($obj->width);
        $this->assertNull($obj->height);
        $this->assertNull($obj->fit);
        $this->assertNull($obj->fps);
        $this->assertNull($obj->audio_bitrate);
        $this->assertNull($obj->trim_start);
        $this->assertNull($obj->trim_end);
    }

    public function testCompressVideoOptionsFullConstruction(): void
    {
        $obj = new CompressVideoOptions(
            output_format: CompressVideoOutputFormat::Original,
            codec: CompressVideoCodec::H264,
            encoding_mode: CompressVideoEncodingMode::Crf,
            crf: 0,
            target_size_bytes: 1048576,
            preset: CompressVideoPreset::Ultrafast,
            width: 2,
            height: 2,
            fit: CompressVideoFit::Max,
            fps: 1.0,
            faststart: true,
            audio_codec: CompressVideoAudioCodec::Aac,
            audio_bitrate: CompressVideoAudioBitrate::_64,
            trim_start: 0.0,
            trim_end: 0.0,
            speed: 0.25,
        );
        $this->assertInstanceOf(CompressVideoOptions::class, $obj);
    }

    public function testCompressDocumentOfficeOptionsDefaultConstruction(): void
    {
        $obj = new CompressDocumentOfficeOptions();
        $this->assertInstanceOf(CompressDocumentOfficeOptions::class, $obj);
        $this->assertSame(50, $obj->quality);
        $this->assertSame(true, $obj->strip_macros);
        $this->assertSame(true, $obj->strip_hidden_data);
        $this->assertSame(false, $obj->strip_unused_fonts);
    }

    public function testCompressDocumentOfficeOptionsFullConstruction(): void
    {
        $obj = new CompressDocumentOfficeOptions(
            quality: 1,
            strip_macros: true,
            strip_hidden_data: true,
            strip_unused_fonts: true,
        );
        $this->assertInstanceOf(CompressDocumentOfficeOptions::class, $obj);
    }

    public function testCompressDocumentOdfOptionsDefaultConstruction(): void
    {
        $obj = new CompressDocumentOdfOptions();
        $this->assertInstanceOf(CompressDocumentOdfOptions::class, $obj);
        $this->assertSame(50, $obj->quality);
        $this->assertSame(true, $obj->strip_metadata);
        $this->assertSame(false, $obj->strip_unused_styles);
    }

    public function testCompressDocumentOdfOptionsFullConstruction(): void
    {
        $obj = new CompressDocumentOdfOptions(
            quality: 1,
            strip_metadata: true,
            strip_unused_styles: true,
        );
        $this->assertInstanceOf(CompressDocumentOdfOptions::class, $obj);
    }

    public function testCompressDocumentEpubOptionsDefaultConstruction(): void
    {
        $obj = new CompressDocumentEpubOptions();
        $this->assertInstanceOf(CompressDocumentEpubOptions::class, $obj);
        $this->assertSame(50, $obj->quality);
        $this->assertSame(true, $obj->font_subsetting);
        $this->assertSame(false, $obj->strip_unused_css);
    }

    public function testCompressDocumentEpubOptionsFullConstruction(): void
    {
        $obj = new CompressDocumentEpubOptions(
            quality: 1,
            font_subsetting: true,
            strip_unused_css: true,
        );
        $this->assertInstanceOf(CompressDocumentEpubOptions::class, $obj);
    }

}
