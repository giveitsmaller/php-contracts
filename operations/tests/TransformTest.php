<?php

// Auto-generated -- do not edit

declare(strict_types=1);

namespace Gisl\Generated\Operations\Tests;

use PHPUnit\Framework\TestCase;
use Gisl\Generated\Operations\TransformDocumentPdfOptions;
use Gisl\Generated\Operations\TransformDocumentPdfRotate;
use Gisl\Generated\Operations\TransformImageFlip;
use Gisl\Generated\Operations\TransformImageGifFlip;
use Gisl\Generated\Operations\TransformImageGifOptions;
use Gisl\Generated\Operations\TransformImageGifRotate;
use Gisl\Generated\Operations\TransformImageOptions;
use Gisl\Generated\Operations\TransformImageRotate;
use Gisl\Generated\Operations\TransformVideoFlip;
use Gisl\Generated\Operations\TransformVideoOptions;
use Gisl\Generated\Operations\TransformVideoRotate;

final class TransformTest extends TestCase
{
    public function testTransformImageRotate_0BackingValue(): void
    {
        $enum = TransformImageRotate::from(0);
        $this->assertSame(TransformImageRotate::_0, $enum);
        $this->assertSame(0, $enum->value);
    }

    public function testTransformImageRotate_90BackingValue(): void
    {
        $enum = TransformImageRotate::from(90);
        $this->assertSame(TransformImageRotate::_90, $enum);
        $this->assertSame(90, $enum->value);
    }

    public function testTransformImageRotate_180BackingValue(): void
    {
        $enum = TransformImageRotate::from(180);
        $this->assertSame(TransformImageRotate::_180, $enum);
        $this->assertSame(180, $enum->value);
    }

    public function testTransformImageRotate_270BackingValue(): void
    {
        $enum = TransformImageRotate::from(270);
        $this->assertSame(TransformImageRotate::_270, $enum);
        $this->assertSame(270, $enum->value);
    }

    public function testTransformImageRotateCaseCount(): void
    {
        $this->assertCount(4, TransformImageRotate::cases());
    }

    public function testTransformImageFlipNoneBackingValue(): void
    {
        $enum = TransformImageFlip::from('none');
        $this->assertSame(TransformImageFlip::None, $enum);
        $this->assertSame('none', $enum->value);
    }

    public function testTransformImageFlipHorizontalBackingValue(): void
    {
        $enum = TransformImageFlip::from('horizontal');
        $this->assertSame(TransformImageFlip::Horizontal, $enum);
        $this->assertSame('horizontal', $enum->value);
    }

    public function testTransformImageFlipVerticalBackingValue(): void
    {
        $enum = TransformImageFlip::from('vertical');
        $this->assertSame(TransformImageFlip::Vertical, $enum);
        $this->assertSame('vertical', $enum->value);
    }

    public function testTransformImageFlipBothBackingValue(): void
    {
        $enum = TransformImageFlip::from('both');
        $this->assertSame(TransformImageFlip::Both, $enum);
        $this->assertSame('both', $enum->value);
    }

    public function testTransformImageFlipCaseCount(): void
    {
        $this->assertCount(4, TransformImageFlip::cases());
    }

    public function testTransformImageOptionsDefaultConstruction(): void
    {
        $obj = new TransformImageOptions();
        $this->assertInstanceOf(TransformImageOptions::class, $obj);
        $this->assertSame(TransformImageRotate::_0, $obj->rotate);
        $this->assertSame(TransformImageFlip::None, $obj->flip);
    }

    public function testTransformImageOptionsFullConstruction(): void
    {
        $obj = new TransformImageOptions(
            rotate: TransformImageRotate::_0,
            flip: TransformImageFlip::None,
        );
        $this->assertInstanceOf(TransformImageOptions::class, $obj);
    }

    public function testTransformImageGifRotate_0BackingValue(): void
    {
        $enum = TransformImageGifRotate::from(0);
        $this->assertSame(TransformImageGifRotate::_0, $enum);
        $this->assertSame(0, $enum->value);
    }

    public function testTransformImageGifRotate_90BackingValue(): void
    {
        $enum = TransformImageGifRotate::from(90);
        $this->assertSame(TransformImageGifRotate::_90, $enum);
        $this->assertSame(90, $enum->value);
    }

    public function testTransformImageGifRotate_180BackingValue(): void
    {
        $enum = TransformImageGifRotate::from(180);
        $this->assertSame(TransformImageGifRotate::_180, $enum);
        $this->assertSame(180, $enum->value);
    }

    public function testTransformImageGifRotate_270BackingValue(): void
    {
        $enum = TransformImageGifRotate::from(270);
        $this->assertSame(TransformImageGifRotate::_270, $enum);
        $this->assertSame(270, $enum->value);
    }

    public function testTransformImageGifRotateCaseCount(): void
    {
        $this->assertCount(4, TransformImageGifRotate::cases());
    }

    public function testTransformImageGifFlipNoneBackingValue(): void
    {
        $enum = TransformImageGifFlip::from('none');
        $this->assertSame(TransformImageGifFlip::None, $enum);
        $this->assertSame('none', $enum->value);
    }

    public function testTransformImageGifFlipHorizontalBackingValue(): void
    {
        $enum = TransformImageGifFlip::from('horizontal');
        $this->assertSame(TransformImageGifFlip::Horizontal, $enum);
        $this->assertSame('horizontal', $enum->value);
    }

    public function testTransformImageGifFlipVerticalBackingValue(): void
    {
        $enum = TransformImageGifFlip::from('vertical');
        $this->assertSame(TransformImageGifFlip::Vertical, $enum);
        $this->assertSame('vertical', $enum->value);
    }

