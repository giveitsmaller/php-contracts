<?php
/**
 * ProcessingClassConstraints
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
 * The version of the OpenAPI document: 2.192.0
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
 * ProcessingClassConstraints Class Doc Comment
 *
 * @category Class
 * @description Numeric size / duration caps for a single processing class (or a per-tier override of those caps). All fields optional; the &#x60;max_input_*&#x60; keys apply to single-input mime_groups while the &#x60;max_total_*&#x60; keys apply to multi-input merge-style mime_groups (a merge can have many small inputs whose combined size triggers long-form). Byte caps are positive integers; duration caps are ISO-8601 duration strings (e.g. &#x60;PT5M&#x60;). Field set is CI-fixed — &#x60;scripts/check-per-tier-constraints.py&#x60; rejects unknown keys and bad value types. See &#x60;schemas/FORMAT.md&#x60; §&#x60;constraints&#x60; sub-block.
 * @package  Gisl\Generated\OpenApi
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<string, mixed>
 */
class ProcessingClassConstraints implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
     * The original name of the model.
     *
     * @var string
     */
    protected static $openAPIModelName = 'ProcessingClassConstraints';

    /**
     * Array of property to type mappings. Used for (de)serialization
     *
     * @var string[]
     */
    protected static $openAPITypes = [
        'max_input_duration' => 'string',
        'max_input_size_bytes' => 'int',
        'max_output_size_bytes' => 'int',
        'max_total_duration' => 'string',
        'max_total_input_size_bytes' => 'int'
    ];

    /**
     * Array of property to format mappings. Used for (de)serialization
     *
     * @var string[]
     * @phpstan-var array<string, string|null>
     * @psalm-var array<string, string|null>
     */
    protected static $openAPIFormats = [
        'max_input_duration' => null,
        'max_input_size_bytes' => null,
        'max_output_size_bytes' => null,
        'max_total_duration' => null,
        'max_total_input_size_bytes' => null
    ];

    /**
     * Array of nullable properties. Used for (de)serialization
     *
     * @var boolean[]
     */
    protected static array $openAPINullables = [
        'max_input_duration' => false,
        'max_input_size_bytes' => false,
        'max_output_size_bytes' => false,
        'max_total_duration' => false,
        'max_total_input_size_bytes' => false
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
        'max_input_duration' => 'max_input_duration',
        'max_input_size_bytes' => 'max_input_size_bytes',
        'max_output_size_bytes' => 'max_output_size_bytes',
        'max_total_duration' => 'max_total_duration',
        'max_total_input_size_bytes' => 'max_total_input_size_bytes'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'max_input_duration' => 'setMaxInputDuration',
        'max_input_size_bytes' => 'setMaxInputSizeBytes',
        'max_output_size_bytes' => 'setMaxOutputSizeBytes',
        'max_total_duration' => 'setMaxTotalDuration',
        'max_total_input_size_bytes' => 'setMaxTotalInputSizeBytes'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'max_input_duration' => 'getMaxInputDuration',
        'max_input_size_bytes' => 'getMaxInputSizeBytes',
        'max_output_size_bytes' => 'getMaxOutputSizeBytes',
        'max_total_duration' => 'getMaxTotalDuration',
        'max_total_input_size_bytes' => 'getMaxTotalInputSizeBytes'
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
        $this->setIfExists('max_input_duration', $data ?? [], null);
        $this->setIfExists('max_input_size_bytes', $data ?? [], null);
        $this->setIfExists('max_output_size_bytes', $data ?? [], null);
        $this->setIfExists('max_total_duration', $data ?? [], null);
        $this->setIfExists('max_total_input_size_bytes', $data ?? [], null);
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

        if (!is_null($this->container['max_input_size_bytes']) && ($this->container['max_input_size_bytes'] < 1)) {
            $invalidProperties[] = "invalid value for 'max_input_size_bytes', must be bigger than or equal to 1.";
        }

        if (!is_null($this->container['max_output_size_bytes']) && ($this->container['max_output_size_bytes'] < 1)) {
            $invalidProperties[] = "invalid value for 'max_output_size_bytes', must be bigger than or equal to 1.";
        }

        if (!is_null($this->container['max_total_input_size_bytes']) && ($this->container['max_total_input_size_bytes'] < 1)) {
            $invalidProperties[] = "invalid value for 'max_total_input_size_bytes', must be bigger than or equal to 1.";
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
     * Gets max_input_duration
     *
     * @return string|null
     */
    public function getMaxInputDuration()
    {
        return $this->container['max_input_duration'];
    }

    /**
     * Sets max_input_duration
     *
     * @param string|null $max_input_duration Max per-input duration as an ISO-8601 duration string. Single-input mime_groups.
     *
     * @return self
     */
    public function setMaxInputDuration($max_input_duration)
    {
        if (is_null($max_input_duration)) {
            throw new \InvalidArgumentException('non-nullable max_input_duration cannot be null');
        }
        $this->container['max_input_duration'] = $max_input_duration;

        return $this;
    }

    /**
     * Gets max_input_size_bytes
     *
     * @return int|null
     */
    public function getMaxInputSizeBytes()
    {
        return $this->container['max_input_size_bytes'];
    }

    /**
     * Sets max_input_size_bytes
     *
     * @param int|null $max_input_size_bytes Max per-input file size in bytes. Single-input mime_groups.
     *
     * @return self
     */
    public function setMaxInputSizeBytes($max_input_size_bytes)
    {
        if (is_null($max_input_size_bytes)) {
            throw new \InvalidArgumentException('non-nullable max_input_size_bytes cannot be null');
        }

        if (($max_input_size_bytes < 1)) {
            throw new \InvalidArgumentException('invalid value for $max_input_size_bytes when calling ProcessingClassConstraints., must be bigger than or equal to 1.');
        }

        $this->container['max_input_size_bytes'] = $max_input_size_bytes;

        return $this;
    }

    /**
     * Gets max_output_size_bytes
     *
     * @return int|null
     */
    public function getMaxOutputSizeBytes()
    {
        return $this->container['max_output_size_bytes'];
    }

    /**
     * Sets max_output_size_bytes
     *
     * @param int|null $max_output_size_bytes Max output file size in bytes. Any mime_group.
     *
     * @return self
     */
    public function setMaxOutputSizeBytes($max_output_size_bytes)
    {
        if (is_null($max_output_size_bytes)) {
            throw new \InvalidArgumentException('non-nullable max_output_size_bytes cannot be null');
        }

        if (($max_output_size_bytes < 1)) {
            throw new \InvalidArgumentException('invalid value for $max_output_size_bytes when calling ProcessingClassConstraints., must be bigger than or equal to 1.');
        }

        $this->container['max_output_size_bytes'] = $max_output_size_bytes;

        return $this;
    }

    /**
     * Gets max_total_duration
     *
     * @return string|null
     */
    public function getMaxTotalDuration()
    {
        return $this->container['max_total_duration'];
    }

    /**
     * Sets max_total_duration
     *
     * @param string|null $max_total_duration Max combined duration across all inputs as an ISO-8601 duration string. Multi-input (merge) mime_groups.
     *
     * @return self
     */
    public function setMaxTotalDuration($max_total_duration)
    {
        if (is_null($max_total_duration)) {
            throw new \InvalidArgumentException('non-nullable max_total_duration cannot be null');
        }
        $this->container['max_total_duration'] = $max_total_duration;

        return $this;
    }

    /**
     * Gets max_total_input_size_bytes
     *
     * @return int|null
     */
    public function getMaxTotalInputSizeBytes()
    {
        return $this->container['max_total_input_size_bytes'];
    }

    /**
     * Sets max_total_input_size_bytes
     *
     * @param int|null $max_total_input_size_bytes Max combined input size in bytes. Multi-input (merge) mime_groups.
     *
     * @return self
     */
    public function setMaxTotalInputSizeBytes($max_total_input_size_bytes)
    {
        if (is_null($max_total_input_size_bytes)) {
            throw new \InvalidArgumentException('non-nullable max_total_input_size_bytes cannot be null');
        }

        if (($max_total_input_size_bytes < 1)) {
            throw new \InvalidArgumentException('invalid value for $max_total_input_size_bytes when calling ProcessingClassConstraints., must be bigger than or equal to 1.');
        }

        $this->container['max_total_input_size_bytes'] = $max_total_input_size_bytes;

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


