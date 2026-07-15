<?php
/**
 * AuthErrorType
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
 * The version of the OpenAPI document: 2.166.0
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
 * AuthErrorType Class Doc Comment
 *
 * @category Class
 * @description Machine-readable discriminator for auth HTTP errors (401/403). Distinct from rate-limit 429 responses, which carry no &#x60;error_type&#x60; and use the plain &#x60;ErrorEnvelope&#x60; with a &#x60;Retry-After&#x60; header.  Values are emitted by these auth mechanisms on the server:  - **Login** (&#x60;POST /api/auth/login&#x60;) — password-based authentication.   Emits &#x60;invalid_credentials&#x60; ONLY (all account-status failures   collapse into it; see Mc6wiUzc). - **&#x60;ApiEntryPoint&#x60;** — challenge emitted on any protected route   when no authenticated principal is present. - **&#x60;ApiKeyAuthenticator&#x60;** — validates &#x60;Authorization: Bearer &lt;key&gt;&#x60;   headers on the &#x60;api&#x60; firewall. - **&#x60;AccountStatusEnforcerListener&#x60;** — per-request live-session   enforcement (ticket e8eSElvD): returns &#x60;403 account_*&#x60; on an   authenticated stateful request when the account is revoked   mid-session.  Per-value attribution:  - &#x60;invalid_credentials&#x60; (Login): wrong password, correct password on an   unverified account, OR any persisted account-status failure (locked /   disabled / deleted / deletion-expired). **All collapsed into this one   value** so login never leaks account existence or state   (anti-enumeration; Mc6wiUzc) — consistent with the registration +   password-reset flows. The &#x60;account_*&#x60; values below are therefore NOT   emitted on login. - &#x60;account_locked&#x60; (&#x60;ApiKeyAuthenticator&#x60; OR &#x60;AccountStatusEnforcerListener&#x60;):   account is in a persisted locked state. Emitted as &#x60;403&#x60; when a VALID   API key&#39;s owner is locked, or when the live-session enforcer acts on a   locked account — NOT on login (a login attempt against a locked   account collapses to &#x60;401 invalid_credentials&#x60;). A valid key / live   session only reveals the caller&#39;s OWN status, so this is not an   enumeration oracle. - &#x60;account_disabled&#x60; (same surfaces): account disabled by an administrator. - &#x60;account_deleted&#x60; (same surfaces): account has been deleted. - &#x60;account_deletion_expired&#x60; (same surfaces): grace period expired after   a user-initiated deletion request. - &#x60;authentication_required&#x60; (&#x60;ApiEntryPoint&#x60;): unauthenticated   request reached an endpoint that requires authentication.   Emitted as a 401 challenge; no credentials were presented or   the session is absent/expired. (Endpoint-level auth requirements   are not declared in this spec yet — tracked as a separate   housekeeping item to wire &#x60;security&#x60; requirements per route.) - &#x60;api_key_invalid&#x60; (&#x60;ApiKeyAuthenticator&#x60;): API key not found, resolves   to a user that does not exist, OR is no longer active (revoked). All   cases are intentionally collapsed for anti-enumeration (same reasoning   as &#x60;invalid_credentials&#x60;); the former distinct &#x60;api_key_revoked&#x60; value   was removed in Mc6wiUzc.
 * @package  Gisl\Generated\OpenApi
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */
class AuthErrorType
{
    /**
     * Possible values of this enum
     */
    public const INVALID_CREDENTIALS = 'invalid_credentials';

    public const ACCOUNT_LOCKED = 'account_locked';

    public const ACCOUNT_DISABLED = 'account_disabled';

    public const ACCOUNT_DELETED = 'account_deleted';

    public const ACCOUNT_DELETION_EXPIRED = 'account_deletion_expired';

    public const AUTHENTICATION_REQUIRED = 'authentication_required';

    public const API_KEY_INVALID = 'api_key_invalid';

    /**
     * Gets allowable values of the enum
     * @return string[]
     */
    public static function getAllowableEnumValues()
    {
        return [
            self::INVALID_CREDENTIALS,
            self::ACCOUNT_LOCKED,
            self::ACCOUNT_DISABLED,
            self::ACCOUNT_DELETED,
            self::ACCOUNT_DELETION_EXPIRED,
            self::AUTHENTICATION_REQUIRED,
            self::API_KEY_INVALID
        ];
    }
}


