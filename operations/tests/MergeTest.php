<?php

// Auto-generated -- do not edit

declare(strict_types=1);

namespace Gisl\Generated\Operations\Tests;

use PHPUnit\Framework\TestCase;
use Gisl\Generated\Operations\MergeAudioOptions;
use Gisl\Generated\Operations\MergeAudioOutputType;
use Gisl\Generated\Operations\MergeAudioPerInputOptions;
use Gisl\Generated\Operations\MergeAudioTransition;
use Gisl\Generated\Operations\MergeImageOptions;
use Gisl\Generated\Operations\MergeImageOutputType;
use Gisl\Generated\Operations\MergeImageTransition;
use Gisl\Generated\Operations\MergeImageVideoFormat;
use Gisl\Generated\Operations\MergeVideoCodec;
use Gisl\Generated\Operations\MergeVideoEncodingMode;
use Gisl\Generated\Operations\MergeVideoOptions;
use Gisl\Generated\Operations\MergeVideoOutputType;
use Gisl\Generated\Operations\MergeVideoPerInputOptions;
use Gisl\Generated\Operations\MergeVideoPreset;
use Gisl\Generated\Operations\MergeVideoReEncodeMode;
use Gisl\Generated\Operations\MergeVideoTransition;

final class MergeTest extends TestCase
{
    public function testMergeImageOutputTypeGifBackingValue(): void
    {
        $enum = MergeImageOutputType::from('gif');
        $this->assertSame(MergeImageOutputType::Gif, $enum);
        $this->assertSame('gif', $enum->value);
    }

    public function testMergeImageOutputTypeVideoBackingValue(): void
    {
        $enum = MergeImageOutputType::from('video');
        $this->assertSame(MergeImageOutputType::Video, $enum);
        $this->assertSame('video', $enum->value);
    }

    public function testMergeImageOutputTypeCaseCount(): void
    {
        $this->assertCount(2, MergeImageOutputType::cases());
    }

    public function testMergeImageTransitionNoneBackingValue(): void
    {
        $enum = MergeImageTransition::from('none');
        $this->assertSame(MergeImageTransition::None, $enum);
        $this->assertSame('none', $enum->value);
    }

    public function testMergeImageTransitionFadeBackingValue(): void
    {
        $enum = MergeImageTransition::from('fade');
        $this->assertSame(MergeImageTransition::Fade, $enum);
        $this->assertSame('fade', $enum->value);
    }

    public function testMergeImageTransitionFadeblackBackingValue(): void
    {
        $enum = MergeImageTransition::from('fadeblack');
        $this->assertSame(MergeImageTransition::Fadeblack, $enum);
        $this->assertSame('fadeblack', $enum->value);
    }

    public function testMergeImageTransitionFadewhiteBackingValue(): void
    {
        $enum = MergeImageTransition::from('fadewhite');
        $this->assertSame(MergeImageTransition::Fadewhite, $enum);
        $this->assertSame('fadewhite', $enum->value);
    }

    public function testMergeImageTransitionDissolveBackingValue(): void
    {
        $enum = MergeImageTransition::from('dissolve');
        $this->assertSame(MergeImageTransition::Dissolve, $enum);
        $this->assertSame('dissolve', $enum->value);
    }

    public function testMergeImageTransitionWipeleftBackingValue(): void
    {
        $enum = MergeImageTransition::from('wipeleft');
        $this->assertSame(MergeImageTransition::Wipeleft, $enum);
        $this->assertSame('wipeleft', $enum->value);
    }

    public function testMergeImageTransitionWiperightBackingValue(): void
    {
        $enum = MergeImageTransition::from('wiperight');
        $this->assertSame(MergeImageTransition::Wiperight, $enum);
        $this->assertSame('wiperight', $enum->value);
    }

    public function testMergeImageTransitionWipeupBackingValue(): void
    {
        $enum = MergeImageTransition::from('wipeup');
        $this->assertSame(MergeImageTransition::Wipeup, $enum);
        $this->assertSame('wipeup', $enum->value);
    }

    public function testMergeImageTransitionWipedownBackingValue(): void
    {
        $enum = MergeImageTransition::from('wipedown');
        $this->assertSame(MergeImageTransition::Wipedown, $enum);
        $this->assertSame('wipedown', $enum->value);
    }

