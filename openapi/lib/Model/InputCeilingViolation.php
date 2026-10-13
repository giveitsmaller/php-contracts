<?php
/**
 * InputCeilingViolation
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
 * The version of the OpenAPI document: 2.231.0
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
 * InputCeilingViolation Class Doc Comment
 *
 * @category Class
 * @description Present on a &#x60;details[]&#x60; entry when the entry reports a measured quantity exceeding a declared ceiling, as data (cards [&#x60;cxTBYffD&#x60;](https://trello.com/c/cxTBYffD), &#x60;E7iYw68p&#x60;). It carries what &#x60;message&#x60; says in prose, so a client can show \&quot;22.4 MB, limit 20 MiB\&quot; and branch on \&quot;too large\&quot; without reading English. The entry&#39;s &#x60;message_params&#x60; repeat these fields for the localised text.  Two uses today, told apart by the entry&#39;s &#x60;message_key&#x60;: - &#x60;error.input_exceeds_ceiling&#x60;: ONE input over an unbanded group&#39;s   &#x60;max_input_size_bytes&#x60;, a pixel ceiling, or a duration ceiling. - &#x60;error.merge.combined_too_long&#x60; / &#x60;error.merge.combined_too_large&#x60;:   the COMBINED inputs of a non-uniform video merge over   &#x60;short_form_concat&#x60;&#39;s total (&#x60;MERGE_OVER_LIMIT&#x60;, owner decision   755). &#x60;axis&#x60; is the total&#39;s axis and &#x60;bound_by&#x60; is &#x60;merge&#x60;.  A job that merely routes to a higher processing class is not an error here: an escalation that finds no class able to take the input is &#x60;ProcessingClassExceedsBandResponse&#x60;, never this.  **Optional and additive.** Its absence on a size refusal means the server predates this field; fall back to &#x60;message&#x60;. Do not read absence as \&quot;not a ceiling refusal\&quot;.
 * @package  Gisl\Generated\OpenApi
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<string, mixed>
 */
