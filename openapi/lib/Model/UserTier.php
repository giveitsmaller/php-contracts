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
 * The version of the OpenAPI document: 2.210.0
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
 * @description Subscription tier. Mirrors the API-side &#x60;App\\Identity\\Domain\\Enums\\UserTier&#x60; PHP enum.  &#x60;basic&#x60; is the base tier. **&#x60;free&#x60; is DEPRECATED and will be removed** ([&#x60;nD8fCPDy&#x60;](https://trello.com/c/nD8fCPDy)) — the two are one tier under two names, never two tiers, and a consumer must rank them identically. The dated record of the rename and of the rollout that carried it is [ADR-0028](../docs/decisions/0028-base-tier-rename-free-to-basic.md).  🔴 **&#x60;guest&#x60; IS NOT AND MUST NOT BECOME A MEMBER OF THIS ENUM.** It is the *absence* of a subscription, not a tier. Putting it here places a non-subscription value inside the ordering that drives upgrade prompts, where it has no position — **that conflation already shipped once as a bug and was deliberately removed.** The audience key lives on the audience axis, which is NOT a &#x60;UserTier&#x60; value. Asserted by a test, not left to prose.  Ordering is &#x60;basic&#x60; &lt; &#x60;pro&#x60; &lt; &#x60;max&#x60; &lt; &#x60;enterprise&#x60; (the upgrade-resolver / &#x60;isHigherThan&#x60; ordinal in &#x60;UserTier.php&#x60;). **The ordering is the part this contract owns** — it is what &#x60;TierRestrictionResponse.current_tier&#x60; / &#x60;.required_tier&#x60; and &#x60;FeatureViolation.required_tier&#x60; are compared with.  🔴 **THIS SCHEMA DELIBERATELY DOES NOT ENUMERATE WHAT EACH TIER MAY DO, IN EITHER DIRECTION.** It previously carried a per-tier capability summary — upload caps, permitted MIME families, monthly credits, overdraft, rate-limit multiples, concurrent long-form jobs. **That was a restated SNAPSHOT of another repository&#39;s code, and it drifted, twice:** once asserting a per-tier media restriction this contract does not own and cannot keep true, and once listing tier byte defaults while **silently omitting &#x60;max&#x60;**, a tier this very enum declares.  **A description ships to every SDK consumer as generated documentation**, so a stale sentence here is not an internal note — it is an assertion delivered to callers, and it outlives the code it describes. *Point at the gate, not at a snapshot of it.*  ⚠️ **No claim is made HERE about which media categories a tier permits.** That is a scoping statement about this description, **not a claim that the contract is silent on the subject**: hub decision 25 made audio universal, so there is no tier boundary at which the category axis changes. **Prose that restates another repository&#39;s enforcement is the defect; a single generated declaration is the fix**, and the two must not both exist.  **Where the answers actually live — and they are DIFFERENT SURFACES, which is why naming just one was wrong:**  - **Which media categories are available** — the capability   endpoint&#39;s &#x60;operations&#x60; map, per operation and mime_group   block. Declared **once, not per audience**, because the axis does not   vary. ⚠️ **&#x60;GET /api/v2/account/limits&#x60; cannot answer this**: it   carries numeric limit entries only and exposes no MIME entitlement   data at all. - **A caller&#39;s own numeric limits** — override-aware, and the only   source reflecting account-level overrides:   &#x60;GET /api/v2/account/limits&#x60; (&#x60;AccountLimits&#x60;). Its &#x60;limits&#x60; map is   typed-open, so new limit keys arrive additively. - **Enforcement of record**: the API&#39;s &#x60;UserTier&#x60; enum. A &#x60;403&#x60;   &#x60;tier_restriction&#x60; carries &#x60;TierRestrictionKind&#x60; — &#x60;mime_type&#x60; or   &#x60;file_size&#x60; — naming which quota refused the request. - **Per-operation processing ceilings** (a different axis and a   different number from the per-file upload cap):   &#x60;processing_class.constraints&#x60; and &#x60;per_tier_constraints&#x60; in the   operation schemas.  **Concurrent long-form jobs** remain a hard per-tier ceiling enforced server-side; exceeding it returns a typed &#x60;429&#x60; &#x60;LONG_FORM_CONCURRENCY_LIMIT_EXCEEDED&#x60; (see the &#x60;POST /api/workflows&#x60; 429 response). **The per-tier numbers are deliberately not restated here** — read them from the source above.
 * @package  Gisl\Generated\OpenApi
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */
class UserTier
{
    /**
     * Possible values of this enum
     */
    public const BASIC = 'basic';

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
            self::BASIC,
            self::FREE,
            self::PRO,
            self::MAX,
            self::ENTERPRISE
        ];
    }
}