    public function testMergeImageTransitionCrossfadeBackingValue(): void
    {
        $enum = MergeImageTransition::from('crossfade');
        $this->assertSame(MergeImageTransition::Crossfade, $enum);
        $this->assertSame('crossfade', $enum->value);
    }

    public function testMergeImageTransitionSmoothleftBackingValue(): void
    {
        $enum = MergeImageTransition::from('smoothleft');
        $this->assertSame(MergeImageTransition::Smoothleft, $enum);
        $this->assertSame('smoothleft', $enum->value);
    }

    public function testMergeImageTransitionSmoothrightBackingValue(): void
    {
        $enum = MergeImageTransition::from('smoothright');
        $this->assertSame(MergeImageTransition::Smoothright, $enum);
        $this->assertSame('smoothright', $enum->value);
    }

    public function testMergeImageTransitionSmoothupBackingValue(): void
    {
        $enum = MergeImageTransition::from('smoothup');
        $this->assertSame(MergeImageTransition::Smoothup, $enum);
        $this->assertSame('smoothup', $enum->value);
    }

    public function testMergeImageTransitionSmoothdownBackingValue(): void
    {
        $enum = MergeImageTransition::from('smoothdown');
        $this->assertSame(MergeImageTransition::Smoothdown, $enum);
        $this->assertSame('smoothdown', $enum->value);
    }

    public function testMergeImageTransitionCircleopenBackingValue(): void
    {
        $enum = MergeImageTransition::from('circleopen');
        $this->assertSame(MergeImageTransition::Circleopen, $enum);
        $this->assertSame('circleopen', $enum->value);
    }

    public function testMergeImageTransitionCirclecloseBackingValue(): void
    {
        $enum = MergeImageTransition::from('circleclose');
        $this->assertSame(MergeImageTransition::Circleclose, $enum);
        $this->assertSame('circleclose', $enum->value);
    }

    public function testMergeImageTransitionCirclecropBackingValue(): void
    {
        $enum = MergeImageTransition::from('circlecrop');
        $this->assertSame(MergeImageTransition::Circlecrop, $enum);
        $this->assertSame('circlecrop', $enum->value);
    }

    public function testMergeImageTransitionRectcropBackingValue(): void
    {
        $enum = MergeImageTransition::from('rectcrop');
        $this->assertSame(MergeImageTransition::Rectcrop, $enum);
        $this->assertSame('rectcrop', $enum->value);
    }

    public function testMergeImageTransitionSlideleftBackingValue(): void
    {
        $enum = MergeImageTransition::from('slideleft');
        $this->assertSame(MergeImageTransition::Slideleft, $enum);
        $this->assertSame('slideleft', $enum->value);
    }

    public function testMergeImageTransitionSliderightBackingValue(): void
    {
        $enum = MergeImageTransition::from('slideright');
        $this->assertSame(MergeImageTransition::Slideright, $enum);
        $this->assertSame('slideright', $enum->value);
    }

    public function testMergeImageTransitionSlideupBackingValue(): void
    {
        $enum = MergeImageTransition::from('slideup');
        $this->assertSame(MergeImageTransition::Slideup, $enum);
        $this->assertSame('slideup', $enum->value);
    }

    public function testMergeImageTransitionSlidedownBackingValue(): void
    {
        $enum = MergeImageTransition::from('slidedown');
        $this->assertSame(MergeImageTransition::Slidedown, $enum);
        $this->assertSame('slidedown', $enum->value);
    }

    public function testMergeImageTransitionRadialBackingValue(): void
    {
        $enum = MergeImageTransition::from('radial');
        $this->assertSame(MergeImageTransition::Radial, $enum);
        $this->assertSame('radial', $enum->value);
    }

    public function testMergeImageTransitionDiagtlBackingValue(): void
    {
        $enum = MergeImageTransition::from('diagtl');
        $this->assertSame(MergeImageTransition::Diagtl, $enum);
        $this->assertSame('diagtl', $enum->value);
    }

    public function testMergeImageTransitionDiagtrBackingValue(): void
    {
        $enum = MergeImageTransition::from('diagtr');
        $this->assertSame(MergeImageTransition::Diagtr, $enum);
        $this->assertSame('diagtr', $enum->value);
    }

