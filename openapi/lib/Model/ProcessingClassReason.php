<?php
/**
 * ProcessingClassReason
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
 * The version of the OpenAPI document: 2.194.0
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
 * ProcessingClassReason Class Doc Comment
 *
 * @category Class
 * @description Why a job was assigned its &#x60;processing_class&#x60;. - &#x60;within_short_form_limits&#x60;: emitted on &#x60;short_form&#x60; jobs   whose inputs fit within the short_form constraints; the   benign / no-routing-needed default. - &#x60;input_size_exceeds_short_form&#x60; /   &#x60;input_duration_exceeds_short_form&#x60;: input-driven escalation   to &#x60;long_form&#x60;. - &#x60;merge_re_encode_long_form&#x60; / &#x60;requires_reencode&#x60;: merge   inputs require re-encoding so concat-fast-path is   unavailable; &#x60;requires_reencode&#x60; cross-references ticket   I16-CONS (Trello &#x60;7nCZXEru&#x60;) — the &#x60;merge.video&#x60; re-encode   decision visible on &#x60;OperationMetrics.re_encode_decision&#x60;   (operation-result time) is also surfaced here at   workflow-create time. - &#x60;tier_policy&#x60;: emitted when the caller&#39;s   &#x60;processing.class_hint&#x60; (e.g. &#x60;short_form_only&#x60;) forced   the decision rather than input characteristics. - &#x60;input_metrics_unavailable&#x60;: **the classifier did not have   every metric the decision required.** One or more of the   duration / size figures it needed was unavailable at   create-plan time (e.g. an upload probe had not landed), so a   class was DEFAULTED rather than chosen. Note this covers the   PARTIAL case as well as the none-at-all case — see below;   having *some* metrics is not having the metric the decision   required. **This is the only   value that does not assert a measurement.** Every other value   states a fact about the input; this one states that no such   fact was obtained.    **It is a reason a class was DEFAULTED, not a reason a class   was CHOSEN** — despite sitting in &#x60;ProcessingClassReason&#x60;.   Read it as *no routing claim was made*. Consumers MUST NOT   read the assigned &#x60;processing_class&#x60; as evidence the input   fits that class&#39;s constraints when this reason is present,   and MUST NOT surface it as a positive statement about the   file.    **Partial measurement usually counts as unmeasured.** On a   multi-input operation, emit this whenever a contributing   input lacked the metric the decision needed — a sum over the   inputs that happened to be probed is not a measurement of the   request, even though it is not empty either. The honest   predicate is \&quot;did I have every metric this decision required\&quot;,   not \&quot;did I have some\&quot;.    **The exception, and it is a principle rather than a special   case: partial evidence that is DECISIVE is still evidence.**   Ask whether the missing data could FALSIFY the claim the   reason makes:    - &#x60;within_short_form_limits&#x60; claims the input **fits**. An     unmeasured input can only ADD to the sum, so it could push     the request over the cap — the missing data can falsify the     claim. This reason therefore requires COMPLETE measurement,     and a partial sum must report &#x60;input_metrics_unavailable&#x60;.   - &#x60;input_duration_exceeds_short_form&#x60; /     &#x60;input_size_exceeds_short_form&#x60; claim the input **exceeds**     a cap. The sums are MONOTONE — they only grow — so once the     measured subset alone crosses the cap, the missing data     cannot falsify the claim. The escalation is positively     evidenced, and the decision did not *need* the missing     metric. **Report the real reason, NOT     &#x60;input_metrics_unavailable&#x60;.**    Reporting \&quot;I could not measure\&quot; for a decision that WAS   positively evidenced is a lie in the opposite direction, and   it costs twice: it understates what the server knew, and —   because this field carries one value — it MASKS a more   specific true reason such as &#x60;merge_re_encode_long_form&#x60;.    **Generalise by the falsifiability test, not by the list   above.** If a future cap is a band rather than a ceiling, or   a metric can reduce a total, the monotonicity no longer holds   and the exception does not apply.    **Known limit, stated so it is not later read as a gap in a   completed fix:** an input whose probe landed with a duration   of **zero** counts as MEASURED and contributes 0 to the sum.   That is indistinguishable from a genuine zero-length input   from outside the classifier, so this value does not and   cannot cover it.  **Why this value exists (2026-07-28).** A deduplicated upload (and, independently, a fresh upload racing an async probe) reaches create-plan with no duration, and a 62-minute merge was assigned &#x60;short_form&#x60; with reason &#x60;within_short_form_limits&#x60; — an affirmative claim that a 62-minute input fits inside a &#x60;PT5M&#x60; cap. The fallback was indistinguishable from a genuine measurement, so the mis-route was invisible. A classifier that cannot say *\&quot;I did not know\&quot;* has no way to be honest; this value is that sentence. Emit it in preference to a measurement-asserting value whenever the metrics were absent, even if the class ultimately chosen happens to be correct.
 * @package  Gisl\Generated\OpenApi
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */
class ProcessingClassReason
{
    /**
     * Possible values of this enum
     */
    public const WITHIN_SHORT_FORM_LIMITS = 'within_short_form_limits';

    public const INPUT_SIZE_EXCEEDS_SHORT_FORM = 'input_size_exceeds_short_form';

    public const INPUT_DURATION_EXCEEDS_SHORT_FORM = 'input_duration_exceeds_short_form';

    public const MERGE_RE_ENCODE_LONG_FORM = 'merge_re_encode_long_form';

    public const REQUIRES_REENCODE = 'requires_reencode';

    public const TIER_POLICY = 'tier_policy';

    public const INPUT_METRICS_UNAVAILABLE = 'input_metrics_unavailable';

    /**
     * Gets allowable values of the enum
     * @return string[]
     */
    public static function getAllowableEnumValues()
    {
        return [
            self::WITHIN_SHORT_FORM_LIMITS,
            self::INPUT_SIZE_EXCEEDS_SHORT_FORM,
            self::INPUT_DURATION_EXCEEDS_SHORT_FORM,
            self::MERGE_RE_ENCODE_LONG_FORM,
            self::REQUIRES_REENCODE,
            self::TIER_POLICY,
            self::INPUT_METRICS_UNAVAILABLE
        ];
    }
}


