<?php
/**
 * OperationSchemaDefinition
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
 * OperationSchemaDefinition Class Doc Comment
 *
 * @category Class
 * @description Schema for a single operation type
 * @package  Gisl\Generated\OpenApi
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<string, mixed>
 */
class OperationSchemaDefinition implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
     * The original name of the model.
     *
     * @var string
     */
    protected static $openAPIModelName = 'OperationSchemaDefinition';

    /**
     * Array of property to type mappings. Used for (de)serialization
     *
     * @var string[]
     */
    protected static $openAPITypes = [
        'description' => 'string',
        'default' => 'bool',
        'availability' => '\Gisl\Generated\OpenApi\Model\AvailabilityValue',
        'required_tier' => '\Gisl\Generated\OpenApi\Model\UserTier',
        'input_model' => '\Gisl\Generated\OpenApi\Model\OperationInputModel',
        'min_inputs' => 'int',
        'max_inputs' => 'int',
        'sole_op' => 'bool',
        'per_role_cardinality' => 'array<string,\Gisl\Generated\OpenApi\Model\PerRoleCardinalityEntry>',
        'accepts_mixed_types' => 'bool',
        'mime_groups' => 'array<string,\Gisl\Generated\OpenApi\Model\MimeGroupSchema>',
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
        'description' => null,
        'default' => null,
        'availability' => null,
        'required_tier' => null,
        'input_model' => null,
        'min_inputs' => null,
        'max_inputs' => null,
        'sole_op' => null,
        'per_role_cardinality' => null,
        'accepts_mixed_types' => null,
        'mime_groups' => null,
        'options' => null,
        'per_input_options' => null
    ];

    /**
     * Array of nullable properties. Used for (de)serialization
     *
     * @var boolean[]
     */
    protected static array $openAPINullables = [
        'description' => false,
        'default' => false,
        'availability' => false,
        'required_tier' => false,
        'input_model' => false,
        'min_inputs' => false,
        'max_inputs' => false,
        'sole_op' => false,
        'per_role_cardinality' => false,
        'accepts_mixed_types' => false,
        'mime_groups' => false,
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
        'description' => 'description',
        'default' => 'default',
        'availability' => 'availability',
        'required_tier' => 'required_tier',
        'input_model' => 'input_model',
        'min_inputs' => 'min_inputs',
        'max_inputs' => 'max_inputs',
        'sole_op' => 'sole_op',
        'per_role_cardinality' => 'per_role_cardinality',
        'accepts_mixed_types' => 'accepts_mixed_types',
        'mime_groups' => 'mime_groups',
        'options' => 'options',
        'per_input_options' => 'per_input_options'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'description' => 'setDescription',
        'default' => 'setDefault',
        'availability' => 'setAvailability',
        'required_tier' => 'setRequiredTier',
        'input_model' => 'setInputModel',
        'min_inputs' => 'setMinInputs',
        'max_inputs' => 'setMaxInputs',
        'sole_op' => 'setSoleOp',
        'per_role_cardinality' => 'setPerRoleCardinality',
        'accepts_mixed_types' => 'setAcceptsMixedTypes',
        'mime_groups' => 'setMimeGroups',
        'options' => 'setOptions',
        'per_input_options' => 'setPerInputOptions'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'description' => 'getDescription',
        'default' => 'getDefault',
        'availability' => 'getAvailability',
        'required_tier' => 'getRequiredTier',
        'input_model' => 'getInputModel',
        'min_inputs' => 'getMinInputs',
        'max_inputs' => 'getMaxInputs',
        'sole_op' => 'getSoleOp',
        'per_role_cardinality' => 'getPerRoleCardinality',
        'accepts_mixed_types' => 'getAcceptsMixedTypes',
        'mime_groups' => 'getMimeGroups',
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
        $this->setIfExists('description', $data ?? [], null);
        $this->setIfExists('default', $data ?? [], null);
        $this->setIfExists('availability', $data ?? [], null);
        $this->setIfExists('required_tier', $data ?? [], null);
        $this->setIfExists('input_model', $data ?? [], null);
        $this->setIfExists('min_inputs', $data ?? [], null);
        $this->setIfExists('max_inputs', $data ?? [], null);
        $this->setIfExists('sole_op', $data ?? [], null);
        $this->setIfExists('per_role_cardinality', $data ?? [], null);
        $this->setIfExists('accepts_mixed_types', $data ?? [], null);
        $this->setIfExists('mime_groups', $data ?? [], null);
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

        if ($this->container['description'] === null) {
            $invalidProperties[] = "'description' can't be null";
        }
        if ($this->container['input_model'] === null) {
            $invalidProperties[] = "'input_model' can't be null";
        }
        if (!is_null($this->container['min_inputs']) && ($this->container['min_inputs'] < 1)) {
            $invalidProperties[] = "invalid value for 'min_inputs', must be bigger than or equal to 1.";
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
     * Gets description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->container['description'];
    }

    /**
     * Sets description
     *
     * @param string $description Human-readable description of what the operation does
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
     * Gets default
     *
     * @return bool|null
     */
    public function getDefault()
    {
        return $this->container['default'];
    }

    /**
     * Sets default
     *
     * @param bool|null $default Whether this is the default operation when none specified
     *
     * @return self
     */
    public function setDefault($default)
    {
        if (is_null($default)) {
            throw new \InvalidArgumentException('non-nullable default cannot be null');
        }
        $this->container['default'] = $default;

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
     * @param \Gisl\Generated\OpenApi\Model\AvailabilityValue|null $availability Operation-level availability tag. Optional — when absent, the operation is treated as `stable` (parser obligation per ADR-0001 §1.4 / FORMAT.md §Availability Taxonomy). Runtime emission lands with [I3 `eCWIpug8`](https://trello.com/c/eCWIpug8); until then the contract declares the shape but the endpoint does not yet surface the field.
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
     * @param \Gisl\Generated\OpenApi\Model\UserTier|null $required_tier Operation-level minimum subscription tier. Optional — when absent, the operation is available to all callers regardless of tier. Per ADR-0001 §1.3 (tier and availability are orthogonal axes). First operation-level consumer is `custom_luma` (`required_tier: pro`) per [I29 `EPUE5Vs1`](https://trello.com/c/EPUE5Vs1). SDK + frontend consumers gate UI on this value alongside `availability` to hide higher-tier features for lower-tier callers; the runtime returns `feature_tier_restricted` (403) on `POST /api/workflows` when violated. Same field exists at mime-group and option scope (see `MimeGroupSchema` / `OptionSchema` `availability` block — `required_tier` may also appear there for sub-shape gating).
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
     * Gets input_model
     *
     * @return \Gisl\Generated\OpenApi\Model\OperationInputModel
     */
    public function getInputModel()
    {
        return $this->container['input_model'];
    }

    /**
     * Sets input_model
     *
     * @param \Gisl\Generated\OpenApi\Model\OperationInputModel $input_model input_model
     *
     * @return self
     */
    public function setInputModel($input_model)
    {
        if (is_null($input_model)) {
            throw new \InvalidArgumentException('non-nullable input_model cannot be null');
        }
        $this->container['input_model'] = $input_model;

        return $this;
    }

    /**
     * Gets min_inputs
     *
     * @return int|null
     */
    public function getMinInputs()
    {
        return $this->container['min_inputs'];
    }

    /**
     * Sets min_inputs
     *
     * @param int|null $min_inputs Minimum number of inputs (multi-input operations only). `audio_to_video` declares `min_inputs: 1` (first role-based op with an optional role); all other role-based ops declare `min_inputs: 2`. Per `per_role_cardinality` semantics (ADR-0015), this value equals the sum of role-level minima.
     *
     * @return self
     */
    public function setMinInputs($min_inputs)
    {
        if (is_null($min_inputs)) {
            throw new \InvalidArgumentException('non-nullable min_inputs cannot be null');
        }

        if (($min_inputs < 1)) {
            throw new \InvalidArgumentException('invalid value for $min_inputs when calling OperationSchemaDefinition., must be bigger than or equal to 1.');
        }

        $this->container['min_inputs'] = $min_inputs;

        return $this;
    }

    /**
     * Gets max_inputs
     *
     * @return int|null
     */
    public function getMaxInputs()
    {
        return $this->container['max_inputs'];
    }

    /**
     * Sets max_inputs
     *
     * @param int|null $max_inputs Maximum number of inputs (multi-input operations only)
     *
     * @return self
     */
    public function setMaxInputs($max_inputs)
    {
        if (is_null($max_inputs)) {
            throw new \InvalidArgumentException('non-nullable max_inputs cannot be null');
        }
        $this->container['max_inputs'] = $max_inputs;

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
     * @param bool|null $sole_op When `true`, this operation MUST be the only operation in its job — it cannot be chained with other operations in the same job's `operations[]`. To combine it with another operation (e.g. watermark + compress), model them as SEPARATE jobs linked via `workflow_edges` (the downstream job's `source` references the upstream via `job_output`). Optional — absent means `false` (the operation chains normally). Set on the ten ops the API bars from co-bundling (`OperationType::bypassesV1ChainValidator()`): the multi-input ops (merge, archive, image_watermark, video_watermark, audio_overlay, audio_to_video, custom_luma) and the single-input fan-out / leaf ops (text_watermark, video_text_watermark, split). SDK + frontend gate on this to DISABLE-or-EXPLAIN an invalid op-combination before submit, instead of surfacing a workflow-create 422. Per ADR-0025 (interim signal ahead of the full operation-compatibility model, ADR-0024).
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
     * Gets per_role_cardinality
     *
     * @return array<string,\Gisl\Generated\OpenApi\Model\PerRoleCardinalityEntry>|null
     */
    public function getPerRoleCardinality()
    {
        return $this->container['per_role_cardinality'];
    }

    /**
     * Sets per_role_cardinality
     *
     * @param array<string,\Gisl\Generated\OpenApi\Model\PerRoleCardinalityEntry>|null $per_role_cardinality Optional per-role input-count overlay for role-based multi-input operations. Per ticket [`SlluxMBN`](https://trello.com/c/SlluxMBN) / ADR-0015. Present on all five role-based ops (audio_to_video, video_watermark, audio_overlay, image_watermark, custom_luma); absent on non-role ops (merge, archive) where all inputs share a single role.
     *
     * @return self
     */
    public function setPerRoleCardinality($per_role_cardinality)
    {
        if (is_null($per_role_cardinality)) {
            throw new \InvalidArgumentException('non-nullable per_role_cardinality cannot be null');
        }
        $this->container['per_role_cardinality'] = $per_role_cardinality;

        return $this;
    }

    /**
     * Gets accepts_mixed_types
     *
     * @return bool|null
     */
    public function getAcceptsMixedTypes()
    {
        return $this->container['accepts_mixed_types'];
    }

    /**
     * Sets accepts_mixed_types
     *
     * @param bool|null $accepts_mixed_types Whether mixed MIME types are allowed (archive only)
     *
     * @return self
     */
    public function setAcceptsMixedTypes($accepts_mixed_types)
    {
        if (is_null($accepts_mixed_types)) {
            throw new \InvalidArgumentException('non-nullable accepts_mixed_types cannot be null');
        }
        $this->container['accepts_mixed_types'] = $accepts_mixed_types;

        return $this;
    }

    /**
     * Gets mime_groups
     *
     * @return array<string,\Gisl\Generated\OpenApi\Model\MimeGroupSchema>|null
     */
    public function getMimeGroups()
    {
        return $this->container['mime_groups'];
    }

    /**
     * Sets mime_groups
     *
     * @param array<string,\Gisl\Generated\OpenApi\Model\MimeGroupSchema>|null $mime_groups MIME-type-specific option schemas. When present, options are grouped by MIME category (image, video, audio, document). Each group lists the supported MIME types and group-specific options.
     *
     * @return self
     */
    public function setMimeGroups($mime_groups)
    {
        if (is_null($mime_groups)) {
            throw new \InvalidArgumentException('non-nullable mime_groups cannot be null');
        }
        $this->container['mime_groups'] = $mime_groups;

        return $this;
    }

    /**
     * Gets options
     *
     * @return array<string,\Gisl\Generated\OpenApi\Model\OptionSchema>|null
     */
    public function getOptions()
    {
        return $this->container['options'];
    }

    /**
     * Sets options
     *
     * @param array<string,\Gisl\Generated\OpenApi\Model\OptionSchema>|null $options Global options applicable regardless of MIME type, keyed by option name. **Optional** per ticket [IXE7QDxe](https://trello.com/c/IXE7QDxe) — operations declaring `mime_groups` typically carry their options inside the mime_group, so operation-level `options` is omitted on those (e.g. `compress`, `thumbnail`, `convert`, `image_watermark`). Operation-level `options` is present primarily for media-agnostic operations like `archive` whose options don't vary by MIME type.  **Parser obligation.** Consumers MUST treat absent / null `options` as `{}` (empty mapping). API runtime SHOULD emit `{}` rather than `null` or omitting the field, but consumers handle all three cases gracefully — same precedent as the absent-equals-stable rule for `availability` per ADR-0001 §1.4.
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
     * @param array<string,\Gisl\Generated\OpenApi\Model\OptionSchema>|null $per_input_options Options that can be overridden per-input for multi-input operations, keyed by option name. For merge: per-join-point transition overrides.
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