    public function testMergeImageTransitionDiagblBackingValue(): void
    {
        $enum = MergeImageTransition::from('diagbl');
        $this->assertSame(MergeImageTransition::Diagbl, $enum);
        $this->assertSame('diagbl', $enum->value);
    }

    public function testMergeImageTransitionPixelizeBackingValue(): void
    {
        $enum = MergeImageTransition::from('pixelize');
        $this->assertSame(MergeImageTransition::Pixelize, $enum);
        $this->assertSame('pixelize', $enum->value);
    }

    public function testMergeImageTransitionHlsliceBackingValue(): void
    {
        $enum = MergeImageTransition::from('hlslice');
        $this->assertSame(MergeImageTransition::Hlslice, $enum);
        $this->assertSame('hlslice', $enum->value);
    }

    public function testMergeImageTransitionVlsliceBackingValue(): void
    {
        $enum = MergeImageTransition::from('vlslice');
        $this->assertSame(MergeImageTransition::Vlslice, $enum);
        $this->assertSame('vlslice', $enum->value);
    }

    public function testMergeImageTransitionHblurBackingValue(): void
    {
        $enum = MergeImageTransition::from('hblur');
        $this->assertSame(MergeImageTransition::Hblur, $enum);
        $this->assertSame('hblur', $enum->value);
    }

    public function testMergeImageTransitionDistanceBackingValue(): void
    {
        $enum = MergeImageTransition::from('distance');
        $this->assertSame(MergeImageTransition::Distance, $enum);
        $this->assertSame('distance', $enum->value);
    }

    public function testMergeImageTransitionSqueezehBackingValue(): void
    {
        $enum = MergeImageTransition::from('squeezeh');
        $this->assertSame(MergeImageTransition::Squeezeh, $enum);
        $this->assertSame('squeezeh', $enum->value);
    }

    public function testMergeImageTransitionCustomBackingValue(): void
    {
        $enum = MergeImageTransition::from('custom');
        $this->assertSame(MergeImageTransition::Custom, $enum);
        $this->assertSame('custom', $enum->value);
    }

    public function testMergeImageTransitionWipetlBackingValue(): void
    {
        $enum = MergeImageTransition::from('wipetl');
        $this->assertSame(MergeImageTransition::Wipetl, $enum);
        $this->assertSame('wipetl', $enum->value);
    }

    public function testMergeImageTransitionWipetrBackingValue(): void
    {
        $enum = MergeImageTransition::from('wipetr');
        $this->assertSame(MergeImageTransition::Wipetr, $enum);
        $this->assertSame('wipetr', $enum->value);
    }

    public function testMergeImageTransitionWipeblBackingValue(): void
    {
        $enum = MergeImageTransition::from('wipebl');
        $this->assertSame(MergeImageTransition::Wipebl, $enum);
        $this->assertSame('wipebl', $enum->value);
    }

    public function testMergeImageTransitionCaseCount(): void
    {
        $this->assertCount(36, MergeImageTransition::cases());
    }

    public function testMergeImageVideoFormatMp4BackingValue(): void
    {
        $enum = MergeImageVideoFormat::from('mp4');
        $this->assertSame(MergeImageVideoFormat::Mp4, $enum);
        $this->assertSame('mp4', $enum->value);
    }

    public function testMergeImageVideoFormatWebmBackingValue(): void
    {
        $enum = MergeImageVideoFormat::from('webm');
        $this->assertSame(MergeImageVideoFormat::Webm, $enum);
        $this->assertSame('webm', $enum->value);
    }

    public function testMergeImageVideoFormatCaseCount(): void
    {
        $this->assertCount(2, MergeImageVideoFormat::cases());
    }

    public function testMergeImageOptionsDefaultConstruction(): void
    {
        $obj = new MergeImageOptions(
            output_type: MergeImageOutputType::Gif,
        );
        $this->assertInstanceOf(MergeImageOptions::class, $obj);
        $this->assertNull($obj->delay);
        $this->assertNull($obj->loop_count);
        $this->assertNull($obj->duration_per_image);
        $this->assertNull($obj->transition);
        $this->assertNull($obj->transition_duration);
        $this->assertNull($obj->fps);
        $this->assertNull($obj->video_format);
    }

