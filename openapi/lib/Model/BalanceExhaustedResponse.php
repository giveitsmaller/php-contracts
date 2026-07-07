<?php
/**
 * BalanceExhaustedResponse
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
 * The version of the OpenAPI document: 2.162.0
 * Generated by: https://openapi-generator.tech
 * Generator version: 7.21.0
 */

/**
 * NOTE: This class is auto generated by OpenAPI Generator (https://openapi-generator.tech).
 * https://openapi-generator.tech
 * Do not edit the class manually.
 */

namespace Gisl\Generated\OpenApi\Model;

use \ArrayAccess;
use \Gisl\Generated\OpenApi\ObjectSerializer;

/**
 * BalanceExhaustedResponse Class Doc Comment
 *
 * @category Class
 * @description 402 response body emitted from &#x60;POST /api/workflows&#x60; when the server-side cost estimate exceeds the caller&#39;s &#x60;available_credits&#x60; (monthly + purchased + overdraft headroom). Per ticket [I23 &#x60;DffjC3zm&#x60;](https://trello.com/c/DffjC3zm) F9 atomic- reservation invariant.  Carries &#x60;error_type: balance_exhausted&#x60; plus a structured &#x60;required_action&#x60; (one of &#x60;add_credits&#x60;, &#x60;upgrade_plan&#x60;, &#x60;wait_for_renewal&#x60;) and &#x60;links&#x60; to the relevant top-up / upgrade page.  **Deliberate omission.** This envelope carries NO numeric deficit fields (no &#x60;required&#x60;, &#x60;available&#x60;, &#x60;shortfall&#x60;). Per plan v5 §F9 round 13 — frontend reads the current state from &#x60;GET /api/v2/credits/balance&#x60;, not from the error envelope. Decoupling the error from numeric state keeps the 402 wire shape stable as cost-model granularity changes (e.g. shift to per-second micro-credits). Frontend re-fetches balance after a 402.  Carries the optional localisation triple (&#x60;message_key&#x60; + &#x60;message&#x60; + &#x60;locale&#x60; + &#x60;message_params&#x60;) per ticket [I26](https://trello.com/c/rcnqwgI4) — see &#x60;ErrorEnvelope&#x60; for the canonical convention. &#x60;message_params&#x60; excludes cost / monetary numbers per the round-13 narrowing (frontend reads numeric balance from &#x60;/credits/balance&#x60;).
 * @package  Gisl\Generated\OpenApi
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<string, mixed>
 */
