<?php
/**
 * CreditQuoteLineCostParts
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
 * The version of the OpenAPI document: 2.251.0
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
 * CreditQuoteLineCostParts Class Doc Comment
 *
 * @category Class
 * @description The parts of one line&#39;s &#x60;max_credits&#x60; (D215). Invariant: &#x60;weight_credits + duration_credits + size_credits &#x3D;&#x3D; max_credits&#x60;. &#x60;duration_credits&#x60; is the N in \&quot;this is longer, so it costs N more\&quot;: &#x60;max(weight, ceil(input_minutes)) - weight&#x60;, which is 0 for a short input and for a flat line. &#x60;duration_seconds&#x60; is the duration the formula used (&#x60;probed&#x60;), or the sum of the timed inputs&#39; class ceilings when a duration was unknown at create (&#x60;class_ceiling&#x60;); null for &#x60;flat&#x60;. Values are produced by api; the arithmetic is &#x60;duration_pricing&#x60; (one copy).
 * @package  Gisl\Generated\OpenApi
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<string, mixed>
 */
class CreditQuoteLineCostParts implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
     * The original name of the model.
     *
     * @var string
     */
    protected static $openAPIModelName = 'CreditQuoteLineCostParts';

    /**
     * Array of property to type mappings. Used for (de)serialization
     *
     * @var string[]
     */
    protected static $openAPITypes = [
        'weight_credits' => 'int',
        'duration_credits' => 'int',
        'size_credits' => 'int',
        'duration_seconds' => 'int',
        'duration_basis' => '\Gisl\Generated\OpenApi\Model\CreditQuoteDurationBasis'
    ];

    /**
     * Array of property to format mappings. Used for (de)serialization
     *
     * @var string[]
     * @phpstan-var array<string, string|null>
     * @psalm-var array<string, string|null>
     */
    protected static $openAPIFormats = [
        'weight_credits' => null,
        'duration_credits' => null,
        'size_credits' => null,
        'duration_seconds' => null,
        'duration_basis' => null
    ];

    /**
     * Array of nullable properties. Used for (de)serialization
     *
     * @var boolean[]
     */
    protected static array $openAPINullables = [
        'weight_credits' => false,
        'duration_credits' => false,
        'size_credits' => false,
        'duration_seconds' => true,
        'duration_basis' => false
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
        'weight_credits' => 'weight_credits',
        'duration_credits' => 'duration_credits',
        'size_credits' => 'size_credits',
        'duration_seconds' => 'duration_seconds',
        'duration_basis' => 'duration_basis'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'weight_credits' => 'setWeightCredits',
        'duration_credits' => 'setDurationCredits',
        'size_credits' => 'setSizeCredits',
        'duration_seconds' => 'setDurationSeconds',
        'duration_basis' => 'setDurationBasis'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'weight_credits' => 'getWeightCredits',
        'duration_credits' => 'getDurationCredits',
        'size_credits' => 'getSizeCredits',
        'duration_seconds' => 'getDurationSeconds',
        'duration_basis' => 'getDurationBasis'
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
        $this->setIfExists('weight_credits', $data ?? [], null);
        $this->setIfExists('duration_credits', $data ?? [], null);
        $this->setIfExists('size_credits', $data ?? [], null);
        $this->setIfExists('duration_seconds', $data ?? [], null);
        $this->setIfExists('duration_basis', $data ?? [], null);
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

        if ($this->container['weight_credits'] === null) {
            $invalidProperties[] = "'weight_credits' can't be null";
        }
        if (($this->container['weight_credits'] < 0)) {
            $invalidProperties[] = "invalid value for 'weight_credits', must be bigger than or equal to 0.";
        }

        if ($this->container['duration_credits'] === null) {
            $invalidProperties[] = "'duration_credits' can't be null";
        }
        if (($this->container['duration_credits'] < 0)) {
            $invalidProperties[] = "invalid value for 'duration_credits', must be bigger than or equal to 0.";
        }

        if ($this->container['size_credits'] === null) {
            $invalidProperties[] = "'size_credits' can't be null";
        }
        if (($this->container['size_credits'] < 0)) {
            $invalidProperties[] = "invalid value for 'size_credits', must be bigger than or equal to 0.";
        }

        if ($this->container['duration_seconds'] === null && !$this->isNullableSetToNull('duration_seconds')) {
            $invalidProperties[] = "'duration_seconds' can't be null";
        }
        if (($this->container['duration_seconds'] < 0)) {
            $invalidProperties[] = "invalid value for 'duration_seconds', must be bigger than or equal to 0.";
        }

        if ($this->container['duration_basis'] === null) {
            $invalidProperties[] = "'duration_basis' can't be null";
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
     * Gets weight_credits
     *
     * @return int
     */
    public function getWeightCredits()
    {
        return $this->container['weight_credits'];
    }

    /**
     * Sets weight_credits
     *
     * @param int $weight_credits The operation's flat weight, which is the floor of the duration rule.
     *
     * @return self
     */
    public function setWeightCredits($weight_credits)
    {
        if (is_null($weight_credits)) {
            throw new \InvalidArgumentException('non-nullable weight_credits cannot be null');
        }

        if (($weight_credits < 0)) {
            throw new \InvalidArgumentException('invalid value for $weight_credits when calling CreditQuoteLineCostParts., must be bigger than or equal to 0.');
        }

        $this->container['weight_credits'] = $weight_credits;

        return $this;
    }

    /**
     * Gets duration_credits
     *
     * @return int
     */
    public function getDurationCredits()
    {
        return $this->container['duration_credits'];
    }

    /**
     * Sets duration_credits
     *
     * @param int $duration_credits The duration part. 0 for a flat line or a short input.
     *
     * @return self
     */
    public function setDurationCredits($duration_credits)
    {
        if (is_null($duration_credits)) {
            throw new \InvalidArgumentException('non-nullable duration_credits cannot be null');
        }

        if (($duration_credits < 0)) {
            throw new \InvalidArgumentException('invalid value for $duration_credits when calling CreditQuoteLineCostParts., must be bigger than or equal to 0.');
        }

        $this->container['duration_credits'] = $duration_credits;

        return $this;
    }

    /**
     * Gets size_credits
     *
     * @return int
     */
    public function getSizeCredits()
    {
        return $this->container['size_credits'];
    }

    /**
     * Sets size_credits
     *
     * @param int $size_credits The per-operation input-size surcharge (`pricing-policy.yaml` `size_surcharge`).
     *
     * @return self
     */
    public function setSizeCredits($size_credits)
    {
        if (is_null($size_credits)) {
            throw new \InvalidArgumentException('non-nullable size_credits cannot be null');
        }

        if (($size_credits < 0)) {
            throw new \InvalidArgumentException('invalid value for $size_credits when calling CreditQuoteLineCostParts., must be bigger than or equal to 0.');
        }

        $this->container['size_credits'] = $size_credits;

        return $this;
    }

    /**
     * Gets duration_seconds
     *
     * @return int|null
     */
    public function getDurationSeconds()
    {
        return $this->container['duration_seconds'];
    }

    /**
     * Sets duration_seconds
     *
     * @param int|null $duration_seconds duration_seconds
     *
     * @return self
     */
    public function setDurationSeconds($duration_seconds)
    {
        if (is_null($duration_seconds)) {
            array_push($this->openAPINullablesSetToNull, 'duration_seconds');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('duration_seconds', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }

        if (!is_null($duration_seconds) && ($duration_seconds < 0)) {
            throw new \InvalidArgumentException('invalid value for $duration_seconds when calling CreditQuoteLineCostParts., must be bigger than or equal to 0.');
        }

        $this->container['duration_seconds'] = $duration_seconds;

        return $this;
    }

    /**
     * Gets duration_basis
     *
     * @return \Gisl\Generated\OpenApi\Model\CreditQuoteDurationBasis
     */
    public function getDurationBasis()
    {
        return $this->container['duration_basis'];
    }

    /**
     * Sets duration_basis
     *
     * @param \Gisl\Generated\OpenApi\Model\CreditQuoteDurationBasis $duration_basis duration_basis
     *
     * @return self
     */
    public function setDurationBasis($duration_basis)
    {
        if (is_null($duration_basis)) {
            throw new \InvalidArgumentException('non-nullable duration_basis cannot be null');
        }
        $this->container['duration_basis'] = $duration_basis;

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


