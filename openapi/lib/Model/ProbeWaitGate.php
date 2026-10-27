<?php
/**
 * ProbeWaitGate
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
 * The version of the OpenAPI document: 2.236.0
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
 * ProbeWaitGate Class Doc Comment
 *
 * @category Class
 * @package  Gisl\Generated\OpenApi
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<string, mixed>
 */
class ProbeWaitGate implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
     * The original name of the model.
     *
     * @var string
     */
    protected static $openAPIModelName = 'ProbeWaitGate';

    /**
     * Array of property to type mappings. Used for (de)serialization
     *
     * @var string[]
     */
    protected static $openAPITypes = [
        'id' => 'string',
        'operation' => 'string',
        'media' => 'string',
        'callers' => 'string',
        'output_format' => 'string[]',
        'output_type' => 'string[]',
        'job_ref' => 'string',
        'status' => 'string',
        'decision' => 'string'
    ];

    /**
     * Array of property to format mappings. Used for (de)serialization
     *
     * @var string[]
     * @phpstan-var array<string, string|null>
     * @psalm-var array<string, string|null>
     */
    protected static $openAPIFormats = [
        'id' => null,
        'operation' => null,
        'media' => null,
        'callers' => null,
        'output_format' => null,
        'output_type' => null,
        'job_ref' => null,
        'status' => null,
        'decision' => null
    ];

    /**
     * Array of nullable properties. Used for (de)serialization
     *
     * @var boolean[]
     */
    protected static array $openAPINullables = [
        'id' => false,
        'operation' => false,
        'media' => false,
        'callers' => false,
        'output_format' => false,
        'output_type' => false,
        'job_ref' => false,
        'status' => false,
        'decision' => false
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
        'id' => 'id',
        'operation' => 'operation',
        'media' => 'media',
        'callers' => 'callers',
        'output_format' => 'output_format',
        'output_type' => 'output_type',
        'job_ref' => 'job_ref',
        'status' => 'status',
        'decision' => 'decision'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'id' => 'setId',
        'operation' => 'setOperation',
        'media' => 'setMedia',
        'callers' => 'setCallers',
        'output_format' => 'setOutputFormat',
        'output_type' => 'setOutputType',
        'job_ref' => 'setJobRef',
        'status' => 'setStatus',
        'decision' => 'setDecision'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'id' => 'getId',
        'operation' => 'getOperation',
        'media' => 'getMedia',
        'callers' => 'getCallers',
        'output_format' => 'getOutputFormat',
        'output_type' => 'getOutputType',
        'job_ref' => 'getJobRef',
        'status' => 'getStatus',
        'decision' => 'getDecision'
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

    public const MEDIA_VIDEO = 'video';
    public const MEDIA_APPLICATION_PDF = 'application/pdf';
    public const CALLERS_ALL = 'all';
    public const CALLERS_GUEST = 'guest';
    public const JOB_REF_OWN = 'own';
    public const JOB_REF_FEEDER = 'feeder';
    public const STATUS_LIVE = 'live';
    public const STATUS_DECLARED = 'declared';

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getMediaAllowableValues()
    {
        return [
            self::MEDIA_VIDEO,
            self::MEDIA_APPLICATION_PDF,
        ];
    }

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getCallersAllowableValues()
    {
        return [
            self::CALLERS_ALL,
            self::CALLERS_GUEST,
        ];
    }

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getJobRefAllowableValues()
    {
        return [
            self::JOB_REF_OWN,
            self::JOB_REF_FEEDER,
        ];
    }

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getStatusAllowableValues()
    {
        return [
            self::STATUS_LIVE,
            self::STATUS_DECLARED,
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
        $this->setIfExists('id', $data ?? [], null);
        $this->setIfExists('operation', $data ?? [], null);
        $this->setIfExists('media', $data ?? [], null);
        $this->setIfExists('callers', $data ?? [], null);
        $this->setIfExists('output_format', $data ?? [], null);
        $this->setIfExists('output_type', $data ?? [], null);
        $this->setIfExists('job_ref', $data ?? [], null);
        $this->setIfExists('status', $data ?? [], null);
        $this->setIfExists('decision', $data ?? [], null);
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

        if ($this->container['id'] === null) {
            $invalidProperties[] = "'id' can't be null";
        }
        if ($this->container['operation'] === null) {
            $invalidProperties[] = "'operation' can't be null";
        }
        if ($this->container['media'] === null) {
            $invalidProperties[] = "'media' can't be null";
        }
        $allowedValues = $this->getMediaAllowableValues();
        if (!is_null($this->container['media']) && !in_array($this->container['media'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'media', must be one of '%s'",
                $this->container['media'],
                implode("', '", $allowedValues)
            );
        }

        if ($this->container['callers'] === null) {
            $invalidProperties[] = "'callers' can't be null";
        }
        $allowedValues = $this->getCallersAllowableValues();
        if (!is_null($this->container['callers']) && !in_array($this->container['callers'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'callers', must be one of '%s'",
                $this->container['callers'],
                implode("', '", $allowedValues)
            );
        }

        if ($this->container['job_ref'] === null) {
            $invalidProperties[] = "'job_ref' can't be null";
        }
        $allowedValues = $this->getJobRefAllowableValues();
        if (!is_null($this->container['job_ref']) && !in_array($this->container['job_ref'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'job_ref', must be one of '%s'",
                $this->container['job_ref'],
                implode("', '", $allowedValues)
            );
        }

        if ($this->container['status'] === null) {
            $invalidProperties[] = "'status' can't be null";
        }
        $allowedValues = $this->getStatusAllowableValues();
        if (!is_null($this->container['status']) && !in_array($this->container['status'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'status', must be one of '%s'",
                $this->container['status'],
                implode("', '", $allowedValues)
            );
        }

        if ($this->container['decision'] === null) {
            $invalidProperties[] = "'decision' can't be null";
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
     * Gets id
     *
     * @return string
     */
    public function getId()
    {
        return $this->container['id'];
    }

    /**
     * Sets id
     *
     * @param string $id id
     *
     * @return self
     */
    public function setId($id)
    {
        if (is_null($id)) {
            throw new \InvalidArgumentException('non-nullable id cannot be null');
        }
        $this->container['id'] = $id;

        return $this;
    }

    /**
     * Gets operation
     *
     * @return string
     */
    public function getOperation()
    {
        return $this->container['operation'];
    }

    /**
     * Sets operation
     *
     * @param string $operation An operation type, or `*` for any operation.
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
     * Gets media
     *
     * @return string
     */
    public function getMedia()
    {
        return $this->container['media'];
    }

    /**
     * Sets media
     *
     * @param string $media The media of the UPLOAD the job waits on (the job's own input). An image-input merge is not a `video` gate.
     *
     * @return self
     */
    public function setMedia($media)
    {
        if (is_null($media)) {
            throw new \InvalidArgumentException('non-nullable media cannot be null');
        }
        $allowedValues = $this->getMediaAllowableValues();
        if (!in_array($media, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'media', must be one of '%s'",
                    $media,
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['media'] = $media;

        return $this;
    }

    /**
     * Gets callers
     *
     * @return string
     */
    public function getCallers()
    {
        return $this->container['callers'];
    }

    /**
     * Sets callers
     *
     * @param string $callers `guest` = null-owner (account-less) callers only.
     *
     * @return self
     */
    public function setCallers($callers)
    {
        if (is_null($callers)) {
            throw new \InvalidArgumentException('non-nullable callers cannot be null');
        }
        $allowedValues = $this->getCallersAllowableValues();
        if (!in_array($callers, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'callers', must be one of '%s'",
                    $callers,
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['callers'] = $callers;

        return $this;
    }

    /**
     * Gets output_format
     *
     * @return string[]|null
     */
    public function getOutputFormat()
    {
        return $this->container['output_format'];
    }

    /**
     * Sets output_format
     *
     * @param string[]|null $output_format Optional. The gate applies only when the job's `output_format` is one of these; absent = any output.
     *
     * @return self
     */
    public function setOutputFormat($output_format)
    {
        if (is_null($output_format)) {
            throw new \InvalidArgumentException('non-nullable output_format cannot be null');
        }
        $this->container['output_format'] = $output_format;

        return $this;
    }

    /**
     * Gets output_type
     *
     * @return string[]|null
     */
    public function getOutputType()
    {
        return $this->container['output_type'];
    }

    /**
     * Sets output_type
     *
     * @param string[]|null $output_type Optional. The same selector for a merge's `output_type` option (today `[video]`; a gif merge does not wait); absent = any.
     *
     * @return self
     */
    public function setOutputType($output_type)
    {
        if (is_null($output_type)) {
            throw new \InvalidArgumentException('non-nullable output_type cannot be null');
        }
        $this->container['output_type'] = $output_type;

        return $this;
    }

    /**
     * Gets job_ref
     *
     * @return string
     */
    public function getJobRef()
    {
        return $this->container['job_ref'];
    }

    /**
     * Sets job_ref
     *
     * @param string $job_ref Which job `probe_pending.job_ref` names.
     *
     * @return self
     */
    public function setJobRef($job_ref)
    {
        if (is_null($job_ref)) {
            throw new \InvalidArgumentException('non-nullable job_ref cannot be null');
        }
        $allowedValues = $this->getJobRefAllowableValues();
        if (!in_array($job_ref, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'job_ref', must be one of '%s'",
                    $job_ref,
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['job_ref'] = $job_ref;

        return $this;
    }

    /**
     * Gets status
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->container['status'];
    }

    /**
     * Sets status
     *
     * @param string $status `live` = the API enforces it today. `declared` = the contract states it and the API switch is not on yet: a consumer MAY pre-wait anyway but MUST NOT expect a `probe_pending` for it.
     *
     * @return self
     */
    public function setStatus($status)
    {
        if (is_null($status)) {
            throw new \InvalidArgumentException('non-nullable status cannot be null');
        }
        $allowedValues = $this->getStatusAllowableValues();
        if (!in_array($status, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'status', must be one of '%s'",
                    $status,
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['status'] = $status;

        return $this;
    }

    /**
     * Gets decision
     *
     * @return string
     */
    public function getDecision()
    {
        return $this->container['decision'];
    }

    /**
     * Sets decision
     *
     * @param string $decision The owner / hub decision or card behind the gate.
     *
     * @return self
     */
    public function setDecision($decision)
    {
        if (is_null($decision)) {
            throw new \InvalidArgumentException('non-nullable decision cannot be null');
        }
        $this->container['decision'] = $decision;

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


