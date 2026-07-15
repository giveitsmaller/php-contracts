<?php
/**
 * OperationType
 *
 * PHP version 8.1
 *
 * @category Class
 * @package  Gisl\Generated\OpenApi
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */

/**
 * GISL Compression API
 *
 * REST API for the GISL (Give It Smaller) file compression and processing service.  **Architecture:** - Upload files to get a `file_id` - Create workflows referencing uploaded files with operations (compress, thumbnail, image_watermark, text_watermark, merge, archive, convert, custom_luma, audio_overlay, audio_watermark) - Poll status, stream SSE events, or receive webhook callbacks - Download results per operation output  **Response envelope:** All mutation and query endpoints return `{ success: true, data: {...} }` on success and `{ success: false, error: \"...\", details: [...] }` on failure. Exceptions: `GET /api/operations/schema` returns raw JSON (per-tier private caching with ETag revalidation per ADR-0002 + I3), health probes return flat objects, and `POST /api/contact` returns 204 with no body.  **Availability metadata.** This spec uses the `x-availability` vendor extension as **decorative documentation only**. Per [ADR-0001](../docs/decisions/0001-contract-first-availability.md) §1.5, the runtime endpoint `GET /api/operations/schema` (ticket I3) is the authoritative source; the sidecar `availability.json` (ticket I3b) is the authoritative companion (generated, never hand-edited; CI cross-checks runtime ⇄ sidecar). SDKs MUST NOT depend on `x-availability` reaching generated code — code-generators that surface vendor extensions may emit it as documentation, but consumers read availability from the runtime endpoint, not from the generated bindings.  The 5-value vocabulary (`stable | beta | experimental | planned | deprecated`) is defined in the `AvailabilityValue` schema. See `schemas/FORMAT.md` §Availability Taxonomy for the operational rules (parser obligation: absent = stable; per-enum-value granularity is the `per_value_availability` primitive landed via ticket I17).  **Localisation (per ticket [I26](https://trello.com/c/rcnqwgI4)).**  Error responses + paused/blocked workflow statuses carry a localised human-readable `message` alongside a stable, never-localised `message_key`. Machine-readable fields (`error`, enum values, status codes) stay canonical English.  - **Currently committed locales:** `en-GB` only (per ticket   [`4GKyuYo6`](https://trello.com/c/4GKyuYo6)). The I26 carrier   shape (`Accept-Language` + `Content-Language` + `Vary` headers +   `locale` envelope field + `message_key` + `message_params`) is   stable and exercised; the **catalog** of translated `message`   strings is en-GB-only at runtime today. Additional locales (e.g.   `pt-PT`) will be advertised by name when their catalogs ship —   the request/response carrier shape does NOT change when a new   locale lands. Treat unrequested locales as \"machine-code +   `message_key` path is committed; localised `message` prose is   not\" until this prose enumerates them by name. - **Request:** `Accept-Language` header per RFC 9110 §12.5.4 (q-value   negotiation supported). The server selects the best-match locale   from its supported list; falls back to `en-GB` when no match —   which, until additional catalogs land, is every non-`en-GB`   `Accept-Language`. - **Response:** `Content-Language: <locale>` echo on every localised   response; `Vary: Accept-Language` on every response (CDN/cache   correctness — different `Accept-Language` requests produce   different responses). `Vary` is emitted unconditionally so the   header contract does not flip when a second locale ships. - **Fallback locale:** `en-GB` (also the canonical locale for   `message_key` translations and English `message` prose). - **SDK guidance:** switch on `error` (machine code) for typed   error branches; surface `message_key` to client-side i18n   catalogs (SDK companion work tracked at X19, cross-repo);   display `message` for end-user UI; **never parse `message` for   control flow** — it changes per locale.  Carrier shape lives on `ErrorEnvelope` (envelope-level optional `message_key` + `message` + `locale` + `message_params`) and `ValidationErrorEnvelope` (also per-`details[]` entry). Existing 402 / 403 / 422 envelopes (`BalanceExhaustedResponse`, `FeatureNotAvailableResponse`, `FeatureTierRestrictedResponse`, `WorkflowPausedDetail`) inherit the convention.  **Upload thresholds (per tickets [u0ar7Yye](https://trello.com/c/u0ar7Yye) + [58nBQLWQ](https://trello.com/c/58nBQLWQ)).** Canonical upload constants (single-shot cap, multipart chunk size, multipart concurrency default, multipart first-chunk size) live on the `UploadThresholds` schema with `const:`-pinned values. SDK generators emit these as typed binding constants so frontend / API / SDKs reference one source of truth instead of hardcoding magic numbers. A runtime `GET /api/uploads/limits` endpoint for dynamic discovery (per-tier / per-environment overrides) is a deferred follow-up.
 *
 * The version of the OpenAPI document: 2.171.0
 * Generated by: https://openapi-generator.tech
 * Generator version: 7.21.0
 */

