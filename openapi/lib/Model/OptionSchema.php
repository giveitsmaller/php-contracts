<?php
/**
 * OptionSchema
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
 * OptionSchema Class Doc Comment
 *
 * @category Class
 * @description Schema for a single operation option
 * @package  Gisl\Generated\OpenApi
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<string, mixed>
 */
class OptionSchema implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
     * The original name of the model.
     *
     * @var string
     */
    protected static $openAPIModelName = 'OptionSchema';

    /**
     * Array of property to type mappings. Used for (de)serialization
     *
     * @var string[]
     */
    protected static $openAPITypes = [
        'type' => 'string',
        'description' => 'string',
        'required' => 'bool',
        'default' => 'mixed',
        'values' => 'mixed[]',
        'value_type' => 'string',
        'availability' => '\Gisl\Generated\OpenApi\Model\AvailabilityValue',
        'required_tier' => '\Gisl\Generated\OpenApi\Model\UserTier',
        'per_value_availability' => 'array<string,\Gisl\Generated\OpenApi\Model\PerValueAvailabilityEntry>',
        'per_value_depends_on' => 'array<string,mixed>',
        'min' => 'float',
        'max' => 'float',
        'pattern' => 'string',
        'depends_on' => 'array<string,mixed>',
        'honored_on' => 'string[]'
    ];

    /**
     * Array of property to format mappings. Used for (de)serialization
     *
     * @var string[]
     * @phpstan-var array<string, string|null>
     * @psalm-var array<string, string|null>
     */
    protected static $openAPIFormats = [
        'type' => null,
        'description' => null,
        'required' => null,
        'default' => null,
        'values' => null,
        'value_type' => null,
        'availability' => null,
        'required_tier' => null,
        'per_value_availability' => null,
        'per_value_depends_on' => null,
        'min' => null,
        'max' => null,
        'pattern' => null,
        'depends_on' => null,
        'honored_on' => null
    ];

    /**
     * Array of nullable properties. Used for (de)serialization
     *
     * @var boolean[]
     */
    protected static array $openAPINullables = [
        'type' => false,
        'description' => false,
        'required' => false,
        'default' => true,
        'values' => false,
        'value_type' => false,
        'availability' => false,
        'required_tier' => false,
        'per_value_availability' => false,
        'per_value_depends_on' => false,
        'min' => false,
        'max' => false,
        'pattern' => false,
        'depends_on' => false,
        'honored_on' => false
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
        'type' => 'type',
        'description' => 'description',
        'required' => 'required',
        'default' => 'default',
        'values' => 'values',
        'value_type' => 'value_type',
        'availability' => 'availability',
        'required_tier' => 'required_tier',
        'per_value_availability' => 'per_value_availability',
        'per_value_depends_on' => 'per_value_depends_on',
        'min' => 'min',
        'max' => 'max',
        'pattern' => 'pattern',
        'depends_on' => 'depends_on',
        'honored_on' => 'honored_on'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'type' => 'setType',
        'description' => 'setDescription',
        'required' => 'setRequired',
        'default' => 'setDefault',
        'values' => 'setValues',
        'value_type' => 'setValueType',
        'availability' => 'setAvailability',
        'required_tier' => 'setRequiredTier',
        'per_value_availability' => 'setPerValueAvailability',
        'per_value_depends_on' => 'setPerValueDependsOn',
        'min' => 'setMin',
        'max' => 'setMax',
        'pattern' => 'setPattern',
        'depends_on' => 'setDependsOn',
        'honored_on' => 'setHonoredOn'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'type' => 'getType',
        'description' => 'getDescription',
        'required' => 'getRequired',
        'default' => 'getDefault',
        'values' => 'getValues',
        'value_type' => 'getValueType',
        'availability' => 'getAvailability',
        'required_tier' => 'getRequiredTier',
        'per_value_availability' => 'getPerValueAvailability',
        'per_value_depends_on' => 'getPerValueDependsOn',
        'min' => 'getMin',
        'max' => 'getMax',
        'pattern' => 'getPattern',
        'depends_on' => 'getDependsOn',
        'honored_on' => 'getHonoredOn'
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

    public const TYPE_INTEGER = 'integer';
    public const TYPE_FLOAT = 'float';
    public const TYPE_BOOLEAN = 'boolean';
    public const TYPE_ENUM = 'enum';
    public const TYPE_STRING = 'string';
    public const TYPE__ARRAY = 'array';
    public const VALUE_TYPE_INTEGER = 'integer';
    public const VALUE_TYPE_FLOAT = 'float';
    public const HONORED_ON_SAME_FORMAT = 'same_format';
    public const HONORED_ON_FORMAT_CHANGE = 'format_change';

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getTypeAllowableValues()
    {
        return [
            self::TYPE_INTEGER,
            self::TYPE_FLOAT,
            self::TYPE_BOOLEAN,
            self::TYPE_ENUM,
            self::TYPE_STRING,
            self::TYPE__ARRAY,
        ];
    }

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getValueTypeAllowableValues()
    {
        return [
            self::VALUE_TYPE_INTEGER,
            self::VALUE_TYPE_FLOAT,
        ];
    }

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getHonoredOnAllowableValues()
    {
        return [
            self::HONORED_ON_SAME_FORMAT,
            self::HONORED_ON_FORMAT_CHANGE,
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
        $this->setIfExists('type', $data ?? [], null);
        $this->setIfExists('description', $data ?? [], null);
        $this->setIfExists('required', $data ?? [], null);
        $this->setIfExists('default', $data ?? [], null);
        $this->setIfExists('values', $data ?? [], null);
        $this->setIfExists('value_type', $data ?? [], null);
        $this->setIfExists('availability', $data ?? [], null);
        $this->setIfExists('required_tier', $data ?? [], null);
        $this->setIfExists('per_value_availability', $data ?? [], null);
        $this->setIfExists('per_value_depends_on', $data ?? [], null);
        $this->setIfExists('min', $data ?? [], null);
        $this->setIfExists('max', $data ?? [], null);
        $this->setIfExists('pattern', $data ?? [], null);
        $this->setIfExists('depends_on', $data ?? [], null);
        $this->setIfExists('honored_on', $data ?? [], null);
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

        if ($this->container['type'] === null) {
            $invalidProperties[] = "'type' can't be null";
        }
        $allowedValues = $this->getTypeAllowableValues();
        if (!is_null($this->container['type']) && !in_array($this->container['type'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'type', must be one of '%s'",
                $this->container['type'],
                implode("', '", $allowedValues)
            );
        }

        $allowedValues = $this->getValueTypeAllowableValues();
        if (!is_null($this->container['value_type']) && !in_array($this->container['value_type'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'value_type', must be one of '%s'",
                $this->container['value_type'],
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
     * Gets type
     *
     * @return string
     */
    public function getType()
    {
        return $this->container['type'];
    }

    /**
     * Sets type
     *
     * @param string $type Option value type
     *
     * @return self
     */
    public function setType($type)
    {
        if (is_null($type)) {
            throw new \InvalidArgumentException('non-nullable type cannot be null');
        }
        $allowedValues = $this->getTypeAllowableValues();
        if (!in_array($type, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'type', must be one of '%s'",
                    $type,
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['type'] = $type;

        return $this;
    }

    /**
     * Gets description
     *
     * @return string|null
     */
    public function getDescription()
    {
        return $this->container['description'];
    }

    /**
     * Sets description
     *
     * @param string|null $description Human-readable description
     *
     * @return self
     */
    public function setDescription($description)
    {
        if (is_null($description)) {
            throw new \InvalidArgumentException('non-nullable description cannot be null');
        }
        $this->container['description'] = $description;

        return $this;
    }

    /**
     * Gets required
     *
     * @return bool|null
     */
    public function getRequired()
    {
        return $this->container['required'];
    }

    /**
     * Sets required
     *
     * @param bool|null $required Whether the option is required
     *
     * @return self
     */
    public function setRequired($required)
    {
        if (is_null($required)) {
            throw new \InvalidArgumentException('non-nullable required cannot be null');
        }
        $this->container['required'] = $required;

        return $this;
    }

    /**
     * Gets default
     *
     * @return mixed|null
     */
    public function getDefault()
    {
        return $this->container['default'];
    }

    /**
     * Sets default
     *
     * @param mixed|null $default default
     *
     * @return self
     */
    public function setDefault($default)
    {
        if (is_null($default)) {
            array_push($this->openAPINullablesSetToNull, 'default');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('default', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['default'] = $default;

        return $this;
    }

    /**
     * Gets values
     *
     * @return mixed[]|null
     */
    public function getValues()
    {
        return $this->container['values'];
    }

    /**
     * Sets values
     *
     * @param mixed[]|null $values Allowed values (for enum type)
     *
     * @return self
     */
    public function setValues($values)
    {
        if (is_null($values)) {
            throw new \InvalidArgumentException('non-nullable values cannot be null');
        }
        $this->container['values'] = $values;

        return $this;
    }

    /**
     * Gets value_type
     *
     * @return string|null
     */
    public function getValueType()
    {
        return $this->container['value_type'];
    }

    /**
     * Sets value_type
     *
     * @param string|null $value_type Actual type of enum values when not strings (e.g. \"integer\" for numeric bitrate enums). Consumers should parse/display values as this type rather than as strings.
     *
     * @return self
     */
    public function setValueType($value_type)
    {
        if (is_null($value_type)) {
            throw new \InvalidArgumentException('non-nullable value_type cannot be null');
        }
        $allowedValues = $this->getValueTypeAllowableValues();
        if (!in_array($value_type, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'value_type', must be one of '%s'",
                    $value_type,
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['value_type'] = $value_type;

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
     * @param \Gisl\Generated\OpenApi\Model\AvailabilityValue|null $availability Option-level availability tag. Optional — absent ≡ `stable`. See `OperationSchemaDefinition.availability` for runtime emission timeline (lands with I3).
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
     * @param \Gisl\Generated\OpenApi\Model\UserTier|null $required_tier Option-level minimum subscription tier. Optional — absent means no tier restriction at the option level. Same semantics as `OperationSchemaDefinition.required_tier` but scoped to a single option (e.g. an operation may have a free-tier base option set with one or two `pro`-tier advanced options gated this way).
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
     * Gets per_value_availability
     *
     * @return array<string,\Gisl\Generated\OpenApi\Model\PerValueAvailabilityEntry>|null
     */
    public function getPerValueAvailability()
    {
        return $this->container['per_value_availability'];
    }

    /**
     * Sets per_value_availability
     *
     * @param array<string,\Gisl\Generated\OpenApi\Model\PerValueAvailabilityEntry>|null $per_value_availability Per-enum-value availability map, only meaningful when `type: enum`. Keys MUST be a subset of `values[]`. Untagged values default to `availability: stable`. Verified by `make check-per-value-availability` (CI guard, ticket [I17 `0gwtwCav`](https://trello.com/c/0gwtwCav)). Runtime emission lands with I3.
     *
     * @return self
     */
    public function setPerValueAvailability($per_value_availability)
    {
        if (is_null($per_value_availability)) {
            throw new \InvalidArgumentException('non-nullable per_value_availability cannot be null');
        }
        $this->container['per_value_availability'] = $per_value_availability;

        return $this;
    }

    /**
     * Gets per_value_depends_on
     *
     * @return array<string,mixed>|null
     */
    public function getPerValueDependsOn()
    {
        return $this->container['per_value_depends_on'];
    }

    /**
     * Sets per_value_depends_on
     *
     * @param array<string,mixed>|null $per_value_depends_on Per-enum-value cross-field constraint map, only meaningful when `type: enum`. Keys MUST be a subset of `values[]`; each entry value is a `depends_on`-shaped condition mapping that the named enum value REQUIRES. Distinct from option-level `depends_on`, which gates the WHOLE option's applicability and IS enforced by the API at workflow-create (`OperationOptionsValidator`: a submitted option whose gate is unmet is rejected as `invalid_options`; an absent one is inactive). `per_value_depends_on` instead constrains a single VALUE of an otherwise-active option. ENFORCEMENT NOTE: the API's create-time validator does NOT yet evaluate `per_value_depends_on` (only option-level `depends_on`); it is shape-checked metadata that SDK/FE consume to gate the value, with the worker as the reject backstop (a future API version may add create-time enforcement, contract-first). When unmet it logically requires the request be rejected as `invalid_options` (intent; per the enforcement note above this is not yet API-create-enforced), the option itself staying active. The KEY/SHAPE (keys are a subset of `values[]`; condition cross-refs resolve) is verified by `make check-per-value-depends-on` (CI guard, ticket [`bsV3FWM5`](https://trello.com/c/bsV3FWM5)) — shape only, NOT runtime/worker enforcement. Runtime emission ships verbatim alongside other availability metadata. See `schemas/FORMAT.md` §per_value_depends_on.
     *
     * @return self
     */
    public function setPerValueDependsOn($per_value_depends_on)
    {
        if (is_null($per_value_depends_on)) {
            throw new \InvalidArgumentException('non-nullable per_value_depends_on cannot be null');
        }
        $this->container['per_value_depends_on'] = $per_value_depends_on;

        return $this;
    }

    /**
     * Gets min
     *
     * @return float|null
     */
    public function getMin()
    {
        return $this->container['min'];
    }

    /**
     * Sets min
     *
     * @param float|null $min Minimum value (for integer/float types)
     *
     * @return self
     */
    public function setMin($min)
    {
        if (is_null($min)) {
            throw new \InvalidArgumentException('non-nullable min cannot be null');
        }
        $this->container['min'] = $min;

        return $this;
    }

    /**
     * Gets max
     *
     * @return float|null
     */
    public function getMax()
    {
        return $this->container['max'];
    }

    /**
     * Sets max
     *
     * @param float|null $max Maximum value (for integer/float types)
     *
     * @return self
     */
    public function setMax($max)
    {
        if (is_null($max)) {
            throw new \InvalidArgumentException('non-nullable max cannot be null');
        }
        $this->container['max'] = $max;

        return $this;
    }

    /**
     * Gets pattern
     *
     * @return string|null
     */
    public function getPattern()
    {
        return $this->container['pattern'];
    }

    /**
     * Sets pattern
     *
     * @param string|null $pattern ECMA-262 regular expression a `type: string` value MUST match (the string analogue of `min`/`max`). Consumers pre-validate against it before submit, and the server rejects a non-matching value as `invalid_options` — so the contract never advertises a free-form string for an option whose worker silently drops non-conforming input (e.g. `convert.image.background` honours only `#RRGGBB`; a CSS named colour was silently dropped to white). Only meaningful for `type: string`. See `schemas/FORMAT.md`.
     *
     * @return self
     */
    public function setPattern($pattern)
    {
        if (is_null($pattern)) {
            throw new \InvalidArgumentException('non-nullable pattern cannot be null');
        }
        $this->container['pattern'] = $pattern;

        return $this;
    }

    /**
     * Gets depends_on
     *
     * @return array<string,mixed>|null
     */
    public function getDependsOn()
    {
        return $this->container['depends_on'];
    }

    /**
     * Sets depends_on
     *
     * @param array<string,mixed>|null $depends_on Conditional dependency. This option is only applicable when the condition is met. Simple: `{ \"mode\": \"lossy\" }` — option applies when mode equals lossy. Multi-value: `{ \"output_format\": [\"jpeg\", \"webp\"] }` — option applies when output_format is any listed value. Set condition: `{ \"width\": \"set\", \"height\": \"set\", \"logic\": \"or\" }` — option applies when width or height is provided. The \"set\" sentinel means the option has any value. \"logic\" can be \"and\" (default) or \"or\".
     *
     * @return self
     */
    public function setDependsOn($depends_on)
    {
        if (is_null($depends_on)) {
            throw new \InvalidArgumentException('non-nullable depends_on cannot be null');
        }
        $this->container['depends_on'] = $depends_on;

        return $this;
    }

    /**
     * Gets honored_on
     *
     * @return string[]|null
     */
    public function getHonoredOn()
    {
        return $this->container['honored_on'];
    }

    /**
     * Sets honored_on
     *
     * @param string[]|null $honored_on Route-applicability tag for the image \"Output\" facade (per `schemas/FORMAT.md` §\"Route-aware Output model\"). Lists the route(s) whose worker actually honours this option. The Output op routes by comparing the authored/resolved `output_format` to the input format: `same_format` (output_format == input, or `original`) runs the optimiser path; `format_change` (output_format != input) runs the transcoder path. An option `honored_on: [same_format]` is read only on the optimiser path (e.g. JPEG `progressive`); `[format_change]` only on the transcoder path (e.g. `background` alpha-flatten to JPEG). ABSENT ≡ honored on every route the option's `depends_on` already admits (back-compat — existing options need no tag). Orthogonal to `availability`: a `planned` option still declares the route it WILL be honoured on. Consumers derive option visibility from `honored_on` ∩ active-route ∩ (availability != planned) ∩ depends_on. Token validity (subset of {same_format, format_change}) is verified by `make check-image-output-routes`. The derived per-(media, route, output_format) projection lives at `accepted-options/image-output-routes.json`.
     *
     * @return self
     */
    public function setHonoredOn($honored_on)
    {
        if (is_null($honored_on)) {
            throw new \InvalidArgumentException('non-nullable honored_on cannot be null');
        }
        $allowedValues = $this->getHonoredOnAllowableValues();
        if (array_diff($honored_on, $allowedValues)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value for 'honored_on', must be one of '%s'",
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['honored_on'] = $honored_on;

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