class InputCeilingViolation implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
     * The original name of the model.
     *
     * @var string
     */
    protected static $openAPIModelName = 'InputCeilingViolation';

    /**
     * Array of property to type mappings. Used for (de)serialization
     *
     * @var string[]
     */
    protected static $openAPITypes = [
        'axis' => 'string',
        'actual' => 'int',
        'maximum' => 'int',
        'bound_by' => 'string',
        'input_mime' => 'string'
    ];

    /**
     * Array of property to format mappings. Used for (de)serialization
     *
     * @var string[]
     * @phpstan-var array<string, string|null>
     * @psalm-var array<string, string|null>
     */
    protected static $openAPIFormats = [
        'axis' => null,
        'actual' => 'int64',
        'maximum' => 'int64',
        'bound_by' => null,
        'input_mime' => null
    ];

    /**
     * Array of nullable properties. Used for (de)serialization
     *
     * @var boolean[]
     */
    protected static array $openAPINullables = [
        'axis' => false,
        'actual' => false,
        'maximum' => false,
        'bound_by' => false,
        'input_mime' => false
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
        'axis' => 'axis',
        'actual' => 'actual',
        'maximum' => 'maximum',
        'bound_by' => 'bound_by',
        'input_mime' => 'input_mime'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'axis' => 'setAxis',
        'actual' => 'setActual',
        'maximum' => 'setMaximum',
        'bound_by' => 'setBoundBy',
        'input_mime' => 'setInputMime'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'axis' => 'getAxis',
        'actual' => 'getActual',
        'maximum' => 'getMaximum',
        'bound_by' => 'getBoundBy',
        'input_mime' => 'getInputMime'
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
        $this->setIfExists('axis', $data ?? [], null);
        $this->setIfExists('actual', $data ?? [], null);
        $this->setIfExists('maximum', $data ?? [], null);
        $this->setIfExists('bound_by', $data ?? [], null);
        $this->setIfExists('input_mime', $data ?? [], null);
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

        if ($this->container['axis'] === null) {
            $invalidProperties[] = "'axis' can't be null";
        }
        if ($this->container['actual'] === null) {
            $invalidProperties[] = "'actual' can't be null";
        }
        if (($this->container['actual'] < 0)) {
            $invalidProperties[] = "invalid value for 'actual', must be bigger than or equal to 0.";
        }

        if ($this->container['maximum'] === null) {
            $invalidProperties[] = "'maximum' can't be null";
        }
        if (($this->container['maximum'] < 0)) {
            $invalidProperties[] = "invalid value for 'maximum', must be bigger than or equal to 0.";
        }

        if ($this->container['bound_by'] === null) {
            $invalidProperties[] = "'bound_by' can't be null";
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
     * Gets axis
     *
     * @return string
     */
    public function getAxis()
    {
        return $this->container['axis'];
    }

    /**
     * Sets axis
     *
     * @param string $axis Which quantity exceeded its ceiling. Values today: `size_bytes`, `pixels`, `duration_seconds`. The set is open: treat an unknown axis as \"input too large\" and show `message`.
     *
     * @return self
     */
    public function setAxis($axis)
    {
        if (is_null($axis)) {
            throw new \InvalidArgumentException('non-nullable axis cannot be null');
        }
        $this->container['axis'] = $axis;

        return $this;
    }

    /**
     * Gets actual
     *
     * @return int
     */
    public function getActual()
    {
        return $this->container['actual'];
    }

    /**
     * Sets actual
     *
     * @param int $actual The input's measured value on `axis` (bytes, pixels, or whole seconds rounded UP).
     *
     * @return self
     */
    public function setActual($actual)
    {
        if (is_null($actual)) {
            throw new \InvalidArgumentException('non-nullable actual cannot be null');
        }

        if (($actual < 0)) {
            throw new \InvalidArgumentException('invalid value for $actual when calling InputCeilingViolation., must be bigger than or equal to 0.');
        }

        $this->container['actual'] = $actual;

        return $this;
    }

    /**
     * Gets maximum
     *
     * @return int
     */
    public function getMaximum()
    {
        return $this->container['maximum'];
    }

    /**
     * Sets maximum
     *
     * @param int $maximum The binding ceiling on `axis`, in the same unit as `actual`.
     *
     * @return self
     */
    public function setMaximum($maximum)
    {
        if (is_null($maximum)) {
            throw new \InvalidArgumentException('non-nullable maximum cannot be null');
        }

        if (($maximum < 0)) {
            throw new \InvalidArgumentException('invalid value for $maximum when calling InputCeilingViolation., must be bigger than or equal to 0.');
        }

        $this->container['maximum'] = $maximum;

        return $this;
    }

    /**
     * Gets bound_by
     *
     * @return string
     */
    public function getBoundBy()
    {
        return $this->container['bound_by'];
    }

    /**
     * Sets bound_by
     *
     * @param string $bound_by The operation whose ceiling binds. **Not always the operation that ingests the file**: in a `[compress, thumbnail]` job the thumbnail's tighter ceiling can refuse a file `compress` accepts, and then this is `thumbnail`. The smallest applicable ceiling across the job's operations is the one reported.
     *
     * @return self
     */
    public function setBoundBy($bound_by)
    {
        if (is_null($bound_by)) {
            throw new \InvalidArgumentException('non-nullable bound_by cannot be null');
        }
        $this->container['bound_by'] = $bound_by;

        return $this;
    }

    /**
     * Gets input_mime
     *
     * @return string|null
     */
    public function getInputMime()
    {
        return $this->container['input_mime'];
    }

    /**
     * Sets input_mime
     *
     * @param string|null $input_mime The input's MIME type, as the ceiling was looked up.
     *
     * @return self
     */
    public function setInputMime($input_mime)
    {
        if (is_null($input_mime)) {
            throw new \InvalidArgumentException('non-nullable input_mime cannot be null');
        }
        $this->container['input_mime'] = $input_mime;

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


