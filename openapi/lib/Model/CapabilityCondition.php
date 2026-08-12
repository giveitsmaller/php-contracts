<?php
/**
 * CapabilityCondition
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
 * CapabilityCondition Class Doc Comment
 *
 * @category Class
 * @description Recursive condition node (the &#x60;Cond&#x60; field-token model, ADR-0024 §2). Exactly ONE form per node — a boolean combinator (&#x60;all&#x60; / &#x60;any&#x60; / &#x60;not&#x60;) OR a single leaf test. A leaf tests one &#x60;field&#x60; token with exactly one operator (&#x60;equals&#x60; / &#x60;in&#x60; / &#x60;isSet&#x60;), except &#x60;opSelected&#x60; which is a standalone leaf asserting a sibling operation of that type is present in the job. Consumers compute field tokens locally from the resolved request (no new wire field). Modelled as a &#x60;oneOf&#x60; of the valid forms (each &#x60;additionalProperties: false&#x60;) so the grammar is enforced rather than advertised as a loose bag of optional keys.
 * @package  Gisl\Generated\OpenApi
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<string, mixed>
 */
class CapabilityCondition implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
     * The original name of the model.
     *
     * @var string
     */
    protected static $openAPIModelName = 'CapabilityCondition';

    /**
     * Array of property to type mappings. Used for (de)serialization
     *
     * @var string[]
     */
    protected static $openAPITypes = [
        'all' => '\Gisl\Generated\OpenApi\Model\CapabilityCondition[]',
        'any' => '\Gisl\Generated\OpenApi\Model\CapabilityCondition[]',
        'not' => '\Gisl\Generated\OpenApi\Model\CapabilityCondition',
        'field' => 'string',
        'equals' => 'mixed',
        'in' => 'mixed[]',
        'is_set' => 'bool',
        'op_selected' => 'string'
    ];

    /**
     * Array of property to format mappings. Used for (de)serialization
     *
     * @var string[]
     * @phpstan-var array<string, string|null>
     * @psalm-var array<string, string|null>
     */
    protected static $openAPIFormats = [
        'all' => null,
        'any' => null,
        'not' => null,
        'field' => null,
        'equals' => null,
        'in' => null,
        'is_set' => null,
        'op_selected' => null
    ];

    /**
     * Array of nullable properties. Used for (de)serialization
     *
     * @var boolean[]
     */
    protected static array $openAPINullables = [
        'all' => false,
        'any' => false,
        'not' => false,
        'field' => false,
        'equals' => true,
        'in' => false,
        'is_set' => false,
        'op_selected' => false
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
        'all' => 'all',
        'any' => 'any',
        'not' => 'not',
        'field' => 'field',
        'equals' => 'equals',
        'in' => 'in',
        'is_set' => 'isSet',
        'op_selected' => 'opSelected'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'all' => 'setAll',
        'any' => 'setAny',
        'not' => 'setNot',
        'field' => 'setField',
        'equals' => 'setEquals',
        'in' => 'setIn',
        'is_set' => 'setIsSet',
        'op_selected' => 'setOpSelected'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'all' => 'getAll',
        'any' => 'getAny',
        'not' => 'getNot',
        'field' => 'getField',
        'equals' => 'getEquals',
        'in' => 'getIn',
        'is_set' => 'getIsSet',
        'op_selected' => 'getOpSelected'
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
        $this->setIfExists('all', $data ?? [], null);
        $this->setIfExists('any', $data ?? [], null);
        $this->setIfExists('not', $data ?? [], null);
        $this->setIfExists('field', $data ?? [], null);
        $this->setIfExists('equals', $data ?? [], null);
        $this->setIfExists('in', $data ?? [], null);
        $this->setIfExists('is_set', $data ?? [], null);
        $this->setIfExists('op_selected', $data ?? [], null);
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

        if ($this->container['all'] === null) {
            $invalidProperties[] = "'all' can't be null";
        }
        if ($this->container['any'] === null) {
            $invalidProperties[] = "'any' can't be null";
        }
        if ($this->container['not'] === null) {
            $invalidProperties[] = "'not' can't be null";
        }
        if ($this->container['field'] === null) {
            $invalidProperties[] = "'field' can't be null";
        }
        if ($this->container['equals'] === null && !$this->isNullableSetToNull('equals')) {
            $invalidProperties[] = "'equals' can't be null";
        }
        if ($this->container['in'] === null) {
            $invalidProperties[] = "'in' can't be null";
        }
        if ($this->container['is_set'] === null) {
            $invalidProperties[] = "'is_set' can't be null";
        }
        if ($this->container['op_selected'] === null) {
            $invalidProperties[] = "'op_selected' can't be null";
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
     * Gets all
     *
     * @return \Gisl\Generated\OpenApi\Model\CapabilityCondition[]
     */
    public function getAll()
    {
        return $this->container['all'];
    }

    /**
     * Sets all
     *
     * @param \Gisl\Generated\OpenApi\Model\CapabilityCondition[] $all All sub-conditions must hold (logical AND).
     *
     * @return self
     */
    public function setAll($all)
    {
        if (is_null($all)) {
            throw new \InvalidArgumentException('non-nullable all cannot be null');
        }
        $this->container['all'] = $all;

        return $this;
    }

    /**
     * Gets any
     *
     * @return \Gisl\Generated\OpenApi\Model\CapabilityCondition[]
     */
    public function getAny()
    {
        return $this->container['any'];
    }

    /**
     * Sets any
     *
     * @param \Gisl\Generated\OpenApi\Model\CapabilityCondition[] $any At least one sub-condition must hold (logical OR).
     *
     * @return self
     */
    public function setAny($any)
    {
        if (is_null($any)) {
            throw new \InvalidArgumentException('non-nullable any cannot be null');
        }
        $this->container['any'] = $any;

        return $this;
    }

    /**
     * Gets not
     *
     * @return \Gisl\Generated\OpenApi\Model\CapabilityCondition
     */
    public function getNot()
    {
        return $this->container['not'];
    }

    /**
     * Sets not
     *
     * @param \Gisl\Generated\OpenApi\Model\CapabilityCondition $not not
     *
     * @return self
     */
    public function setNot($not)
    {
        if (is_null($not)) {
            throw new \InvalidArgumentException('non-nullable not cannot be null');
        }
        $this->container['not'] = $not;

        return $this;
    }

    /**
     * Gets field
     *
     * @return string
     */
    public function getField()
    {
        return $this->container['field'];
    }

    /**
     * Sets field
     *
     * @param string $field Field token under test.
     *
     * @return self
     */
    public function setField($field)
    {
        if (is_null($field)) {
            throw new \InvalidArgumentException('non-nullable field cannot be null');
        }
        $this->container['field'] = $field;

        return $this;
    }

    /**
     * Gets equals
     *
     * @return mixed|null
     */
    public function getEquals()
    {
        return $this->container['equals'];
    }

    /**
     * Sets equals
     *
     * @param mixed|null $equals equals
     *
     * @return self
     */
    public function setEquals($equals)
    {
        if (is_null($equals)) {
            array_push($this->openAPINullablesSetToNull, 'equals');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('equals', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['equals'] = $equals;

        return $this;
    }

    /**
     * Gets in
     *
     * @return mixed[]
     */
    public function getIn()
    {
        return $this->container['in'];
    }

    /**
     * Sets in
     *
     * @param mixed[] $in Leaf test — `field` is one of these values.
     *
     * @return self
     */
    public function setIn($in)
    {
        if (is_null($in)) {
            throw new \InvalidArgumentException('non-nullable in cannot be null');
        }
        $this->container['in'] = $in;

        return $this;
    }

    /**
     * Gets is_set
     *
     * @return bool
     */
    public function getIsSet()
    {
        return $this->container['is_set'];
    }

    /**
     * Sets is_set
     *
     * @param bool $is_set Leaf test — asserts `field` is present/set. Only the positive form is used; negate via a wrapping `not` node.
     *
     * @return self
     */
    public function setIsSet($is_set)
    {
        if (is_null($is_set)) {
            throw new \InvalidArgumentException('non-nullable is_set cannot be null');
        }
        $this->container['is_set'] = $is_set;

        return $this;
    }

    /**
     * Gets op_selected
     *
     * @return string
     */
    public function getOpSelected()
    {
        return $this->container['op_selected'];
    }

    /**
     * Sets op_selected
     *
     * @param string $op_selected Standalone leaf — true when a sibling operation of this type is selected in the same job (e.g. `compress`, `convert`).
     *
     * @return self
     */
    public function setOpSelected($op_selected)
    {
        if (is_null($op_selected)) {
            throw new \InvalidArgumentException('non-nullable op_selected cannot be null');
        }
        $this->container['op_selected'] = $op_selected;

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