    public function testMergeImageOptionsFullConstruction(): void
    {
        $obj = new MergeImageOptions(
            output_type: MergeImageOutputType::Gif,
            delay: 10,
            loop_count: 0,
            duration_per_image: 0.5,
            transition: MergeImageTransition::None,
            transition_duration: 0.1,
            fps: 1,
            video_format: MergeImageVideoFormat::Mp4,
        );
        $this->assertInstanceOf(MergeImageOptions::class, $obj);
    }

    public function testMergeVideoOutputTypeVideoBackingValue(): void
    {
        $enum = MergeVideoOutputType::from('video');
        $this->assertSame(MergeVideoOutputType::Video, $enum);
        $this->assertSame('video', $enum->value);
    }

    public function testMergeVideoOutputTypeCaseCount(): void
    {
        $this->assertCount(1, MergeVideoOutputType::cases());
    }

    public function testMergeVideoTransitionNoneBackingValue(): void
    {
        $enum = MergeVideoTransition::from('none');
        $this->assertSame(MergeVideoTransition::None, $enum);
        $this->assertSame('none', $enum->value);
    }

    public function testMergeVideoTransitionFadeBackingValue(): void
    {
        $enum = MergeVideoTransition::from('fade');
        $this->assertSame(MergeVideoTransition::Fade, $enum);
        $this->assertSame('fade', $enum->value);
    }

    public function testMergeVideoTransitionFadeblackBackingValue(): void
    {
        $enum = MergeVideoTransition::from('fadeblack');
        $this->assertSame(MergeVideoTransition::Fadeblack, $enum);
        $this->assertSame('fadeblack', $enum->value);
    }

    public function testMergeVideoTransitionFadewhiteBackingValue(): void
    {
        $enum = MergeVideoTransition::from('fadewhite');
        $this->assertSame(MergeVideoTransition::Fadewhite, $enum);
        $this->assertSame('fadewhite', $enum->value);
    }

    public function testMergeVideoTransitionDissolveBackingValue(): void
    {
        $enum = MergeVideoTransition::from('dissolve');
        $this->assertSame(MergeVideoTransition::Dissolve, $enum);
        $this->assertSame('dissolve', $enum->value);
    }

    public function testMergeVideoTransitionWipeleftBackingValue(): void
    {
        $enum = MergeVideoTransition::from('wipeleft');
        $this->assertSame(MergeVideoTransition::Wipeleft, $enum);
        $this->assertSame('wipeleft', $enum->value);
    }

    public function testMergeVideoTransitionWiperightBackingValue(): void
    {
        $enum = MergeVideoTransition::from('wiperight');
        $this->assertSame(MergeVideoTransition::Wiperight, $enum);
        $this->assertSame('wiperight', $enum->value);
    }

    public function testMergeVideoTransitionWipeupBackingValue(): void
    {
        $enum = MergeVideoTransition::from('wipeup');
        $this->assertSame(MergeVideoTransition::Wipeup, $enum);
        $this->assertSame('wipeup', $enum->value);
    }

    public function testMergeVideoTransitionWipedownBackingValue(): void
    {
        $enum = MergeVideoTransition::from('wipedown');
        $this->assertSame(MergeVideoTransition::Wipedown, $enum);
        $this->assertSame('wipedown', $enum->value);
    }

    public function testMergeVideoTransitionCrossfadeBackingValue(): void
    {
        $enum = MergeVideoTransition::from('crossfade');
        $this->assertSame(MergeVideoTransition::Crossfade, $enum);
        $this->assertSame('crossfade', $enum->value);
    }

    public function testMergeVideoTransitionSmoothleftBackingValue(): void
    {
        $enum = MergeVideoTransition::from('smoothleft');
        $this->assertSame(MergeVideoTransition::Smoothleft, $enum);
        $this->assertSame('smoothleft', $enum->value);
    }

    public function testMergeVideoTransitionSmoothrightBackingValue(): void
    {
        $enum = MergeVideoTransition::from('smoothright');
        $this->assertSame(MergeVideoTransition::Smoothright, $enum);
        $this->assertSame('smoothright', $enum->value);
    }