    public function testTransformImageGifFlipBothBackingValue(): void
    {
        $enum = TransformImageGifFlip::from('both');
        $this->assertSame(TransformImageGifFlip::Both, $enum);
        $this->assertSame('both', $enum->value);
    }

    public function testTransformImageGifFlipCaseCount(): void
    {
        $this->assertCount(4, TransformImageGifFlip::cases());
    }

    public function testTransformImageGifOptionsDefaultConstruction(): void
    {
        $obj = new TransformImageGifOptions();
        $this->assertInstanceOf(TransformImageGifOptions::class, $obj);
        $this->assertSame(TransformImageGifRotate::_0, $obj->rotate);
        $this->assertSame(TransformImageGifFlip::None, $obj->flip);
    }

    public function testTransformImageGifOptionsFullConstruction(): void
    {
        $obj = new TransformImageGifOptions(
            rotate: TransformImageGifRotate::_0,
            flip: TransformImageGifFlip::None,
        );
        $this->assertInstanceOf(TransformImageGifOptions::class, $obj);
    }

    public function testTransformVideoRotate_0BackingValue(): void
    {
        $enum = TransformVideoRotate::from(0);
        $this->assertSame(TransformVideoRotate::_0, $enum);
        $this->assertSame(0, $enum->value);
    }

    public function testTransformVideoRotate_90BackingValue(): void
    {
        $enum = TransformVideoRotate::from(90);
        $this->assertSame(TransformVideoRotate::_90, $enum);
        $this->assertSame(90, $enum->value);
    }

    public function testTransformVideoRotate_180BackingValue(): void
    {
        $enum = TransformVideoRotate::from(180);
        $this->assertSame(TransformVideoRotate::_180, $enum);
        $this->assertSame(180, $enum->value);
    }

    public function testTransformVideoRotate_270BackingValue(): void
    {
        $enum = TransformVideoRotate::from(270);
        $this->assertSame(TransformVideoRotate::_270, $enum);
        $this->assertSame(270, $enum->value);
    }

    public function testTransformVideoRotateCaseCount(): void
    {
        $this->assertCount(4, TransformVideoRotate::cases());
    }

    public function testTransformVideoFlipNoneBackingValue(): void
    {
        $enum = TransformVideoFlip::from('none');
        $this->assertSame(TransformVideoFlip::None, $enum);
        $this->assertSame('none', $enum->value);
    }

    public function testTransformVideoFlipHorizontalBackingValue(): void
    {
        $enum = TransformVideoFlip::from('horizontal');
        $this->assertSame(TransformVideoFlip::Horizontal, $enum);
        $this->assertSame('horizontal', $enum->value);
    }

    public function testTransformVideoFlipVerticalBackingValue(): void
    {
        $enum = TransformVideoFlip::from('vertical');
        $this->assertSame(TransformVideoFlip::Vertical, $enum);
        $this->assertSame('vertical', $enum->value);
    }

    public function testTransformVideoFlipBothBackingValue(): void
    {
        $enum = TransformVideoFlip::from('both');
        $this->assertSame(TransformVideoFlip::Both, $enum);
        $this->assertSame('both', $enum->value);
    }

    public function testTransformVideoFlipCaseCount(): void
    {
        $this->assertCount(4, TransformVideoFlip::cases());
    }

    public function testTransformVideoOptionsDefaultConstruction(): void
    {
        $obj = new TransformVideoOptions();
        $this->assertInstanceOf(TransformVideoOptions::class, $obj);
        $this->assertSame(TransformVideoRotate::_0, $obj->rotate);
        $this->assertSame(TransformVideoFlip::None, $obj->flip);
    }

    public function testTransformVideoOptionsFullConstruction(): void
    {
        $obj = new TransformVideoOptions(
            rotate: TransformVideoRotate::_0,
            flip: TransformVideoFlip::None,
        );
        $this->assertInstanceOf(TransformVideoOptions::class, $obj);
    }

    public function testTransformDocumentPdfRotate_0BackingValue(): void
    {
        $enum = TransformDocumentPdfRotate::from(0);
        $this->assertSame(TransformDocumentPdfRotate::_0, $enum);
        $this->assertSame(0, $enum->value);
    }

    public function testTransformDocumentPdfRotate_90BackingValue(): void
    {
        $enum = TransformDocumentPdfRotate::from(90);
        $this->assertSame(TransformDocumentPdfRotate::_90, $enum);
        $this->assertSame(90, $enum->value);
    }

    public function testTransformDocumentPdfRotate_180BackingValue(): void
    {
        $enum = TransformDocumentPdfRotate::from(180);
        $this->assertSame(TransformDocumentPdfRotate::_180, $enum);
        $this->assertSame(180, $enum->value);
    }

    public function testTransformDocumentPdfRotate_270BackingValue(): void
    {
        $enum = TransformDocumentPdfRotate::from(270);
        $this->assertSame(TransformDocumentPdfRotate::_270, $enum);
        $this->assertSame(270, $enum->value);
    }

    public function testTransformDocumentPdfRotateCaseCount(): void
    {
        $this->assertCount(4, TransformDocumentPdfRotate::cases());
    }

    public function testTransformDocumentPdfOptionsDefaultConstruction(): void
    {
        $obj = new TransformDocumentPdfOptions();
        $this->assertInstanceOf(TransformDocumentPdfOptions::class, $obj);
        $this->assertSame(TransformDocumentPdfRotate::_0, $obj->rotate);
    }

    public function testTransformDocumentPdfOptionsFullConstruction(): void
    {
        $obj = new TransformDocumentPdfOptions(
            rotate: TransformDocumentPdfRotate::_0,
        );
        $this->assertInstanceOf(TransformDocumentPdfOptions::class, $obj);
    }

}