/**
 * NOTE: This class is auto generated by OpenAPI Generator (https://openapi-generator.tech).
 * https://openapi-generator.tech
 * Do not edit the class manually.
 */

namespace Gisl\Generated\OpenApi\Model;
use \Gisl\Generated\OpenApi\ObjectSerializer;

/**
 * OperationType Class Doc Comment
 *
 * @category Class
 * @description Available operation types: - compress: Reduce file size (images, audio, video, documents) - thumbnail: Legacy thumbnail value. Generates a preview image   for any media type via a single Lambda. Retained as a valid   routing target during the migration window, but the   compression_api publisher no longer emits it — it now resolves   the per-media sub-type value below on the SNS &#x60;operation_type&#x60;   attribute. The payload &#x60;operation_type&#x60; field stays &#x60;thumbnail&#x60;. - thumbnail_image: Image thumbnail sub-type. Backed by a dedicated   Rust image Lambda. Emitted by the publisher for image inputs. - thumbnail_video: Video thumbnail sub-type. Backed by a dedicated   FFmpeg Lambda. Emitted by the publisher for video inputs. - thumbnail_document: PDF/EPUB thumbnail sub-type. Backed by a   dedicated Ghostscript Lambda. Emitted by the publisher for   PDF/EPUB inputs. - thumbnail_office: Office document (DOCX/XLSX/PPTX/ODT/ODS/ODP)   thumbnail sub-type. Backed by a dedicated LibreOffice Lambda.   Emitted by the publisher for office-document inputs. - image_watermark: Image overlay onto a base IMAGE asset. Multi-input (Path B, role-based): one &#x60;base&#x60; + 1–8 &#x60;overlay&#x60; inputs (&#x60;input&#x60; min 2 / max 9). A single overlay uses the flat placement options (&#x60;anchor&#x60; / &#x60;margin_x&#x60; / &#x60;margin_y&#x60; / &#x60;opacity&#x60; / &#x60;overlay_width&#x60;); 2–8 overlays use the index-aligned &#x60;overlays[]&#x60; array (multi_overlay_stack, LIVE 2026-07-01) — the two are mutually exclusive. Each input is a &#x60;MultiInputSource&#x60; (external_import / connection / job_output — no upload-direct); an uploaded base or overlay enters via a &#x60;passthrough&#x60; source job referenced by &#x60;job_output&#x60;. Stable for static-image bases (jpeg/png/webp); TIFF (&#x60;image_tiff&#x60;) and BMP (&#x60;image_bmp&#x60;) bases are now &#x60;stable&#x60; too (flipped 2026-06-30, UANjD38A). Animated GIF (&#x60;image_gif&#x60;) bases stay &#x60;planned&#x60; via a parallel mime_group — dispatch returns &#x60;feature_not_available&#x60; (422) until Lambda support ships. Video bases are NOT supported by image_watermark — use the dedicated &#x60;video_watermark&#x60; operation per ADR-0013. Per ADR-0004 + I4-CONS + I5 (Trello AKZiOXnd). - text_watermark: Text overlay rendered onto an image (Liberation Sans). Single-input. Stable for jpeg/png/webp; TIFF (&#x60;image_tiff&#x60;) and BMP (&#x60;image_bmp&#x60;) inputs are now &#x60;stable&#x60; too (flipped 2026-06-30, UANjD38A). Per ADR-0004 + I4-CONS. - merge: Concatenate/combine multiple files into one (images, video, audio). Multi-input. Image inputs merge into animated GIF or slideshow video; image collage/grid and PDF concatenation are not supported by the V1 Lambda. - archive: Bundle files into ZIP/tar.gz (all types). Multi-input. - convert: Change file format (all types) - custom_luma: Apply a caller-uploaded luma matte to a base video for a custom luma-matte transition effect. Multi-input (&#x60;role: base&#x60; + &#x60;role: transition_mask&#x60;). &#x60;availability: planned&#x60; + &#x60;required_tier: pro&#x60;; dispatch returns &#x60;feature_not_available&#x60; (422) until Lambda ships. Distinct from FFmpeg &#x60;xfade&#x3D;custom&#x60; (which is an expression, not an operation). Per ticket I29 (Trello EPUE5Vs1). - audio_overlay: Mix a secondary audio asset over a primary audio or video base (DJ tags, podcast intros/outros, station IDs, jingles). Multi-input (&#x60;role: base&#x60; + &#x60;role: overlay&#x60;). &#x60;availability: planned&#x60;; dispatch returns &#x60;feature_not_available&#x60; (422) until Lambda ships. **NOT** the same as &#x60;audio_watermark&#x60; — that operation is steganographic (imperceptible identifier embedded for ownership tracking), tracked separately by I20. Per ticket I19 (Trello Xr3Z4GBF). - audio_watermark: Embed a steganographic forensic watermark into an audio asset (or a video&#39;s audio track) — Cinavia / Resemble PerTh territory. Single-input. &#x60;availability: planned&#x60; + &#x60;required_tier: enterprise&#x60;; dispatch returns &#x60;feature_not_available&#x60; (422) until Lambda ships. Pairs with &#x60;POST /api/audio-watermark/decode&#x60; for own-watermarks-only extraction. Per ticket I20 (Trello omiCq7Vn). - audio_to_video: Produce a video from an audio input plus an OPTIONAL still image overlay. Multi-input role-based with the first OPTIONAL role on the contract (&#x60;role: base&#x60; audio required, &#x60;role: overlay&#x60; image 0..1 — see &#x60;per_role_cardinality&#x60;). When overlay is omitted, the video uses a solid background colour. &#x60;availability: beta&#x60; (Wave A — Lambda backend live; opt-in, MUST NOT return &#x60;feature_not_available&#x60;; may change with notice). Per ticket [&#x60;SlluxMBN&#x60;](https://trello.com/c/SlluxMBN) + ADR-0015 (introduces &#x60;per_role_cardinality&#x60; vocab). - video_watermark: Apply an image overlay onto a base video via FFmpeg&#39;s &#x60;overlay&#x60; filter. Multi-input role-based (&#x60;role: base&#x60; video + &#x60;role: overlay&#x60; image, exactly one of each per &#x60;per_role_cardinality&#x60;). Re-encode required; audio stream-copy passthrough. Distinct from &#x60;image_watermark&#x60; (pure-Rust/image-only). &#x60;availability: beta&#x60; (Wave A — Lambda backend live; opt-in, MUST NOT 422; &#x60;short_form&#x60; is beta, &#x60;long_form&#x60; stays &#x60;planned&#x60; — no live Fargate worker; &#x60;multi_overlay_stack&#x60; stays &#x60;planned&#x60;). Per ticket [&#x60;4NrRPCgh&#x60;](https://trello.com/c/4NrRPCgh) + ADR-0013. - video_text_watermark: Render a text overlay onto a base video via FFmpeg&#39;s &#x60;drawtext&#x60; filter. Single-input — text and styling in options. Same &#x60;watermark_mode&#x60; (single/tiled), anchor + margin vocab as &#x60;text_watermark&#x60;. Re-encode required; audio stream-copy passthrough. &#x60;availability: planned&#x60;; dispatch returns &#x60;feature_not_available&#x60; (422) until Lambda ships. Per ticket [&#x60;4NrRPCgh&#x60;](https://trello.com/c/4NrRPCgh) + ADR-0013. - split: Fan one input file into N outputs across GIF / PDF / audio / video MIME families. Single-input per-mime-group catalog (mirrors merge/convert): GIF uses &#x60;frame_range&#x60; (REQUIRED) + &#x60;output_format&#x60;; PDF uses &#x60;page_range&#x60; OR &#x60;page_groups&#x60; (mutually exclusive); audio + video use a &#x60;mode&#x60; discriminator (interval/count/cut_points) + numeric-seconds wire format + &#x60;precision&#x60; flag (fast/exact). 200-output hard cap per ADR-0009 §D5 with per-mode preflight math; output naming &#x60;output-001..output-200&#x60;. Long-form video routes to a separate &#x60;split-video-fargate&#x60; worker via &#x60;processing_class&#x60;. &#x60;availability: beta&#x60; for the &#x60;audio&#x60; and &#x60;video&#x60; mime_groups (workers live on staging — shape-stable + opt-in, MUST NOT 422); video activates BOTH classes (&#x60;video.processing_class.short_form: beta&#x60; AND &#x60;long_form: beta&#x60; — &#x60;split-video-fargate&#x60; deployed + wired on staging but NOT yet proven end-to-end per [&#x60;rcwvUKhI&#x60;](https://trello.com/c/rcwvUKhI); the first customer-path soak has not completed, the 4GB+ speed-up is unmeasured, and the long-form fan-out is flag-gated dark). The &#x60;image_gif&#x60; and &#x60;document_pdf&#x60; mime_groups stay &#x60;availability: planned&#x60; and dispatch returns &#x60;feature_not_available&#x60; (422) until their workers ship. Per ticket [&#x60;vKI0CFDu&#x60;](https://trello.com/c/vKI0CFDu) + ADR-0014. - passthrough: Inert lossless source operation. A single-input source job whose SOLE operation is &#x60;passthrough&#x60; emits its source bytes UNCHANGED — no compression, no Lambda. The API self-completes the job at publish (terminal output &#x3D; the upload &#x60;{bucket, key}&#x60; unchanged). Its purpose is to feed an uploaded file into a multi-input operation LOSSLESSLY: because &#x60;JobInputV2.source&#x60; is narrowed to exclude upload-direct, an upload that must enter a &#x60;merge&#x60; / &#x60;archive&#x60; / &#x60;image_watermark&#x60; op enters via a &#x60;passthrough&#x60; source job referenced downstream by &#x60;{type: job_output, from: &lt;id&gt;}&#x60; — preserving billing / DAG / lineage. Distinct from &#x60;operations: []&#x60; (which keeps its implicit-compress meaning on a single-input upload job); &#x60;passthrough&#x60; is the EXPLICIT lossless path via the \&quot;non-empty &#x60;operations[]&#x60; without &#x60;compress&#x60; &#x3D; compression opt-out\&quot; rule. Media-agnostic; no options. &#x60;availability: beta&#x60; — activated (the inputs[]-narrowing + passthrough self-complete mechanism is deployed API-side); workflow-create accepts &#x60;passthrough&#x60; source jobs and MUST NOT return &#x60;feature_not_available&#x60;. **Never published to SNS** — deliberately absent from the AsyncAPI routing enums (API self-completes; no &#x60;ops-passthrough&#x60; queue). Per ticket [&#x60;4som89Uh&#x60;](https://trello.com/c/4som89Uh) + ADR-0004 (planned→beta flip).  - transform: Geometric/orientation transform — v1 &#x3D; rotate (0/90/180/270) + flip (none/horizontal/vertical/both), ADR-0026. Single-input; &#x60;produces: same_as_input&#x60; (geometry preserves format/container). Chainable (NOT sole_op); canonical single-job chain order is &#x60;transform → convert → compress → thumbnail&#x60; (geometry before encode/derive so downstream width/height/fit refer to the final frame). Media groups: image (still jpeg/png/webp + animated &#x60;image_gif&#x60;), video (mp4/webm), document (PDF page-rotate only — no flip); audio not supported. ALL groups &#x60;availability: planned&#x60; (epic &#x60;fhiWebI0&#x60;) — workflow-create returns &#x60;feature_not_available&#x60; (422) until per-media Lambdas ship. A no-op transform (&#x60;rotate: 0&#x60; + &#x60;flip: none&#x60;) is rejected as &#x60;invalid_options&#x60;. The public operation type is &#x60;transform&#x60;; the API resolves an internal per-media SNS routing sub-type (&#x60;transform_image&#x60; / &#x60;transform_video&#x60; / &#x60;transform_document&#x60;) — those sub-types are routing-only and are NOT part of this public enum. Per ADR-0026.  Both the legacy &#x60;thumbnail&#x60; value and the four sub-type values are valid routing targets today during the thumbnail migration window. See &#x60;asyncapi/events.yaml&#x60; for the full routing vocabulary and the publisher branching rule.  V1 &#x60;watermark&#x60; operation removed at V2 cutover (I4-CONS) — replaced by &#x60;image_watermark&#x60; + &#x60;text_watermark&#x60; per ADR-0004 §\&quot;Greenfield V2.0 cutover\&quot;.
 * @package  Gisl\Generated\OpenApi
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */
class OperationType
{
    /**
     * Possible values of this enum
     */
    public const COMPRESS = 'compress';