    public function testMergeVideoTransitionSmoothupBackingValue(): void
    {
        $enum = MergeVideoTransition::from('smoothup');
        $this->assertSame(MergeVideoTransition::Smoothup, $enum);
        $this->assertSame('smoothup', $enum->value);
    }

    public function testMergeVideoTransitionSmoothdownBackingValue(): void
    {
        $enum = MergeVideoTransition::from('smoothdown');
        $this->assertSame(MergeVideoTransition::Smoothdown, $enum);
        $this->assertSame('smoothdown', $enum->value);
    }

    public function testMergeVideoTransitionCircleopenBackingValue(): void
    {
        $enum = MergeVideoTransition::from('circleopen');
        $this->assertSame(MergeVideoTransition::Circleopen, $enum);
        $this->assertSame('circleopen', $enum->value);
    }

    public function testMergeVideoTransitionCirclecloseBackingValue(): void
    {
        $enum = MergeVideoTransition::from('circleclose');
        $this->assertSame(MergeVideoTransition::Circleclose, $enum);
        $this->assertSame('circleclose', $enum->value);
    }

    public function testMergeVideoTransitionCirclecropBackingValue(): void
    {
        $enum = MergeVideoTransition::from('circlecrop');
        $this->assertSame(MergeVideoTransition::Circlecrop, $enum);
        $this->assertSame('circlecrop', $enum->value);
    }

    public function testMergeVideoTransitionRectcropBackingValue(): void
    {
        $enum = MergeVideoTransition::from('rectcrop');
        $this->assertSame(MergeVideoTransition::Rectcrop, $enum);
        $this->assertSame('rectcrop', $enum->value);
    }

    public function testMergeVideoTransitionSlideleftBackingValue(): void
    {
        $enum = MergeVideoTransition::from('slideleft');
        $this->assertSame(MergeVideoTransition::Slideleft, $enum);
        $this->assertSame('slideleft', $enum->value);
    }

    public function testMergeVideoTransitionSliderightBackingValue(): void
    {
        $enum = MergeVideoTransition::from('slideright');
        $this->assertSame(MergeVideoTransition::Slideright, $enum);
        $this->assertSame('slideright', $enum->value);
    }

    public function testMergeVideoTransitionSlideupBackingValue(): void
    {
        $enum = MergeVideoTransition::from('slideup');
        $this->assertSame(MergeVideoTransition::Slideup, $enum);
        $this->assertSame('slideup', $enum->value);
    }

    public function testMergeVideoTransitionSlidedownBackingValue(): void
    {
        $enum = MergeVideoTransition::from('slidedown');
        $this->assertSame(MergeVideoTransition::Slidedown, $enum);
        $this->assertSame('slidedown', $enum->value);
    }

    public function testMergeVideoTransitionRadialBackingValue(): void
    {
        $enum = MergeVideoTransition::from('radial');
        $this->assertSame(MergeVideoTransition::Radial, $enum);
        $this->assertSame('radial', $enum->value);
    }

    public function testMergeVideoTransitionDiagtlBackingValue(): void
    {
        $enum = MergeVideoTransition::from('diagtl');
        $this->assertSame(MergeVideoTransition::Diagtl, $enum);
        $this->assertSame('diagtl', $enum->value);
    }

    public function testMergeVideoTransitionDiagtrBackingValue(): void
    {
        $enum = MergeVideoTransition::from('diagtr');
        $this->assertSame(MergeVideoTransition::Diagtr, $enum);
        $this->assertSame('diagtr', $enum->value);
    }

    public function testMergeVideoTransitionDiagblBackingValue(): void
    {
        $enum = MergeVideoTransition::from('diagbl');
        $this->assertSame(MergeVideoTransition::Diagbl, $enum);
        $this->assertSame('diagbl', $enum->value);
    }

    public function testMergeVideoTransitionPixelizeBackingValue(): void
    {
        $enum = MergeVideoTransition::from('pixelize');
        $this->assertSame(MergeVideoTransition::Pixelize, $enum);
        $this->assertSame('pixelize', $enum->value);
    }

    public function testMergeVideoTransitionHlsliceBackingValue(): void
    {
        $enum = MergeVideoTransition::from('hlslice');
        $this->assertSame(MergeVideoTransition::Hlslice, $enum);
        $this->assertSame('hlslice', $enum->value);
    }

