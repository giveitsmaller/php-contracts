<?php
/**
 * MimeGroupSchema
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
 * The version of the OpenAPI document: 2.170.0
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
 * MimeGroupSchema Class Doc Comment
 *
 * @category Class
 * @description MIME-group-specific option schema
 * @package  Gisl\Generated\OpenApi
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<string, mixed>
 */
class MimeGroupSchema implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
     * The original name of the model.
     *
     * @var string
     */
    protected static $openAPIModelName = 'MimeGroupSchema';

    /**
     * Array of property to type mappings. Used for (de)serialization
     *
     * @var string[]
     */
    protected static $openAPITypes = [
        'mimes' => 'string[]',
        'availability' => '\Gisl\Generated\OpenApi\Model\AvailabilityValue',
        'required_tier' => '\Gisl\Generated\OpenApi\Model\UserTier',
        'per_mime_availability' => 'array<string,\Gisl\Generated\OpenApi\Model\PerValueAvailabilityEntry>',
        'processing_class' => 'array<string,\Gisl\Generated\OpenApi\Model\ProcessingClassEntry>',
        'options' => 'array<string,\Gisl\Generated\OpenApi\Model\OptionSchema>',
        'per_input_options' => 'array<string,\Gisl\Generated\OpenApi\Model\OptionSchema>'
    ];

    /**
     * Array of property to format mappings. Used for (de)serialization
     *
     * @var string[]
     * @phpstan-var array<string, string|null>
     * @psalm-var array<string, string|null>
     */
    protected static $openAPIFormats = [
        'mimes' => null,
        'availability' => null,
        'required_tier' => null,
        'per_mime_availability' => null,
        'processing_class' => null,
        'options' => null,
        'per_input_options' => null
    ];

    /**
     * Array of nullable properties. Used for (de)serialization
     *
     * @var boolean[]
     */
    protected static array $openAPINullables = [
        'mimes' => false,
        'availability' => false,
        'required_tier' => false,
        'per_mime_availability' => false,
        'processing_class' => false,
        'options' => false,
        'per_input_options' => false
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
        'mimes' => 'mimes',
        'availability' => 'availability',
        'required_tier' => 'required_tier',
        'per_mime_availability' => 'per_mime_availability',
        'processing_class' => 'processing_class',
        'options' => 'options',
        'per_input_options' => 'per_input_options'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'mimes' => 'setMimes',
        'availability' => 'setAvailability',
        'required_tier' => 'setRequiredTier',
        'per_mime_availability' => 'setPerMimeAvailability',
        'processing_class' => 'setProcessingClass',
        'options' => 'setOptions',
        'per_input_options' => 'setPerInputOptions'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'mimes' => 'getMimes',
        'availability' => 'getAvailability',
        'required_tier' => 'getRequiredTier',
        'per_mime_availability' => 'getPerMimeAvailability',
        'processing_class' => 'getProcessingClass',
        'options' => 'getOptions',
        'per_input_options' => 'getPerInputOptions'
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
        $this->setIfExists('mimes', $data ?? [], null);
        $this->setIfExists('availability', $data ?? [], null);
        $this->setIfExists('required_tier', $data ?? [], null);
        $this->setIfExists('per_mime_availability', $data ?? [], null);
        $this->setIfExists('processing_class', $data ?? [], null);
        $this->setIfExists('options', $data ?? [], null);
        $this->setIfExists('per_input_options', $data ?? [], null);
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

        if ($this->container['mimes'] === null) {
            $invalidProperties[] = "'mimes' can't be null";
        }
        if ($this->container['options'] === null) {
            $invalidProperties[] = "'options' can't be null";
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
     * Gets mimes
     *
     * @return string[]
     */
    public function getMimes()
    {
        return $this->container['mimes'];
    }

    /**
     * Sets mimes
     *
     * @param string[] $mimes List of MIME types in this group
     *
     * @return self
     */
    public function setMimes($mimes)
    {
        if (is_null($mimes)) {
            throw new \InvalidArgumentException('non-nullable mimes cannot be null');
        }
        $this->container['mimes'] = $mimes;

        return $this;
    }

    /**
     * Gets availability
     *
     * @return \Gisl\Generated\OpenApi\Model\AvailabilityValue|null
     */
    public function getAvailability()
    {
        return $this->container['availability'];
    }

    /**
     * Sets availability
     *
     * @param \Gisl\Generated\OpenApi\Model\AvailabilityValue|null $availability Mime-group-level availability tag. Optional — absent ≡ `stable`. See `OperationSchemaDefinition.availability` for the runtime emission timeline (lands with I3).
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
     * @param \Gisl\Generated\OpenApi\Model\UserTier|null $required_tier Mime-group-level minimum subscription tier. Optional — absent means no tier restriction at this level. Same semantics as `OperationSchemaDefinition.required_tier` but scoped to a single MIME group (e.g. an operation may be free-tier for `image/jpeg` and `pro`-tier for `image/heic` via two parallel mime_groups).
     *
     * @return self
     */
    public function setRequiredTier($required_tier)
    {
        if (is_null($required_tier)) {
            throw new \InvalidArgumentException('non-nullable required_tier cannot be null');
        }
        $this->container['required_tier'] = $required_tier;

        return $this;
    }

    /**
     * Gets per_mime_availability
     *
     * @return array<string,\Gisl\Generated\OpenApi\Model\PerValueAvailabilityEntry>|null
     */
    public function getPerMimeAvailability()
    {
        return $this->container['per_mime_availability'];
    }

    /**
     * Sets per_mime_availability
     *
     * @param array<string,\Gisl\Generated\OpenApi\Model\PerValueAvailabilityEntry>|null $per_mime_availability Optional per-MIME availability map per ticket [`YXYOo6gg`](https://trello.com/c/YXYOo6gg). Keys MUST be a subset of `mimes[]` (CI-checked by `scripts/check-per-mime-availability.py`); absent keys default to `availability: stable`. Use this when individual MIMEs within an otherwise-homogeneous mime list ship at different availability levels (e.g. `image/avif: beta, image/heic: planned` alongside `image/jpeg: stable`). Runtime emission lands with [I3](https://trello.com/c/eCWIpug8); until then the contract advertises the field shape but the endpoint does not yet surface the field.
     *
     * @return self
     */
    public function setPerMimeAvailability($per_mime_availability)
    {
        if (is_null($per_mime_availability)) {
            throw new \InvalidArgumentException('non-nullable per_mime_availability cannot be null');
        }
        $this->container['per_mime_availability'] = $per_mime_availability;

        return $this;
    }

    /**
     * Gets processing_class
     *
     * @return array<string,\Gisl\Generated\OpenApi\Model\ProcessingClassEntry>|null
     */
    public function getProcessingClass()
    {
        return $this->container['processing_class'];
    }

    /**
     * Sets processing_class
     *
     * @param array<string,\Gisl\Generated\OpenApi\Model\ProcessingClassEntry>|null $processing_class Optional per-mime-group processing-class block (per ticket [I15-CONS `YZpBKzOM`](https://trello.com/c/YZpBKzOM) + plan v5 §F8 long-form routing). Keyed by `ProcessingClass` enum value (`short_form` / `long_form` / `short_form_concat` / `long_form_re_encode`); each entry advertises that routing class's availability, tier gate, and size/duration caps.  Present only on mime_groups subject to short-form vs long-form routing — typically `video`; per F8 also `audio` for `audio_overlay` / `audio_watermark`. Absence means \"no per-class routing exposed\": consumers MUST treat absent as \"no routing decision exposed\" and MUST NOT coerce it to `short_form` (FORMAT.md §`processing_class` parser obligation 2 / ADR-0001 §1.4).  The runtime endpoint (`GET /api/operations/schema`) and the `availability/availability.json` sidecar emit this block verbatim from the source operation YAML (including any `per_tier_constraints` overlay — copied through as an opaque subtree). SDK + frontend consumers gate UI on the per-class `availability` + `required_tier` and surface the caller's effective caps as the binding limits. Surfacing this on the typed model retires the raw-ops-schema HTTP workaround per ticket [`yWeBr81O`](https://trello.com/c/yWeBr81O). See `schemas/FORMAT.md` §`processing_class:` block.
     *
     * @return self
     */
    public function setProcessingClass($processing_class)
    {
        if (is_null($processing_class)) {
            throw new \InvalidArgumentException('non-nullable processing_class cannot be null');
        }
        $this->container['processing_class'] = $processing_class;

        return $this;
    }

    /**
     * Gets options
     *
     * @return array<string,\Gisl\Generated\OpenApi\Model\OptionSchema>
     */
    public function getOptions()
    {
        return $this->container['options'];
    }

    /**
     * Sets options
     *
     * @param array<string,\Gisl\Generated\OpenApi\Model\OptionSchema> $options Options specific to this MIME group, keyed by option name
     *
     * @return self
     */
    public function setOptions($options)
    {
        if (is_null($options)) {
            throw new \InvalidArgumentException('non-nullable options cannot be null');
        }
        $this->container['options'] = $options;

        return $this;
    }

    /**
     * Gets per_input_options
     *
     * @return array<string,\Gisl\Generated\OpenApi\Model\OptionSchema>|null
     */
    public function getPerInputOptions()
    {
        return $this->container['per_input_options'];
    }

    /**
     * Sets per_input_options
     *
     * @param array<string,\Gisl\Generated\OpenApi\Model\OptionSchema>|null $per_input_options Per-input overrides for this MIME group, keyed by option name (multi-input only)
     *
     * @return self
     */
    public function setPerInputOptions($per_input_options)
    {
        if (is_null($per_input_options)) {
            throw new \InvalidArgumentException('non-nullable per_input_options cannot be null');
        }
        $this->container['per_input_options'] = $per_input_options;

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


