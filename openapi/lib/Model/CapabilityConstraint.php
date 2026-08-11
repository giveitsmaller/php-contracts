<?php
/**
 * CapabilityConstraint
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
 * The version of the OpenAPI document: 2.188.0
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
 * CapabilityConstraint Class Doc Comment
 *
 * @category Class
 * @description A single capability constraint (member of &#x60;excludes&#x60; / &#x60;requires&#x60; / &#x60;option_conflicts&#x60;). The &#x60;when&#x60; condition is evaluated against the resolved operation + sibling-operation context; when it holds, the constraint fires.
 * @package  Gisl\Generated\OpenApi
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<string, mixed>
 */
class CapabilityConstraint implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
     * The original name of the model.
     *
     * @var string
     */
    protected static $openAPIModelName = 'CapabilityConstraint';

    /**
     * Array of property to type mappings. Used for (de)serialization
     *
     * @var string[]
     */
    protected static $openAPITypes = [
        'constraint_id' => 'string',
        'message' => 'string',
        'wire_code' => 'string',
        'when' => '\Gisl\Generated\OpenApi\Model\CapabilityCondition',
        'availability' => '\Gisl\Generated\OpenApi\Model\AvailabilityValue',
        'eval_scope' => 'string',
        'requires_field' => 'string'
    ];

    /**
     * Array of property to format mappings. Used for (de)serialization
     *
     * @var string[]
     * @phpstan-var array<string, string|null>
     * @psalm-var array<string, string|null>
     */
    protected static $openAPIFormats = [
        'constraint_id' => null,
        'message' => null,
        'wire_code' => null,
        'when' => null,
        'availability' => null,
        'eval_scope' => null,
        'requires_field' => null
    ];

    /**
     * Array of nullable properties. Used for (de)serialization
     *
     * @var boolean[]
     */
    protected static array $openAPINullables = [
        'constraint_id' => false,
        'message' => false,
        'wire_code' => false,
        'when' => false,
        'availability' => false,
        'eval_scope' => false,
        'requires_field' => false
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
        'constraint_id' => 'constraint_id',
        'message' => 'message',
        'wire_code' => 'wire_code',
        'when' => 'when',
        'availability' => 'availability',
        'eval_scope' => 'eval_scope',
        'requires_field' => 'requires_field'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'constraint_id' => 'setConstraintId',
        'message' => 'setMessage',
        'wire_code' => 'setWireCode',
        'when' => 'setWhen',
        'availability' => 'setAvailability',
        'eval_scope' => 'setEvalScope',
        'requires_field' => 'setRequiresField'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'constraint_id' => 'getConstraintId',
        'message' => 'getMessage',
        'wire_code' => 'getWireCode',
        'when' => 'getWhen',
        'availability' => 'getAvailability',
        'eval_scope' => 'getEvalScope',
        'requires_field' => 'getRequiresField'
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

    public const WIRE_CODE_FEATURE_NOT_AVAILABLE = 'feature_not_available';
    public const WIRE_CODE_INVALID_OPTIONS = 'invalid_options';
    public const WIRE_CODE_INVALID_OPERATION_ORDER = 'INVALID_OPERATION_ORDER';
    public const WIRE_CODE_OPERATION_NOT_VALID_FOR_OUTPUT = 'OPERATION_NOT_VALID_FOR_OUTPUT';
    public const EVAL_SCOPE_API = 'api';

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getWireCodeAllowableValues()
    {
        return [
            self::WIRE_CODE_FEATURE_NOT_AVAILABLE,
            self::WIRE_CODE_INVALID_OPTIONS,
            self::WIRE_CODE_INVALID_OPERATION_ORDER,
            self::WIRE_CODE_OPERATION_NOT_VALID_FOR_OUTPUT,
        ];
    }

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getEvalScopeAllowableValues()
    {
        return [
            self::EVAL_SCOPE_API,
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
        $this->setIfExists('constraint_id', $data ?? [], null);
        $this->setIfExists('message', $data ?? [], null);
        $this->setIfExists('wire_code', $data ?? [], null);
        $this->setIfExists('when', $data ?? [], null);
        $this->setIfExists('availability', $data ?? [], null);
        $this->setIfExists('eval_scope', $data ?? [], null);
        $this->setIfExists('requires_field', $data ?? [], null);
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

        if ($this->container['constraint_id'] === null) {
            $invalidProperties[] = "'constraint_id' can't be null";
        }
        if ($this->container['message'] === null) {
            $invalidProperties[] = "'message' can't be null";
        }
        if ($this->container['wire_code'] === null) {
            $invalidProperties[] = "'wire_code' can't be null";
        }
        $allowedValues = $this->getWireCodeAllowableValues();
        if (!is_null($this->container['wire_code']) && !in_array($this->container['wire_code'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'wire_code', must be one of '%s'",
                $this->container['wire_code'],
                implode("', '", $allowedValues)
            );
        }

        if ($this->container['when'] === null) {
            $invalidProperties[] = "'when' can't be null";
        }
        $allowedValues = $this->getEvalScopeAllowableValues();
        if (!is_null($this->container['eval_scope']) && !in_array($this->container['eval_scope'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'eval_scope', must be one of '%s'",
                $this->container['eval_scope'],
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
     * Gets constraint_id
     *
     * @return string
     */
    public function getConstraintId()
    {
        return $this->container['constraint_id'];
    }

    /**
     * Sets constraint_id
     *
     * @param string $constraint_id Stable identifier for the constraint (for logs / docs / tests).
     *
     * @return self
     */
    public function setConstraintId($constraint_id)
    {
        if (is_null($constraint_id)) {
            throw new \InvalidArgumentException('non-nullable constraint_id cannot be null');
        }
        $this->container['constraint_id'] = $constraint_id;

        return $this;
    }

    /**
     * Gets message
     *
     * @return string
     */
    public function getMessage()
    {
        return $this->container['message'];
    }

    /**
     * Sets message
     *
     * @param string $message Human-readable rejection message. MAY contain `{placeholder}` tokens (e.g. `{output_format}`) the API interpolates at evaluation time.
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
     * Gets wire_code
     *
     * @return string
     */
    public function getWireCode()
    {
        return $this->container['wire_code'];
    }

    /**
     * Sets wire_code
     *
     * @param string $wire_code Error code emitted when the constraint fires. Aligns with the error envelope `error_code` vocabulary.
     *
     * @return self
     */
    public function setWireCode($wire_code)
    {
        if (is_null($wire_code)) {
            throw new \InvalidArgumentException('non-nullable wire_code cannot be null');
        }
        $allowedValues = $this->getWireCodeAllowableValues();
        if (!in_array($wire_code, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'wire_code', must be one of '%s'",
                    $wire_code,
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['wire_code'] = $wire_code;

        return $this;
    }

    /**
     * Gets when
     *
     * @return \Gisl\Generated\OpenApi\Model\CapabilityCondition
     */
    public function getWhen()
    {
        return $this->container['when'];
    }

    /**
     * Sets when
     *
     * @param \Gisl\Generated\OpenApi\Model\CapabilityCondition $when when
     *
     * @return self
     */
    public function setWhen($when)
    {
        if (is_null($when)) {
            throw new \InvalidArgumentException('non-nullable when cannot be null');
        }
        $this->container['when'] = $when;

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
     * Gets eval_scope
     *
     * @return string|null
     */
    public function getEvalScope()
    {
        return $this->container['eval_scope'];
    }

    /**
     * Sets eval_scope
     *
     * @param string|null $eval_scope Where the constraint is evaluated. `api` marks constraints the API create-path enforces (vs purely-advisory ones consumers mirror for UX). Absent ⇒ unscoped/advisory.
     *
     * @return self
     */
    public function setEvalScope($eval_scope)
    {
        if (is_null($eval_scope)) {
            throw new \InvalidArgumentException('non-nullable eval_scope cannot be null');
        }
        $allowedValues = $this->getEvalScopeAllowableValues();
        if (!in_array($eval_scope, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'eval_scope', must be one of '%s'",
                    $eval_scope,
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['eval_scope'] = $eval_scope;

        return $this;
    }

    /**
     * Gets requires_field
     *
     * @return string|null
     */
    public function getRequiresField()
    {
        return $this->container['requires_field'];
    }

    /**
     * Sets requires_field
     *
     * @param string|null $requires_field Only on `requires` constraints — the field path that must be present when `when` holds (e.g. `compress.target_size_bytes`).
     *
     * @return self
     */
    public function setRequiresField($requires_field)
    {
        if (is_null($requires_field)) {
            throw new \InvalidArgumentException('non-nullable requires_field cannot be null');
        }
        $this->container['requires_field'] = $requires_field;

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