    public function testMergeVideoTransitionVlsliceBackingValue(): void
    {
        $enum = MergeVideoTransition::from('vlslice');
        $this->assertSame(MergeVideoTransition::Vlslice, $enum);
        $this->assertSame('vlslice', $enum->value);
    }

    public function testMergeVideoTransitionHblurBackingValue(): void
    {
        $enum = MergeVideoTransition::from('hblur');
        $this->assertSame(MergeVideoTransition::Hblur, $enum);
        $this->assertSame('hblur', $enum->value);
    }

    public function testMergeVideoTransitionDistanceBackingValue(): void
    {
        $enum = MergeVideoTransition::from('distance');
        $this->assertSame(MergeVideoTransition::Distance, $enum);
        $this->assertSame('distance', $enum->value);
    }

    public function testMergeVideoTransitionSqueezehBackingValue(): void
    {
        $enum = MergeVideoTransition::from('squeezeh');
        $this->assertSame(MergeVideoTransition::Squeezeh, $enum);
        $this->assertSame('squeezeh', $enum->value);
    }

    public function testMergeVideoTransitionCustomBackingValue(): void
    {
        $enum = MergeVideoTransition::from('custom');
        $this->assertSame(MergeVideoTransition::Custom, $enum);
        $this->assertSame('custom', $enum->value);
    }

    public function testMergeVideoTransitionWipetlBackingValue(): void
    {
        $enum = MergeVideoTransition::from('wipetl');
        $this->assertSame(MergeVideoTransition::Wipetl, $enum);
        $this->assertSame('wipetl', $enum->value);
    }

    public function testMergeVideoTransitionWipetrBackingValue(): void
    {
        $enum = MergeVideoTransition::from('wipetr');
        $this->assertSame(MergeVideoTransition::Wipetr, $enum);
        $this->assertSame('wipetr', $enum->value);
    }

    public function testMergeVideoTransitionWipeblBackingValue(): void
    {
        $enum = MergeVideoTransition::from('wipebl');
        $this->assertSame(MergeVideoTransition::Wipebl, $enum);
        $this->assertSame('wipebl', $enum->value);
    }

    public function testMergeVideoTransitionCaseCount(): void
    {
        $this->assertCount(36, MergeVideoTransition::cases());
    }

    public function testMergeVideoReEncodeModeAutoBackingValue(): void
    {
        $enum = MergeVideoReEncodeMode::from('auto');
        $this->assertSame(MergeVideoReEncodeMode::Auto, $enum);
        $this->assertSame('auto', $enum->value);
    }

    public function testMergeVideoReEncodeModeAlwaysBackingValue(): void
    {
        $enum = MergeVideoReEncodeMode::from('always');
        $this->assertSame(MergeVideoReEncodeMode::Always, $enum);
        $this->assertSame('always', $enum->value);
    }

    public function testMergeVideoReEncodeModeNeverBackingValue(): void
    {
        $enum = MergeVideoReEncodeMode::from('never');
        $this->assertSame(MergeVideoReEncodeMode::Never, $enum);
        $this->assertSame('never', $enum->value);
    }

    public function testMergeVideoReEncodeModeCaseCount(): void
    {
        $this->assertCount(3, MergeVideoReEncodeMode::cases());
    }

    public function testMergeVideoCodecH264BackingValue(): void
    {
        $enum = MergeVideoCodec::from('h264');
        $this->assertSame(MergeVideoCodec::H264, $enum);
        $this->assertSame('h264', $enum->value);
    }

    public function testMergeVideoCodecH265BackingValue(): void
    {
        $enum = MergeVideoCodec::from('h265');
        $this->assertSame(MergeVideoCodec::H265, $enum);
        $this->assertSame('h265', $enum->value);
    }

    public function testMergeVideoCodecVp9BackingValue(): void
    {
        $enum = MergeVideoCodec::from('vp9');
        $this->assertSame(MergeVideoCodec::Vp9, $enum);
        $this->assertSame('vp9', $enum->value);
    }

    public function testMergeVideoCodecAv1BackingValue(): void
    {
        $enum = MergeVideoCodec::from('av1');
        $this->assertSame(MergeVideoCodec::Av1, $enum);
        $this->assertSame('av1', $enum->value);
    }

