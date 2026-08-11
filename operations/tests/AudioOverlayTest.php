<?php

// Auto-generated -- do not edit

declare(strict_types=1);

namespace Gisl\Generated\Operations\Tests;

use PHPUnit\Framework\TestCase;
use Gisl\Generated\Operations\AudioOverlayAudioMode;
use Gisl\Generated\Operations\AudioOverlayAudioOptions;
use Gisl\Generated\Operations\AudioOverlayVideoMode;
use Gisl\Generated\Operations\AudioOverlayVideoNoAudioTrackBehaviour;
use Gisl\Generated\Operations\AudioOverlayVideoOptions;

final class AudioOverlayTest extends TestCase
{
    public function testAudioOverlayAudioModeMixBackingValue(): void
    {
        $enum = AudioOverlayAudioMode::from('mix');
        $this->assertSame(AudioOverlayAudioMode::Mix, $enum);
        $this->assertSame('mix', $enum->value);
    }

    public function testAudioOverlayAudioModeDuckBackingValue(): void
    {
        $enum = AudioOverlayAudioMode::from('duck');
        $this->assertSame(AudioOverlayAudioMode::Duck, $enum);
        $this->assertSame('duck', $enum->value);
    }

    public function testAudioOverlayAudioModeReplaceBackingValue(): void
    {
        $enum = AudioOverlayAudioMode::from('replace');
        $this->assertSame(AudioOverlayAudioMode::Replace, $enum);
        $this->assertSame('replace', $enum->value);
    }

    public function testAudioOverlayAudioModeCaseCount(): void
    {
        $this->assertCount(3, AudioOverlayAudioMode::cases());
    }

    public function testAudioOverlayAudioOptionsDefaultConstruction(): void
    {
        $obj = new AudioOverlayAudioOptions();
        $this->assertInstanceOf(AudioOverlayAudioOptions::class, $obj);
        $this->assertSame(0.0, $obj->start_at);
        $this->assertSame(-3.0, $obj->overlay_gain_db);
        $this->assertSame(AudioOverlayAudioMode::Mix, $obj->mode);
        $this->assertSame(0, $obj->fade_in_ms);
        $this->assertSame(0, $obj->fade_out_ms);
        $this->assertSame(false, $obj->loop);
        $this->assertNull($obj->duration);
        $this->assertNull($obj->duck_threshold);
        $this->assertNull($obj->duck_ratio);
        $this->assertNull($obj->duck_attack_ms);
        $this->assertNull($obj->duck_release_ms);
        $this->assertNull($obj->loop_interval);
        $this->assertNull($obj->silence_threshold_db);
        $this->assertNull($obj->min_silence_ms);
    }

    public function testAudioOverlayAudioOptionsFullConstruction(): void
    {
        $obj = new AudioOverlayAudioOptions(
            start_at: 0.0,
            duration: 0.0,
            overlay_gain_db: -60.0,
            mode: AudioOverlayAudioMode::Mix,
            duck_threshold: -60.0,
            duck_ratio: 1.0,
            duck_attack_ms: 0,
            duck_release_ms: 0,
            fade_in_ms: 0,
            fade_out_ms: 0,
            loop: true,
            loop_interval: 0.0,
            silence_threshold_db: -80.0,
            min_silence_ms: 50,
        );
        $this->assertInstanceOf(AudioOverlayAudioOptions::class, $obj);
    }

    public function testAudioOverlayVideoModeMixBackingValue(): void
    {
        $enum = AudioOverlayVideoMode::from('mix');
        $this->assertSame(AudioOverlayVideoMode::Mix, $enum);
        $this->assertSame('mix', $enum->value);
    }

    public function testAudioOverlayVideoModeDuckBackingValue(): void
    {
        $enum = AudioOverlayVideoMode::from('duck');
        $this->assertSame(AudioOverlayVideoMode::Duck, $enum);
        $this->assertSame('duck', $enum->value);
    }

    public function testAudioOverlayVideoModeReplaceBackingValue(): void
    {
        $enum = AudioOverlayVideoMode::from('replace');
        $this->assertSame(AudioOverlayVideoMode::Replace, $enum);
        $this->assertSame('replace', $enum->value);
    }

    public function testAudioOverlayVideoModeCaseCount(): void
    {
        $this->assertCount(3, AudioOverlayVideoMode::cases());
    }

    public function testAudioOverlayVideoNoAudioTrackBehaviourRejectBackingValue(): void
    {
        $enum = AudioOverlayVideoNoAudioTrackBehaviour::from('reject');
        $this->assertSame(AudioOverlayVideoNoAudioTrackBehaviour::Reject, $enum);
        $this->assertSame('reject', $enum->value);
    }

    public function testAudioOverlayVideoNoAudioTrackBehaviourCreateSilentBackingValue(): void
    {
        $enum = AudioOverlayVideoNoAudioTrackBehaviour::from('create_silent');
        $this->assertSame(AudioOverlayVideoNoAudioTrackBehaviour::CreateSilent, $enum);
        $this->assertSame('create_silent', $enum->value);
    }

    public function testAudioOverlayVideoNoAudioTrackBehaviourReplaceBackingValue(): void
    {
        $enum = AudioOverlayVideoNoAudioTrackBehaviour::from('replace');
        $this->assertSame(AudioOverlayVideoNoAudioTrackBehaviour::Replace, $enum);
        $this->assertSame('replace', $enum->value);
    }

    public function testAudioOverlayVideoNoAudioTrackBehaviourCaseCount(): void
    {
        $this->assertCount(3, AudioOverlayVideoNoAudioTrackBehaviour::cases());
    }

    public function testAudioOverlayVideoOptionsDefaultConstruction(): void
    {
        $obj = new AudioOverlayVideoOptions();
        $this->assertInstanceOf(AudioOverlayVideoOptions::class, $obj);
        $this->assertSame(0.0, $obj->start_at);
        $this->assertSame(-3.0, $obj->overlay_gain_db);
        $this->assertSame(AudioOverlayVideoMode::Mix, $obj->mode);
        $this->assertSame(0, $obj->fade_in_ms);
        $this->assertSame(0, $obj->fade_out_ms);
        $this->assertSame(false, $obj->loop);
        $this->assertSame(AudioOverlayVideoNoAudioTrackBehaviour::Reject, $obj->no_audio_track_behaviour);
        $this->assertNull($obj->duration);
        $this->assertNull($obj->duck_threshold);
        $this->assertNull($obj->duck_ratio);
        $this->assertNull($obj->duck_attack_ms);
        $this->assertNull($obj->duck_release_ms);
        $this->assertNull($obj->loop_interval);
        $this->assertNull($obj->silence_threshold_db);
        $this->assertNull($obj->min_silence_ms);
    }

    public function testAudioOverlayVideoOptionsFullConstruction(): void
    {
        $obj = new AudioOverlayVideoOptions(
            start_at: 0.0,
            duration: 0.0,
            overlay_gain_db: -60.0,
            mode: AudioOverlayVideoMode::Mix,
            duck_threshold: -60.0,
            duck_ratio: 1.0,
            duck_attack_ms: 0,
            duck_release_ms: 0,
            fade_in_ms: 0,
            fade_out_ms: 0,
            loop: true,
            loop_interval: 0.0,
            no_audio_track_behaviour: AudioOverlayVideoNoAudioTrackBehaviour::Reject,
            silence_threshold_db: -80.0,
            min_silence_ms: 50,
        );
        $this->assertInstanceOf(AudioOverlayVideoOptions::class, $obj);
    }

}