class BalanceExhaustedResponse implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
     * The original name of the model.
     *
     * @var string
     */
    protected static $openAPIModelName = 'BalanceExhaustedResponse';

    /**
     * Array of property to type mappings. Used for (de)serialization
     *
     * @var string[]
     */
    protected static $openAPITypes = [
        'success' => 'bool',
        'error' => 'string',
        'message' => 'string',
        'message_key' => 'string',
        'locale' => 'string',
        'message_params' => 'array<string,mixed>',
        'error_type' => 'string',
        'required_action' => 'string',
        'links' => '\Gisl\Generated\OpenApi\Model\BalanceExhaustedResponseAllOfLinks'
    ];

    /**
     * Array of property to format mappings. Used for (de)serialization
     *
     * @var string[]
     * @phpstan-var array<string, string|null>
     * @psalm-var array<string, string|null>
     */
    protected static $openAPIFormats = [
        'success' => null,
        'error' => null,
        'message' => null,
        'message_key' => null,
        'locale' => null,
        'message_params' => null,
        'error_type' => null,
        'required_action' => null,
        'links' => null
    ];

    /**
     * Array of nullable properties. Used for (de)serialization
     *
     * @var boolean[]
     */
    protected static array $openAPINullables = [
        'success' => false,
        'error' => false,
        'message' => false,
        'message_key' => false,
        'locale' => false,
        'message_params' => false,
        'error_type' => false,
        'required_action' => false,
        'links' => false
    ];

    /**
     * If a nullable field gets set to null, insert it here
     *
     * @var boolean[]
     */
    protected array $openAPINullablesSetToNull = [];

    /**
     * Array of property to type mappings. Used for (de)serialization
     *
     * @return array
     */
    public static function openAPITypes()
    {
        return self::$openAPITypes;
    }

    /**
     * Array of property to format mappings. Used for (de)serialization
     *
     * @return array
     */
    public static function openAPIFormats()
    {
        return self::$openAPIFormats;
    }

    /**
     * Array of nullable properties
     *
     * @return array
     */
    protected static function openAPINullables(): array
    {
        return self::$openAPINullables;
    }

    /**
     * Array of nullable field names deliberately set to null
     *
     * @return boolean[]
     */
    private function getOpenAPINullablesSetToNull(): array
    {
        return $this->openAPINullablesSetToNull;
    }

    /**
     * Setter - Array of nullable field names deliberately set to null
     *
     * @param boolean[] $openAPINullablesSetToNull
     */
    private function setOpenAPINullablesSetToNull(array $openAPINullablesSetToNull): void
    {
        $this->openAPINullablesSetToNull = $openAPINullablesSetToNull;
    }

    /**
     * Checks if a property is nullable
     *
     * @param string $property
     * @return bool
     */
    public static function isNullable(string $property): bool
    {
        return self::openAPINullables()[$property] ?? false;
    }

    /**
     * Checks if a nullable property is set to null.
     *
     * @param string $property
     * @return bool
     */
    public function isNullableSetToNull(string $property): bool
    {
        return in_array($property, $this->getOpenAPINullablesSetToNull(), true);
    }

    /**
     * Array of attributes where the key is the local name,
     * and the value is the original name
     *
     * @var string[]
     */
    protected static $attributeMap = [
        'success' => 'success',
        'error' => 'error',
        'message' => 'message',
        'message_key' => 'message_key',
        'locale' => 'locale',
        'message_params' => 'message_params',
        'error_type' => 'error_type',
        'required_action' => 'required_action',
        'links' => 'links'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'success' => 'setSuccess',
        'error' => 'setError',
        'message' => 'setMessage',
        'message_key' => 'setMessageKey',
        'locale' => 'setLocale',
        'message_params' => 'setMessageParams',
        'error_type' => 'setErrorType',
        'required_action' => 'setRequiredAction',
        'links' => 'setLinks'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'success' => 'getSuccess',
        'error' => 'getError',
        'message' => 'getMessage',
        'message_key' => 'getMessageKey',
        'locale' => 'getLocale',
        'message_params' => 'getMessageParams',
        'error_type' => 'getErrorType',
        'required_action' => 'getRequiredAction',
        'links' => 'getLinks'
    ];

    /**
     * Array of attributes where the key is the local name,
     * and the value is the original name
     *
     * @return array
     */
    public static function attributeMap()
    {
        return self::$attributeMap;
    }

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @return array
     */
    public static function setters()
    {
        return self::$setters;
    }

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @return array
     */
    public static function getters()
    {
        return self::$getters;
    }

    /**
     * The original name of the model.
     *
     * @return string
     */
    public function getModelName()
    {
        return self::$openAPIModelName;
    }

    public const ERROR_TYPE_BALANCE_EXHAUSTED = 'balance_exhausted';
    public const REQUIRED_ACTION_ADD_CREDITS = 'add_credits';
    public const REQUIRED_ACTION_UPGRADE_PLAN = 'upgrade_plan';
    public const REQUIRED_ACTION_WAIT_FOR_RENEWAL = 'wait_for_renewal';

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getErrorTypeAllowableValues()
    {
        return [
            self::ERROR_TYPE_BALANCE_EXHAUSTED,
        ];
    }

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getRequiredActionAllowableValues()
    {
        return [
            self::REQUIRED_ACTION_ADD_CREDITS,
            self::REQUIRED_ACTION_UPGRADE_PLAN,
            self::REQUIRED_ACTION_WAIT_FOR_RENEWAL,
        ];
    }

    /**
     * Associative array for storing property values
     *
     * @var mixed[]
     */
    protected $container = [];

    /**
     * Constructor
     *
     * @param mixed[]|null $data Associated array of property values
     *                      initializing the model
     */
    public function __construct(?array $data = null)
    {
        $this->setIfExists('success', $data ?? [], null);
        $this->setIfExists('error', $data ?? [], null);
        $this->setIfExists('message', $data ?? [], null);
        $this->setIfExists('message_key', $data ?? [], null);
        $this->setIfExists('locale', $data ?? [], null);
        $this->setIfExists('message_params', $data ?? [], null);
        $this->setIfExists('error_type', $data ?? [], null);
        $this->setIfExists('required_action', $data ?? [], null);
        $this->setIfExists('links', $data ?? [], null);
    }

    /**
     * Sets $this->container[$variableName] to the given data or to the given default Value; if $variableName
     * is nullable and its value is set to null in the $fields array, then mark it as "set to null" in the
     * $this->openAPINullablesSetToNull array
     *
     * @param string $variableName
     * @param array  $fields
     * @param mixed  $defaultValue
     */
    private function setIfExists(string $variableName, array $fields, $defaultValue): void
    {
        if (self::isNullable($variableName) && array_key_exists($variableName, $fields) && is_null($fields[$variableName])) {
            $this->openAPINullablesSetToNull[] = $variableName;
        }

        $this->container[$variableName] = $fields[$variableName] ?? $defaultValue;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        if ($this->container['success'] === null) {
            $invalidProperties[] = "'success' can't be null";
        }

        if ($this->container['error'] === null) {
            $invalidProperties[] = "'error' can't be null";
        }
        if ($this->container['error_type'] === null) {
            $invalidProperties[] = "'error_type' can't be null";
        }
        $allowedValues = $this->getErrorTypeAllowableValues();
        if (!is_null($this->container['error_type']) && !in_array($this->container['error_type'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'error_type', must be one of '%s'",
                $this->container['error_type'],
                implode("', '", $allowedValues)
            );
        }

        if ($this->container['required_action'] === null) {
            $invalidProperties[] = "'required_action' can't be null";
        }
        $allowedValues = $this->getRequiredActionAllowableValues();
        if (!is_null($this->container['required_action']) && !in_array($this->container['required_action'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'required_action', must be one of '%s'",
                $this->container['required_action'],
                implode("', '", $allowedValues)
            );
        }

        return $invalidProperties;
    }

    /**
     * Validate all the properties in the model
     * return true if all passed
     *
     * @return bool True if all properties are valid
     */
    public function valid()
    {
        return count($this->listInvalidProperties()) === 0;
    }


    /**
     * Gets success
     *
     * @return bool
     */
    public function getSuccess()
    {
        return $this->container['success'];
    }

    /**
     * Sets success
     *
     * @param bool $success success
     *
     * @return self
     */
    public function setSuccess($success)
    {
        if (is_null($success)) {
            throw new \InvalidArgumentException('non-nullable success cannot be null');
        }
        $this->container['success'] = $success;

        return $this;
    }

    /**
     * Gets error
     *
     * @return string
     */
    public function getError()
    {
        return $this->container['error'];
    }

    /**
     * Sets error
     *
     * @param string $error Stable, machine-readable error code (e.g. `INVALID_OPTIONS`, `BALANCE_EXHAUSTED`, `REQUIRES_REENCODE`). Canonical English; never localised. SDKs duck-type on this field for typed error-branch helpers.  Multipart-session resume codes (per ticket [`HxUmVr3Y`](https://trello.com/c/HxUmVr3Y), V2.10.0): - `MULTIPART_SESSION_NOT_FOUND` (404) — upload_id does   not match an in-flight session (expired / never   existed / wrong account namespace). Fired by /status,   /presign, /keepalive. - `MULTIPART_SESSION_OWNERSHIP` (403) — authenticated   caller is not the session owner. Fired by /status,   /presign, /keepalive, /complete (when manifest.userId   is non-null and differs). - `MULTIPART_SESSION_AUTH_REQUIRED` (403) — session was   anonymously initiated; the three resume endpoints   require authentication. The `8LABloaz` follow-up will   flip `/initiate` to also require auth. - `FILE_TOO_LARGE_FOR_MULTIPART` (422) — assembled object   would exceed the S3 multipart capacity cap. Pre-S3   server-side capacity gate; distinct from tier-quota   rejections (`upload_size_exceeds_tier`).  Workflow-create code (per ticket [`nGYbgChX`](https://trello.com/c/nGYbgChX) / sdks [`DRjIyMt9`](https://trello.com/c/DRjIyMt9)): - `UPLOAD_NOT_FOUND` (404) — a `POST /api/workflows` request   references an upload that does not exist OR exists but is   owned by a different identity (deliberate BOLA/IDOR   existence-mask: reported as not-found, **never 403**, so the   response does not reveal another user's upload exists).   `message_key: \"upload.not_found\"`. See the createWorkflow   404 response + ADR-0016 Amendment. - `LONG_FORM_CONCURRENCY_LIMIT_EXCEEDED` (429) — caller already   holds the maximum concurrent in-flight long-form workflows   their tier permits (Pro 2 / Max 5; Enterprise uncapped).   DISTINCT from an infra rate-limit 429: carries no   `Retry-After` (it clears on workflow completion) and adds a   `links.upgrade` CTA. `message_key:   \"job.long_form_concurrency_exceeded\"`. See the createWorkflow   429 response + `LongFormConcurrencyLimitResponse`.
     *
     * @return self
     */
    public function setError($error)
    {
        if (is_null($error)) {
            throw new \InvalidArgumentException('non-nullable error cannot be null');
        }
        $this->container['error'] = $error;

        return $this;
    }

    /**
     * Gets message
     *
     * @return string|null
     */
    public function getMessage()
    {
        return $this->container['message'];
    }

    /**
     * Sets message
     *
     * @param string|null $message Human-readable, optionally localised explanation. See `ErrorEnvelope.message`. Never parse for control flow.
     *
     * @return self
     */
    public function setMessage($message)
    {
        if (is_null($message)) {
            throw new \InvalidArgumentException('non-nullable message cannot be null');
        }
        $this->container['message'] = $message;

        return $this;
    }

    /**
     * Gets message_key
     *
     * @return string|null
     */
    public function getMessageKey()
    {
        return $this->container['message_key'];
    }

    /**
     * Sets message_key
     *
     * @param string|null $message_key Canonical lookup key per ticket [I26](https://trello.com/c/rcnqwgI4). See `ErrorEnvelope.message_key`.
     *
     * @return self
     */
    public function setMessageKey($message_key)
    {
        if (is_null($message_key)) {
            throw new \InvalidArgumentException('non-nullable message_key cannot be null');
        }
        $this->container['message_key'] = $message_key;

        return $this;
    }

    /**
     * Gets locale
     *
     * @return string|null
     */
    public function getLocale()
    {
        return $this->container['locale'];
    }

    /**
     * Sets locale
     *
     * @param string|null $locale BCP 47 locale tag. See `ErrorEnvelope.locale`.
     *
     * @return self
     */
    public function setLocale($locale)
    {
        if (is_null($locale)) {
            throw new \InvalidArgumentException('non-nullable locale cannot be null');
        }
        $this->container['locale'] = $locale;

        return $this;
    }

    /**
     * Gets message_params
     *
     * @return array<string,mixed>|null
     */
    public function getMessageParams()
    {
        return $this->container['message_params'];
    }

    /**
     * Sets message_params
     *
     * @param array<string,mixed>|null $message_params Optional interpolation values for the localised `message`. See `ErrorEnvelope.message_params`. **Excludes cost / monetary numbers** — frontend reads numeric balance from `GET /api/v2/credits/balance` per the round-13 narrowing.
     *
     * @return self
     */
    public function setMessageParams($message_params)
    {
        if (is_null($message_params)) {
            throw new \InvalidArgumentException('non-nullable message_params cannot be null');
        }
        $this->container['message_params'] = $message_params;

        return $this;
    }

    /**
     * Gets error_type
     *
     * @return string
     */
    public function getErrorType()
    {
        return $this->container['error_type'];
    }

    /**
     * Sets error_type
     *
     * @param string $error_type Discriminator value for this 402 envelope.
     *
     * @return self
     */
    public function setErrorType($error_type)
    {
        if (is_null($error_type)) {
            throw new \InvalidArgumentException('non-nullable error_type cannot be null');
        }
        $allowedValues = $this->getErrorTypeAllowableValues();
        if (!in_array($error_type, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'error_type', must be one of '%s'",
                    $error_type,
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['error_type'] = $error_type;

        return $this;
    }

    /**
     * Gets required_action
     *
     * @return string
     */
    public function getRequiredAction()
    {
        return $this->container['required_action'];
    }

    /**
     * Sets required_action
     *
     * @param string $required_action What the caller must do to retry successfully. - `add_credits`: caller has overdraft headroom only on   the purchased pool — buy a top-up. - `upgrade_plan`: caller's tier allowance is too small   for sustained use — upgrade to pro/enterprise. - `wait_for_renewal`: monthly cycle resets soon and   the caller's projected post-renewal balance covers   the cost — no money required.
     *
     * @return self
     */
    public function setRequiredAction($required_action)
    {
        if (is_null($required_action)) {
            throw new \InvalidArgumentException('non-nullable required_action cannot be null');
        }
        $allowedValues = $this->getRequiredActionAllowableValues();
        if (!in_array($required_action, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'required_action', must be one of '%s'",
                    $required_action,
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['required_action'] = $required_action;

        return $this;
    }

    /**
     * Gets links
     *
     * @return \Gisl\Generated\OpenApi\Model\BalanceExhaustedResponseAllOfLinks|null
     */
    public function getLinks()
    {
        return $this->container['links'];
    }

    /**
     * Sets links
     *
     * @param \Gisl\Generated\OpenApi\Model\BalanceExhaustedResponseAllOfLinks|null $links links
     *
     * @return self
     */
    public function setLinks($links)
    {
        if (is_null($links)) {
            throw new \InvalidArgumentException('non-nullable links cannot be null');
        }
        $this->container['links'] = $links;

        return $this;
    }
    /**
     * Returns true if offset exists. False otherwise.
     *
     * @param integer|string $offset Offset
     *
     * @return boolean
     */
    public function offsetExists(mixed $offset): bool
    {
        return isset($this->container[$offset]);
    }

    /**
     * Gets offset.
     *
     * @param integer|string $offset Offset
     *
     * @return mixed|null
     */
    #[\ReturnTypeWillChange]
    public function offsetGet(mixed $offset)
    {
        return $this->container[$offset] ?? null;
    }

    /**
     * Sets value based on offset.
     *
     * @param int|null $offset Offset
     * @param mixed    $value  Value to be set
     *
     * @return void
     */
    public function offsetSet($offset, $value): void
    {
        if (is_null($offset)) {
            $this->container[] = $value;
        } else {
            $this->container[$offset] = $value;
        }
    }

    /**
     * Unsets offset.
     *
     * @param integer|string $offset Offset
     *
     * @return void
     */
    public function offsetUnset(mixed $offset): void
    {
        unset($this->container[$offset]);
    }

    /**
     * Serializes the object to a value that can be serialized natively by json_encode().
     * @link https://www.php.net/manual/en/jsonserializable.jsonserialize.php
     *
     * @return mixed Returns data which can be serialized by json_encode(), which is a value
     * of any type other than a resource.
     */
    #[\ReturnTypeWillChange]
    public function jsonSerialize()
    {
       return ObjectSerializer::sanitizeForSerialization($this);
    }

    /**
     * Gets the string presentation of the object
     *
     * @return string
     */
    public function __toString()
    {
        return json_encode(
            ObjectSerializer::sanitizeForSerialization($this),
            JSON_PRETTY_PRINT
        );
    }

    /**
     * Gets a header-safe presentation of the object
     *
     * @return string
     */
    public function toHeaderValue()
    {
        return json_encode(ObjectSerializer::sanitizeForSerialization($this));
    }
}