    public function testMergeVideoCodecCaseCount(): void
    {
        $this->assertCount(4, MergeVideoCodec::cases());
    }

    public function testMergeVideoPresetUltrafastBackingValue(): void
    {
        $enum = MergeVideoPreset::from('ultrafast');
        $this->assertSame(MergeVideoPreset::Ultrafast, $enum);
        $this->assertSame('ultrafast', $enum->value);
    }

    public function testMergeVideoPresetSuperfastBackingValue(): void
    {
        $enum = MergeVideoPreset::from('superfast');
        $this->assertSame(MergeVideoPreset::Superfast, $enum);
        $this->assertSame('superfast', $enum->value);
    }

    public function testMergeVideoPresetVeryfastBackingValue(): void
    {
        $enum = MergeVideoPreset::from('veryfast');
        $this->assertSame(MergeVideoPreset::Veryfast, $enum);
        $this->assertSame('veryfast', $enum->value);
    }

    public function testMergeVideoPresetFasterBackingValue(): void
    {
        $enum = MergeVideoPreset::from('faster');
        $this->assertSame(MergeVideoPreset::Faster, $enum);
        $this->assertSame('faster', $enum->value);
    }

    public function testMergeVideoPresetFastBackingValue(): void
    {
        $enum = MergeVideoPreset::from('fast');
        $this->assertSame(MergeVideoPreset::Fast, $enum);
        $this->assertSame('fast', $enum->value);
    }

    public function testMergeVideoPresetMediumBackingValue(): void
    {
        $enum = MergeVideoPreset::from('medium');
        $this->assertSame(MergeVideoPreset::Medium, $enum);
        $this->assertSame('medium', $enum->value);
    }

    public function testMergeVideoPresetSlowBackingValue(): void
    {
        $enum = MergeVideoPreset::from('slow');
        $this->assertSame(MergeVideoPreset::Slow, $enum);
        $this->assertSame('slow', $enum->value);
    }

    public function testMergeVideoPresetSlowerBackingValue(): void
    {
        $enum = MergeVideoPreset::from('slower');
        $this->assertSame(MergeVideoPreset::Slower, $enum);
        $this->assertSame('slower', $enum->value);
    }

    public function testMergeVideoPresetVeryslowBackingValue(): void
    {
        $enum = MergeVideoPreset::from('veryslow');
        $this->assertSame(MergeVideoPreset::Veryslow, $enum);
        $this->assertSame('veryslow', $enum->value);
    }

    public function testMergeVideoPresetCaseCount(): void
    {
        $this->assertCount(9, MergeVideoPreset::cases());
    }

    public function testMergeVideoEncodingModeCrfBackingValue(): void
    {
        $enum = MergeVideoEncodingMode::from('crf');
        $this->assertSame(MergeVideoEncodingMode::Crf, $enum);
        $this->assertSame('crf', $enum->value);
    }

    public function testMergeVideoEncodingModeTargetSizeBackingValue(): void
    {
        $enum = MergeVideoEncodingMode::from('target_size');
        $this->assertSame(MergeVideoEncodingMode::TargetSize, $enum);
        $this->assertSame('target_size', $enum->value);
    }

    public function testMergeVideoEncodingModeCaseCount(): void
    {
        $this->assertCount(2, MergeVideoEncodingMode::cases());
    }

    public function testMergeVideoOptionsDefaultConstruction(): void
    {
        $obj = new MergeVideoOptions();
        $this->assertInstanceOf(MergeVideoOptions::class, $obj);
        $this->assertSame(MergeVideoTransition::None, $obj->transition);
        $this->assertSame(false, $obj->normalize_audio);
        $this->assertSame(MergeVideoReEncodeMode::Auto, $obj->re_encode_mode);
        $this->assertNull($obj->output_type);
        $this->assertNull($obj->crossfade_duration);
        $this->assertNull($obj->codec);
        $this->assertNull($obj->crf);
        $this->assertNull($obj->preset);
        $this->assertNull($obj->target_resolution);
        $this->assertNull($obj->encoding_mode);
        $this->assertNull($obj->target_size_bytes);
    }

