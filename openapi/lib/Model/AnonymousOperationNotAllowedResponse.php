<?php
/**
 * AnonymousOperationNotAllowedResponse
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
 * REST API for the GISL (Give It Smaller) file compression and processing service.  **Architecture:** - Upload files to get a `file_id` - Create workflows referencing uploaded files with operations (compress, thumbnail, image_watermark, text_watermark, merge, archive, convert, custom_luma, audio_overlay, audio_watermark) - Poll status, stream SSE events, or receive webhook callbacks - Download results per operation output  **Response envelope:** All mutation and query endpoints return `{ success: true, data: {...} }` on success and `{ success: false, error: \"...\", details: [...] }` on failure. Exceptions: `GET /api/operations/schema` returns raw JSON (per-tier private caching with ETag revalidation per ADR-0002 + I3), health probes return flat objects, and `POST /api/contact` returns 204 with no body.  **Availability metadata.** This spec uses the `x-availability` vendor extension as **decorative documentation only**. Per [ADR-0001](../docs/decisions/0001-contract-first-availability.md) §1.5, the runtime endpoint `GET /api/operations/schema` (ticket I3) is the authoritative source; the sidecar `availability.json` (ticket I3b) is the authoritative companion (generated, never hand-edited; CI cross-checks runtime ⇄ sidecar). SDKs MUST NOT depend on `x-availability` reaching generated code — code-generators that surface vendor extensions may emit it as documentation, but consumers read availability from the runtime endpoint, not from the generated bindings.  The 5-value vocabulary (`stable | beta | experimental | planned | deprecated`) is defined in the `AvailabilityValue` schema. See `schemas/FORMAT.md` §Availability Taxonomy for the operational rules (parser obligation: absent = stable; per-enum-value granularity is the `per_value_availability` primitive landed via ticket I17).  **Free-text string fields: `x-string-vocabulary` (ticket [`Q79yjcFF`](https://trello.com/c/Q79yjcFF)).** A `type: string` field with no `enum` that names example values says, as data, what a client may do with them (the same marker is used in the AsyncAPI document): - `open` — a vocabulary that grows. Each published value keeps its   meaning, the SET is not closed: switch on the values you know and   handle an unknown one as the generic case (e.g. `ErrorEnvelope.error`). - `advisory` — explanatory text. Display or log it; **never switch on   it** (e.g. `SseWorkflowTerminalData.reason`). - `none` — not a vocabulary at all (an expression or an identifier,   e.g. `OptionSchema.pattern`). A field whose description hedges with \"common values\" or \"free-form\" must carry the marker; a test enforces it.  **Localisation (per ticket [I26](https://trello.com/c/rcnqwgI4)).**  Error responses + paused/blocked workflow statuses carry a localised human-readable `message` alongside a stable, never-localised `message_key`. Machine-readable fields (`error`, enum values, status codes) stay canonical English.  - **Currently committed locales:** `en-GB` only (per ticket   [`4GKyuYo6`](https://trello.com/c/4GKyuYo6)). The I26 carrier   shape (`Accept-Language` + `Content-Language` + `Vary` headers +   `locale` envelope field + `message_key` + `message_params`) is   stable and exercised; the **catalog** of translated `message`   strings is en-GB-only at runtime today. Additional locales (e.g.   `pt-PT`) will be advertised by name when their catalogs ship —   the request/response carrier shape does NOT change when a new   locale lands. Treat unrequested locales as \"machine-code +   `message_key` path is committed; localised `message` prose is   not\" until this prose enumerates them by name. - **Request:** `Accept-Language` header per RFC 9110 §12.5.4 (q-value   negotiation supported). The server selects the best-match locale   from its supported list; falls back to `en-GB` when no match —   which, until additional catalogs land, is every non-`en-GB`   `Accept-Language`. - **Response:** `Content-Language: <locale>` echo on every localised   response; `Vary: Accept-Language` on every response (CDN/cache   correctness — different `Accept-Language` requests produce   different responses). `Vary` is emitted unconditionally so the   header contract does not flip when a second locale ships. - **Fallback locale:** `en-GB` (also the canonical locale for   `message_key` translations and English `message` prose). - **SDK guidance:** switch on `error` (machine code) for typed   error branches; surface `message_key` to client-side i18n   catalogs (SDK companion work tracked at X19, cross-repo);   display `message` for end-user UI; **never parse `message` for   control flow** — it changes per locale.  Carrier shape lives on `ErrorEnvelope` (envelope-level optional `message_key` + `message` + `locale` + `message_params`) and `ValidationErrorEnvelope` (also per-`details[]` entry). Existing 402 / 403 / 422 envelopes (`BalanceExhaustedResponse`, `FeatureNotAvailableResponse`, `FeatureTierRestrictedResponse`, `WorkflowPausedDetail`) inherit the convention.  **Upload thresholds (per tickets [u0ar7Yye](https://trello.com/c/u0ar7Yye) + [58nBQLWQ](https://trello.com/c/58nBQLWQ)).** Canonical upload constants (single-shot cap, multipart chunk size, multipart concurrency default, multipart first-chunk size) live on the `UploadThresholds` schema with `const:`-pinned values. SDK generators emit these as typed binding constants so frontend / API / SDKs reference one source of truth instead of hardcoding magic numbers. A runtime `GET /api/uploads/limits` endpoint for dynamic discovery (per-tier / per-environment overrides) is a deferred follow-up.
 *
 * The version of the OpenAPI document: 2.213.0
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
 * AnonymousOperationNotAllowedResponse Class Doc Comment
 *
 * @category Class
 * @description 403 from &#x60;POST /api/workflows&#x60; when an ANONYMOUS caller (no credential) requests an operation outside the anonymous allow-list. A register-wall: the frontend renders a sign-up prompt, since no tier upgrade applies to a caller without an account.  Mirrors &#x60;compression_api&#x60;&#39;s &#x60;WorkflowController&#x60; register-wall (&#x60;JobsErrorCode::AnonymousOperationNotAllowed&#x60;), which checks every operation in the body and names the FIRST disallowed one.  ⚠️ **The allow-list itself is NOT yet declared in this contract** (ticket [&#x60;UQ7zROTr&#x60;](https://trello.com/c/UQ7zROTr)), so a client can parse this refusal but cannot yet predict it. Do not hard-code the list from this description: it deliberately names none.
 * @package  Gisl\Generated\OpenApi
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<string, mixed>
 */
