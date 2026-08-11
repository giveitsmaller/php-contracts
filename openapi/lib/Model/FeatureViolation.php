<?php
/**
 * FeatureViolation
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
 * The version of the OpenAPI document: 2.189.0
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
 * FeatureViolation Class Doc Comment
 *
 * @category Class
 * @description Single feature violation. One or more of these are returned in &#x60;FeatureNotAvailableResponse.violations[]&#x60; (422) and &#x60;FeatureTierRestrictedResponse.violations[]&#x60; (403).  &#x60;feature&#x60; is a dotted-path identifier of the unavailable schema entry (e.g. &#x60;operation.image_watermark&#x60;, &#x60;operation.compress.option.codec.av1&#x60;, &#x60;operation.merge.mime_group.image.option.transition.dissolve&#x60;). Granularity matches the schema entry that was rejected (operation / mime_group / option / per_value).
 * @package  Gisl\Generated\OpenApi
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<string, mixed>
 */
class FeatureViolation implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
     * The original name of the model.
     *
     * @var string
     */
    protected static $openAPIModelName = 'FeatureViolation';

    /**
     * Array of property to type mappings. Used for (de)serialization
     *
     * @var string[]
     */
    protected static $openAPITypes = [
        'feature' => 'string',
        'availability' => '\Gisl\Generated\OpenApi\Model\AvailabilityValue',
        'eta' => 'string',
        'required_tier' => '\Gisl\Generated\OpenApi\Model\UserTier',
        'documentation_url' => 'string',
        'message_key' => 'string',
        'message' => 'string',
        'locale' => 'string',
        'message_params' => 'array<string,mixed>'
    ];

    /**
     * Array of property to format mappings. Used for (de)serialization
     *
     * @var string[]
     * @phpstan-var array<string, string|null>
     * @psalm-var array<string, string|null>
     */
    protected static $openAPIFormats = [
        'feature' => null,
        'availability' => null,
        'eta' => null,
        'required_tier' => null,
        'documentation_url' => 'uri',
        'message_key' => null,
        'message' => null,
        'locale' => null,
        'message_params' => null
    ];

    /**
     * Array of nullable properties. Used for (de)serialization
     *
     * @var boolean[]
     */
    protected static array $openAPINullables = [
        'feature' => false,
        'availability' => false,
        'eta' => false,
        'required_tier' => true,
        'documentation_url' => false,
        'message_key' => false,
        'message' => false,
        'locale' => false,
        'message_params' => false
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
        'feature' => 'feature',
        'availability' => 'availability',
        'eta' => 'eta',
        'required_tier' => 'required_tier',
        'documentation_url' => 'documentation_url',
        'message_key' => 'message_key',
        'message' => 'message',
        'locale' => 'locale',
        'message_params' => 'message_params'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'feature' => 'setFeature',
        'availability' => 'setAvailability',
        'eta' => 'setEta',
        'required_tier' => 'setRequiredTier',
        'documentation_url' => 'setDocumentationUrl',
        'message_key' => 'setMessageKey',
        'message' => 'setMessage',
        'locale' => 'setLocale',
        'message_params' => 'setMessageParams'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'feature' => 'getFeature',
        'availability' => 'getAvailability',
        'eta' => 'getEta',
        'required_tier' => 'getRequiredTier',
        'documentation_url' => 'getDocumentationUrl',
        'message_key' => 'getMessageKey',
        'message' => 'getMessage',
        'locale' => 'getLocale',
        'message_params' => 'getMessageParams'
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
        $this->setIfExists('feature', $data ?? [], null);
        $this->setIfExists('availability', $data ?? [], null);
        $this->setIfExists('eta', $data ?? [], null);
        $this->setIfExists('required_tier', $data ?? [], null);
        $this->setIfExists('documentation_url', $data ?? [], null);
        $this->setIfExists('message_key', $data ?? [], null);
        $this->setIfExists('message', $data ?? [], null);
        $this->setIfExists('locale', $data ?? [], null);
        $this->setIfExists('message_params', $data ?? [], null);
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

        if ($this->container['feature'] === null) {
            $invalidProperties[] = "'feature' can't be null";
        }
        if ($this->container['availability'] === null) {
            $invalidProperties[] = "'availability' can't be null";
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
     * Gets feature
     *
     * @return string
     */
    public function getFeature()
    {
        return $this->container['feature'];
    }

    /**
     * Sets feature
     *
     * @param string $feature Dotted-path identifier of the rejected schema entry.
     *
     * @return self
     */
    public function setFeature($feature)
    {
        if (is_null($feature)) {
            throw new \InvalidArgumentException('non-nullable feature cannot be null');
        }
        $this->container['feature'] = $feature;

        return $this;
    }

    /**
     * Gets availability
     *
     * @return \Gisl\Generated\OpenApi\Model\AvailabilityValue
     */
    public function getAvailability()
    {
        return $this->container['availability'];
    }

    /**
     * Sets availability
     *
     * @param \Gisl\Generated\OpenApi\Model\AvailabilityValue $availability availability
     *
     * @return self
     */
    public function setAvailability($availability)
    {
        if (is_null($availability)) {
            throw new \InvalidArgumentException('non-nullable availability cannot be null');
        }
        $this->container['availability'] = $availability;

        return $this;
    }

    /**
     * Gets eta
     *
     * @return string|null
     */
    public function getEta()
    {
        return $this->container['eta'];
    }

    /**
     * Sets eta
     *
     * @param string|null $eta Optional ISO-8601 date or quarter (`2026-Q3`) when the feature is expected to ship. Only meaningful for `availability: planned`. May be omitted when no ETA is committed.
     *
     * @return self
     */
    public function setEta($eta)
    {
        if (is_null($eta)) {
            throw new \InvalidArgumentException('non-nullable eta cannot be null');
        }
        $this->container['eta'] = $eta;

        return $this;
    }

    /**
     * Gets required_tier
     *
     * @return \Gisl\Generated\OpenApi\Model\UserTier|null
     */
    public function getRequiredTier()
    {
        return $this->container['required_tier'];
    }

    /**
     * Sets required_tier
     *
     * @param \Gisl\Generated\OpenApi\Model\UserTier|null $required_tier required_tier
     *
     * @return self
     */
    public function setRequiredTier($required_tier)
    {
        if (is_null($required_tier)) {
            array_push($this->openAPINullablesSetToNull, 'required_tier');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('required_tier', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['required_tier'] = $required_tier;

        return $this;
    }

    /**
     * Gets documentation_url
     *
     * @return string|null
     */
    public function getDocumentationUrl()
    {
        return $this->container['documentation_url'];
    }

    /**
     * Sets documentation_url
     *
     * @param string|null $documentation_url Optional link to feature documentation.
     *
     * @return self
     */
    public function setDocumentationUrl($documentation_url)
    {
        if (is_null($documentation_url)) {
            throw new \InvalidArgumentException('non-nullable documentation_url cannot be null');
        }
        $this->container['documentation_url'] = $documentation_url;

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
     * @param array<string,mixed>|null $message_params Optional interpolation values for the localised `message` (e.g. `{ \"feature\": \"audio_overlay\", \"eta\": \"2026-Q3\" }`). See `ErrorEnvelope.message_params`. Excludes cost numbers.
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