    public function testMergeVideoOptionsFullConstruction(): void
    {
        $obj = new MergeVideoOptions(
            output_type: MergeVideoOutputType::Video,
            transition: MergeVideoTransition::None,
            crossfade_duration: 0.1,
            normalize_audio: true,
            re_encode_mode: MergeVideoReEncodeMode::Auto,
            codec: MergeVideoCodec::H264,
            crf: 0,
            preset: MergeVideoPreset::Ultrafast,
            target_resolution: 'test_value',
            encoding_mode: MergeVideoEncodingMode::Crf,
            target_size_bytes: 1048576,
        );
        $this->assertInstanceOf(MergeVideoOptions::class, $obj);
    }

    public function testMergeVideoPerInputOptionsDefaultConstruction(): void
    {
        $obj = new MergeVideoPerInputOptions();
        $this->assertInstanceOf(MergeVideoPerInputOptions::class, $obj);
        $this->assertNull($obj->transition);
        $this->assertNull($obj->crossfade_duration);
        $this->assertNull($obj->trim_start);
        $this->assertNull($obj->trim_end);
    }

    public function testMergeVideoPerInputOptionsFullConstruction(): void
    {
        $obj = new MergeVideoPerInputOptions(
            transition: MergeVideoTransition::None,
            crossfade_duration: 0.1,
            trim_start: 0.0,
            trim_end: 0.0,
        );
        $this->assertInstanceOf(MergeVideoPerInputOptions::class, $obj);
    }

    public function testMergeAudioOutputTypeAudioBackingValue(): void
    {
        $enum = MergeAudioOutputType::from('audio');
        $this->assertSame(MergeAudioOutputType::Audio, $enum);
        $this->assertSame('audio', $enum->value);
    }

    public function testMergeAudioOutputTypeCaseCount(): void
    {
        $this->assertCount(1, MergeAudioOutputType::cases());
    }

    public function testMergeAudioTransitionNoneBackingValue(): void
    {
        $enum = MergeAudioTransition::from('none');
        $this->assertSame(MergeAudioTransition::None, $enum);
        $this->assertSame('none', $enum->value);
    }

    public function testMergeAudioTransitionCrossfadeBackingValue(): void
    {
        $enum = MergeAudioTransition::from('crossfade');
        $this->assertSame(MergeAudioTransition::Crossfade, $enum);
        $this->assertSame('crossfade', $enum->value);
    }

    public function testMergeAudioTransitionCaseCount(): void
    {
        $this->assertCount(2, MergeAudioTransition::cases());
    }

    public function testMergeAudioOptionsDefaultConstruction(): void
    {
        $obj = new MergeAudioOptions();
        $this->assertInstanceOf(MergeAudioOptions::class, $obj);
        $this->assertSame(MergeAudioTransition::None, $obj->transition);
        $this->assertSame(0.0, $obj->gap_duration);
        $this->assertSame(true, $obj->normalize_audio);
        $this->assertNull($obj->output_type);
        $this->assertNull($obj->crossfade_duration);
    }

    public function testMergeAudioOptionsFullConstruction(): void
    {
        $obj = new MergeAudioOptions(
            output_type: MergeAudioOutputType::Audio,
            transition: MergeAudioTransition::None,
            crossfade_duration: 0.0,
            gap_duration: 0.0,
            normalize_audio: true,
        );
        $this->assertInstanceOf(MergeAudioOptions::class, $obj);
    }

    public function testMergeAudioPerInputOptionsDefaultConstruction(): void
    {
        $obj = new MergeAudioPerInputOptions();
        $this->assertInstanceOf(MergeAudioPerInputOptions::class, $obj);
        $this->assertNull($obj->transition);
        $this->assertNull($obj->crossfade_duration);
        $this->assertNull($obj->gap_duration);
        $this->assertNull($obj->trim_start);
        $this->assertNull($obj->trim_end);
    }

    public function testMergeAudioPerInputOptionsFullConstruction(): void
    {
        $obj = new MergeAudioPerInputOptions(
            transition: MergeAudioTransition::None,
            crossfade_duration: 0.0,
            gap_duration: 0.0,
            trim_start: 0.0,
            trim_end: 0.0,
        );
        $this->assertInstanceOf(MergeAudioPerInputOptions::class, $obj);
    }

}