    public const THUMBNAIL = 'thumbnail';

    public const THUMBNAIL_IMAGE = 'thumbnail_image';

    public const THUMBNAIL_VIDEO = 'thumbnail_video';

    public const THUMBNAIL_DOCUMENT = 'thumbnail_document';

    public const THUMBNAIL_OFFICE = 'thumbnail_office';

    public const IMAGE_WATERMARK = 'image_watermark';

    public const TEXT_WATERMARK = 'text_watermark';

    public const RENDER_VARIANTS = 'render_variants';

    public const MERGE = 'merge';

    public const ARCHIVE = 'archive';

    public const CONVERT = 'convert';

    public const CUSTOM_LUMA = 'custom_luma';

    public const AUDIO_OVERLAY = 'audio_overlay';

    public const AUDIO_WATERMARK = 'audio_watermark';

    public const AUDIO_TO_VIDEO = 'audio_to_video';

    public const VIDEO_WATERMARK = 'video_watermark';

    public const VIDEO_TEXT_WATERMARK = 'video_text_watermark';

    public const SPLIT = 'split';

    public const TRANSFORM = 'transform';

    public const PASSTHROUGH = 'passthrough';

    /**
     * Gets allowable values of the enum
     * @return string[]
     */
    public static function getAllowableEnumValues()
    {
        return [
            self::COMPRESS,
            self::THUMBNAIL,
            self::THUMBNAIL_IMAGE,
            self::THUMBNAIL_VIDEO,
            self::THUMBNAIL_DOCUMENT,
            self::THUMBNAIL_OFFICE,
            self::IMAGE_WATERMARK,
            self::TEXT_WATERMARK,
            self::RENDER_VARIANTS,
            self::MERGE,
            self::ARCHIVE,
            self::CONVERT,
            self::CUSTOM_LUMA,
            self::AUDIO_OVERLAY,
            self::AUDIO_WATERMARK,
            self::AUDIO_TO_VIDEO,
            self::VIDEO_WATERMARK,
            self::VIDEO_TEXT_WATERMARK,
            self::SPLIT,
            self::TRANSFORM,
            self::PASSTHROUGH
        ];
    }
}


