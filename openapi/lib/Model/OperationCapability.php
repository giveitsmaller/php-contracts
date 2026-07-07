<?php
/**
 * OperationCapability
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
 * The version of the OpenAPI document: 2.158.0
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
 * OperationCapability Class Doc Comment
 *
 * @category Class
 * @description One operation type&#39;s capability entry in the &#x60;capabilities&#x60; matrix (ADR-0024 operation-capability constraint model). The object is deliberately OPEN (no &#x60;additionalProperties: false&#x60;) so future capability families ride through untyped — consumers MUST tolerate extra keys. The per-op &#x60;input&#x60; cardinality block is typed via &#x60;CapabilityInputSpec&#x60; (added once the API began surfacing it, ticket &#x60;L7ykrIX3&#x60; / API &#x60;03Qg3Ms7&#x60;).
 * @package  Gisl\Generated\OpenApi
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<string, mixed>
 */
class OperationCapability implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
     * The original name of the model.
     *
     * @var string
     */
    protected static $openAPIModelName = 'OperationCapability';

    /**
     * Array of property to type mappings. Used for (de)serialization
     *
     * @var string[]
     */
    protected static $openAPITypes = [
        'accepts' => 'string[]',
        'input' => '\Gisl\Generated\OpenApi\Model\CapabilityInputSpec',
        'availability' => '\Gisl\Generated\OpenApi\Model\AvailabilityValue',
        'sole_op' => 'bool',
        'produces' => '\Gisl\Generated\OpenApi\Model\CapabilityProduces',
        'excludes' => '\Gisl\Generated\OpenApi\Model\CapabilityConstraint[]',
        'requires' => '\Gisl\Generated\OpenApi\Model\CapabilityConstraint[]',
        'option_conflicts' => '\Gisl\Generated\OpenApi\Model\CapabilityConstraint[]'
    ];

    /**
     * Array of property to format mappings. Used for (de)serialization
     *
     * @var string[]
     * @phpstan-var array<string, string|null>
     * @psalm-var array<string, string|null>
     */
    protected static $openAPIFormats = [
        'accepts' => null,
        'input' => null,
        'availability' => null,
        'sole_op' => null,
        'produces' => null,
        'excludes' => null,
        'requires' => null,
        'option_conflicts' => null
    ];

    /**
     * Array of nullable properties. Used for (de)serialization
     *
     * @var boolean[]
     */
    protected static array $openAPINullables = [
        'accepts' => false,
        'input' => false,
        'availability' => false,
        'sole_op' => false,
        'produces' => false,
        'excludes' => false,
        'requires' => false,
        'option_conflicts' => false
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
        'accepts' => 'accepts',
        'input' => 'input',
        'availability' => 'availability',
        'sole_op' => 'sole_op',
        'produces' => 'produces',
        'excludes' => 'excludes',
        'requires' => 'requires',
        'option_conflicts' => 'option_conflicts'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'accepts' => 'setAccepts',
        'input' => 'setInput',
        'availability' => 'setAvailability',
        'sole_op' => 'setSoleOp',
        'produces' => 'setProduces',
        'excludes' => 'setExcludes',
        'requires' => 'setRequires',
        'option_conflicts' => 'setOptionConflicts'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'accepts' => 'getAccepts',
        'input' => 'getInput',
        'availability' => 'getAvailability',
        'sole_op' => 'getSoleOp',
        'produces' => 'getProduces',
        'excludes' => 'getExcludes',
        'requires' => 'getRequires',
        'option_conflicts' => 'getOptionConflicts'
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
        $this->setIfExists('accepts', $data ?? [], null);
        $this->setIfExists('input', $data ?? [], null);
        $this->setIfExists('availability', $data ?? [], null);
        $this->setIfExists('sole_op', $data ?? [], null);
        $this->setIfExists('produces', $data ?? [], null);
        $this->setIfExists('excludes', $data ?? [], null);
        $this->setIfExists('requires', $data ?? [], null);
        $this->setIfExists('option_conflicts', $data ?? [], null);
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
     * Gets accepts
     *
     * @return string[]|null
     */
    public function getAccepts()
    {
        return $this->container['accepts'];
    }

    /**
     * Sets accepts
     *
     * @param string[]|null $accepts Media classes this operation accepts as input (e.g. `image`, `video`, `audio`, `document`, or `*` for media-agnostic). Coarse media-class tokens, not MIME types — per-MIME applicability lives in `operations.*.mime_groups`.
     *
     * @return self
     */
    public function setAccepts($accepts)
    {
        if (is_null($accepts)) {
            throw new \InvalidArgumentException('non-nullable accepts cannot be null');
        }
        $this->container['accepts'] = $accepts;

        return $this;
    }

    /**
     * Gets input
     *
     * @return \Gisl\Generated\OpenApi\Model\CapabilityInputSpec|null
     */
    public function getInput()
    {
        return $this->container['input'];
    }

    /**
     * Sets input
     *
     * @param \Gisl\Generated\OpenApi\Model\CapabilityInputSpec|null $input input
     *
     * @return self
     */
    public function setInput($input)
    {
        if (is_null($input)) {
            throw new \InvalidArgumentException('non-nullable input cannot be null');
        }
        $this->container['input'] = $input;

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
     * @param \Gisl\Generated\OpenApi\Model\AvailabilityValue|null $availability availability
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
     * Gets sole_op
     *
     * @return bool|null
     */
    public function getSoleOp()
    {
        return $this->container['sole_op'];
    }

    /**
     * Sets sole_op
     *
     * @param bool|null $sole_op True when the operation must be the only operation in its job (bypasses chain validation; ADR-0025). False/absent ⇒ chainable.
     *
     * @return self
     */
    public function setSoleOp($sole_op)
    {
        if (is_null($sole_op)) {
            throw new \InvalidArgumentException('non-nullable sole_op cannot be null');
        }
        $this->container['sole_op'] = $sole_op;

        return $this;
    }

    /**
     * Gets produces
     *
     * @return \Gisl\Generated\OpenApi\Model\CapabilityProduces|null
     */
    public function getProduces()
    {
        return $this->container['produces'];
    }

    /**
     * Sets produces
     *
     * @param \Gisl\Generated\OpenApi\Model\CapabilityProduces|null $produces produces
     *
     * @return self
     */
    public function setProduces($produces)
    {
        if (is_null($produces)) {
            throw new \InvalidArgumentException('non-nullable produces cannot be null');
        }
        $this->container['produces'] = $produces;

        return $this;
    }

    /**
     * Gets excludes
     *
     * @return \Gisl\Generated\OpenApi\Model\CapabilityConstraint[]|null
     */
    public function getExcludes()
    {
        return $this->container['excludes'];
    }

    /**
     * Sets excludes
     *
     * @param \Gisl\Generated\OpenApi\Model\CapabilityConstraint[]|null $excludes Hard-incompatibility constraints — when the `when` condition holds the operation/option combination is rejected with the constraint's `wire_code`.
     *
     * @return self
     */
    public function setExcludes($excludes)
    {
        if (is_null($excludes)) {
            throw new \InvalidArgumentException('non-nullable excludes cannot be null');
        }
        $this->container['excludes'] = $excludes;

        return $this;
    }

    /**
     * Gets requires
     *
     * @return \Gisl\Generated\OpenApi\Model\CapabilityConstraint[]|null
     */
    public function getRequires()
    {
        return $this->container['requires'];
    }

    /**
     * Sets requires
     *
     * @param \Gisl\Generated\OpenApi\Model\CapabilityConstraint[]|null $requires Co-requirement constraints — when `when` holds, the `requires_field` MUST be present (else `wire_code`, typically `invalid_options`).
     *
     * @return self
     */
    public function setRequires($requires)
    {
        if (is_null($requires)) {
            throw new \InvalidArgumentException('non-nullable requires cannot be null');
        }
        $this->container['requires'] = $requires;

        return $this;
    }

    /**
     * Gets option_conflicts
     *
     * @return \Gisl\Generated\OpenApi\Model\CapabilityConstraint[]|null
     */
    public function getOptionConflicts()
    {
        return $this->container['option_conflicts'];
    }

    /**
     * Sets option_conflicts
     *
     * @param \Gisl\Generated\OpenApi\Model\CapabilityConstraint[]|null $option_conflicts Mutually-exclusive option constraints within the operation.
     *
     * @return self
     */
    public function setOptionConflicts($option_conflicts)
    {
        if (is_null($option_conflicts)) {
            throw new \InvalidArgumentException('non-nullable option_conflicts cannot be null');
        }
        $this->container['option_conflicts'] = $option_conflicts;

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