class AnonymousOperationNotAllowedResponse implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
     * The original name of the model.
     *
     * @var string
     */
    protected static $openAPIModelName = 'AnonymousOperationNotAllowedResponse';

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
        'operation' => '\Gisl\Generated\OpenApi\Model\OperationType'
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
        'operation' => null
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
        'operation' => false
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
        'operation' => 'operation'
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
        'operation' => 'setOperation'
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
        'operation' => 'getOperation'
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

    public const ERROR_ANONYMOUS_OPERATION_NOT_ALLOWED = 'ANONYMOUS_OPERATION_NOT_ALLOWED';
    public const ERROR_TYPE_ANONYMOUS_OPERATION_NOT_ALLOWED = 'anonymous_operation_not_allowed';

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getErrorAllowableValues()
    {
        return [
            self::ERROR_ANONYMOUS_OPERATION_NOT_ALLOWED,
        ];
    }

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getErrorTypeAllowableValues()
    {
        return [
            self::ERROR_TYPE_ANONYMOUS_OPERATION_NOT_ALLOWED,
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
        $this->setIfExists('operation', $data ?? [], null);
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
        $allowedValues = $this->getErrorAllowableValues();
        if (!is_null($this->container['error']) && !in_array($this->container['error'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'error', must be one of '%s'",
                $this->container['error'],
                implode("', '", $allowedValues)
            );
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

        if ($this->container['operation'] === null) {
            $invalidProperties[] = "'operation' can't be null";
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
     * @param string $error error
     *
     * @return self
     */
    public function setError($error)
    {
        if (is_null($error)) {
            throw new \InvalidArgumentException('non-nullable error cannot be null');
        }
        $allowedValues = $this->getErrorAllowableValues();
        if (!in_array($error, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'error', must be one of '%s'",
                    $error,
                    implode("', '", $allowedValues)
                )
            );
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
     * @param string|null $message Human-readable error message, localised per the request's `Accept-Language` header (fallback locale `en-GB`). The response carries `Content-Language: <locale>` + `Vary: Accept-Language` headers. **Never parse this field for control flow** — it changes per locale.
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
     * @param string|null $message_key Stable canonical lookup key for the message (e.g. `error.balance_exhausted.add_credits`, `error.upload_size_exceeds_tier`). Never localised. SDK + frontend translation layers gate on this for client-side i18n catalogs (per ticket X19, cross-repo SDK companion work). Stable across server message-prose updates.
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
     * @param string|null $locale BCP 47 locale tag echoing the resolved `Content-Language` response header value. Currently always `en-GB` (the only committed locale per `info.description` Localisation block + ticket [`4GKyuYo6`](https://trello.com/c/4GKyuYo6)); additional values will appear here when their catalogs ship. Lets the SDK confirm which locale the server selected when the request used q-value negotiation across multiple `Accept-Language` values.
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
     * @param array<string,mixed>|null $message_params Optional interpolation values for the localised `message`. Keys are stable parameter names referenced by the translation table (e.g. `{ \"filename\": \"photo.heic\", \"max_size_mb\": 100 }`). **Excludes cost / monetary numbers** per plan v5 §F11 round-13 narrowing — pricing-related localisation reads numeric state from `GET /api/v2/credits/balance`, not from this field. Values are JSON-native scalars (`string` / `integer` / `number` / `boolean` / `null`) — no nested objects, to keep translation-table integration simple.
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
     * @param string $error_type Discriminator for the 403 oneOf. Always `anonymous_operation_not_allowed` for this envelope.
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
     * Gets operation
     *
     * @return \Gisl\Generated\OpenApi\Model\OperationType
     */
    public function getOperation()
    {
        return $this->container['operation'];
    }

    /**
     * Sets operation
     *
     * @param \Gisl\Generated\OpenApi\Model\OperationType $operation The first operation in the request body that an anonymous caller may not run.
     *
     * @return self
     */
    public function setOperation($operation)
    {
        if (is_null($operation)) {
            throw new \InvalidArgumentException('non-nullable operation cannot be null');
        }
        $this->container['operation'] = $operation;

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


