<?php
/**
 * UserTier
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
 * The version of the OpenAPI document: 2.180.0
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
 * UserTier Class Doc Comment
 *
 * @category Class
 * @description Subscription tier. Mirrors the API-side &#x60;App\\Identity\\Domain\\Enums\\UserTier&#x60; PHP enum.  Ordering is &#x60;free&#x60; &lt; &#x60;pro&#x60; &lt; &#x60;max&#x60; &lt; &#x60;enterprise&#x60; (the upgrade-resolver / &#x60;isHigherThan&#x60; ordinal in &#x60;UserTier.php&#x60;). &#x60;max&#x60; is the top **self-serve** tier — Pro plus audio + larger long-form bands; Enterprise remains the negotiated tier above it.  Tier capability summary (informational; canonical limits are enforced server-side per &#x60;UserTier.php&#x60;): - &#x60;free&#x60;: 10 MiB max upload; image MIMEs only; 50 monthly credits;   0 overdraft; 1× rate-limit baseline. No long-form access   (video/audio are MIME-gated away from Free). - &#x60;pro&#x60;: 5 GiB max upload; image + video + document MIMEs; 1000   monthly credits; 200 overdraft; 5× rate-limit; up to 2 concurrent   in-flight long-form jobs. - &#x60;max&#x60;: 50 GiB max upload; image + video + document + audio MIMEs;   7500 monthly credits; 2500 overdraft; 15× rate-limit; up to 5   concurrent in-flight long-form jobs. - &#x60;enterprise&#x60;: 100 GiB max upload; image + video + document + audio   MIMEs; 10000 monthly credits; 5000 overdraft; 20× rate-limit;   uncapped concurrent long-form jobs.  **Concurrent long-form jobs** is a hard per-tier ceiling on the number of in-flight long-form (Fargate) workflows a caller may hold at once — exceeding it returns a typed &#x60;429&#x60; &#x60;LONG_FORM_CONCURRENCY_LIMIT_EXCEEDED&#x60; (see the &#x60;POST /api/workflows&#x60; 429 response). Pro&#39;s 2-job cap is enforced as of the Max-tier launch.  The \&quot;max upload\&quot; figures are the per-file upload cap (&#x60;UserTier.maxFileSizeBytes&#x60;) — the request-level tier quota, surfaced override-aware via &#x60;GET /api/v2/account/limits&#x60; (&#x60;max_upload_size_bytes&#x60;). They are DISTINCT from the per-operation processing-class band caps (&#x60;processing_class.constraints&#x60; in the operation schemas; e.g. the 120 GB Enterprise merge combined band).  Used by &#x60;TierRestrictionResponse.current_tier&#x60; / &#x60;TierRestrictionResponse.required_tier&#x60; and by &#x60;FeatureViolation.required_tier&#x60;.
 * @package  Gisl\Generated\OpenApi
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */
class UserTier
{
    /**
     * Possible values of this enum
     */
    public const FREE = 'free';

    public const PRO = 'pro';

    public const MAX = 'max';

    public const ENTERPRISE = 'enterprise';

    /**
     * Gets allowable values of the enum
     * @return string[]
     */
    public static function getAllowableEnumValues()
    {
        return [
            self::FREE,
            self::PRO,
            self::MAX,
            self::ENTERPRISE
        ];
    }
}


