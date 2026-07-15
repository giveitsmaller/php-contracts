<?php
/**
 * OperationResultMetrics
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
 * The version of the OpenAPI document: 2.166.0
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
 * OperationResultMetrics Class Doc Comment
 *
 * @category Class
 * @description Operation-specific performance metrics, carried on the **completion result** surface (SSE &#x60;operation.completed&#x60; result / result-on-poll), NOT on the workflow **status** read (confirmed ZjVXHkYK / api). &#x60;GET /api/workflows/{id}&#x60; serialises each operation as &#x60;{id, type, status}&#x60; plus a conditional &#x60;error_message&#x60;/&#x60;error_code&#x60; — it does NOT carry &#x60;result.metrics&#x60;, so &#x60;re_encode_decision&#x60; / &#x60;re_encode_reason&#x60; are not readable from the status poll. Canonical reads for those: the per-job &#x60;processing_class&#x60; echo (on the status response) for the route, and &#x60;GET /api/workflows/{id}/downloads&#x60; (per-output &#x60;size_bytes&#x60;) for the authoritative output size. Note &#x60;metrics&#x60; has no &#x60;output_size_bytes&#x60; field — output size lives on &#x60;size_bytes&#x60; / the downloads endpoint.
 * @package  Gisl\Generated\OpenApi
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<string, mixed>
 */
class OperationResultMetrics implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
     * The original name of the model.
     *
     * @var string
     */
    protected static $openAPIModelName = 'OperationResult_metrics';

    /**
     * Array of property to type mappings. Used for (de)serialization
     *
     * @var string[]
     */
    protected static $openAPITypes = [
        'compression_ratio' => 'float',
        'chosen_quality' => 'int',
        'target_size_met' => 'bool',
        'measured_quality' => 'float',
        'quality_metric' => 'string',
        'duration_ms' => 'int',
        're_encode_decision' => '\Gisl\Generated\OpenApi\Model\ReEncodeDecision',
        're_encode_reason' => 'string'
    ];

    /**
     * Array of property to format mappings. Used for (de)serialization
     *
     * @var string[]
     * @phpstan-var array<string, string|null>
     * @psalm-var array<string, string|null>
     */
    protected static $openAPIFormats = [
        'compression_ratio' => 'double',
        'chosen_quality' => null,
        'target_size_met' => null,
        'measured_quality' => 'double',
        'quality_metric' => null,
        'duration_ms' => null,
        're_encode_decision' => null,
        're_encode_reason' => null
    ];

    /**
     * Array of nullable properties. Used for (de)serialization
     *
     * @var boolean[]
     */
    protected static array $openAPINullables = [
        'compression_ratio' => false,
        'chosen_quality' => false,
        'target_size_met' => false,
        'measured_quality' => false,
        'quality_metric' => false,
        'duration_ms' => false,
        're_encode_decision' => false,
        're_encode_reason' => false
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
        'compression_ratio' => 'compression_ratio',
        'chosen_quality' => 'chosen_quality',
        'target_size_met' => 'target_size_met',
        'measured_quality' => 'measured_quality',
        'quality_metric' => 'quality_metric',
        'duration_ms' => 'duration_ms',
        're_encode_decision' => 're_encode_decision',
        're_encode_reason' => 're_encode_reason'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'compression_ratio' => 'setCompressionRatio',
        'chosen_quality' => 'setChosenQuality',
        'target_size_met' => 'setTargetSizeMet',
        'measured_quality' => 'setMeasuredQuality',
        'quality_metric' => 'setQualityMetric',
        'duration_ms' => 'setDurationMs',
        're_encode_decision' => 'setReEncodeDecision',
        're_encode_reason' => 'setReEncodeReason'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'compression_ratio' => 'getCompressionRatio',
        'chosen_quality' => 'getChosenQuality',
        'target_size_met' => 'getTargetSizeMet',
        'measured_quality' => 'getMeasuredQuality',
        'quality_metric' => 'getQualityMetric',
        'duration_ms' => 'getDurationMs',
        're_encode_decision' => 'getReEncodeDecision',
        're_encode_reason' => 'getReEncodeReason'
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
        $this->setIfExists('compression_ratio', $data ?? [], null);
        $this->setIfExists('chosen_quality', $data ?? [], null);
        $this->setIfExists('target_size_met', $data ?? [], null);
        $this->setIfExists('measured_quality', $data ?? [], null);
        $this->setIfExists('quality_metric', $data ?? [], null);
        $this->setIfExists('duration_ms', $data ?? [], null);
        $this->setIfExists('re_encode_decision', $data ?? [], null);
        $this->setIfExists('re_encode_reason', $data ?? [], null);
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

        if (!is_null($this->container['chosen_quality']) && ($this->container['chosen_quality'] > 100)) {
            $invalidProperties[] = "invalid value for 'chosen_quality', must be smaller than or equal to 100.";
        }

        if (!is_null($this->container['chosen_quality']) && ($this->container['chosen_quality'] < 1)) {
            $invalidProperties[] = "invalid value for 'chosen_quality', must be bigger than or equal to 1.";
        }

        if (!is_null($this->container['measured_quality']) && ($this->container['measured_quality'] > 1)) {
            $invalidProperties[] = "invalid value for 'measured_quality', must be smaller than or equal to 1.";
        }

        if (!is_null($this->container['measured_quality']) && ($this->container['measured_quality'] < 0)) {
            $invalidProperties[] = "invalid value for 'measured_quality', must be bigger than or equal to 0.";
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
     * Gets compression_ratio
     *
     * @return float|null
     */
    public function getCompressionRatio()
    {
        return $this->container['compression_ratio'];
    }

    /**
     * Sets compression_ratio
     *
     * @param float|null $compression_ratio Ratio of output size to input size (e.g. 0.45 = 55% reduction)
     *
     * @return self
     */
    public function setCompressionRatio($compression_ratio)
    {
        if (is_null($compression_ratio)) {
            throw new \InvalidArgumentException('non-nullable compression_ratio cannot be null');
        }
        $this->container['compression_ratio'] = $compression_ratio;

        return $this;
    }

    /**
     * Gets chosen_quality
     *
     * @return int|null
     */
    public function getChosenQuality()
    {
        return $this->container['chosen_quality'];
    }

    /**
     * Sets chosen_quality
     *
     * @param int|null $chosen_quality The encoder quality the search settled on — for a `target_size` encode OR an `auto_quality` encode (the quality that met the `quality_preset` perceptual target). Present for target_size and auto_quality operations. Mirrors the AsyncAPI `OperationMetrics.chosen_quality`; lets the client show \"hit your target at quality 66\".
     *
     * @return self
     */
    public function setChosenQuality($chosen_quality)
    {
        if (is_null($chosen_quality)) {
            throw new \InvalidArgumentException('non-nullable chosen_quality cannot be null');
        }

        if (($chosen_quality > 100)) {
            throw new \InvalidArgumentException('invalid value for $chosen_quality when calling OperationResultMetrics., must be smaller than or equal to 100.');
        }
        if (($chosen_quality < 1)) {
            throw new \InvalidArgumentException('invalid value for $chosen_quality when calling OperationResultMetrics., must be bigger than or equal to 1.');
        }

        $this->container['chosen_quality'] = $chosen_quality;

        return $this;
    }

    /**
     * Gets target_size_met
     *
     * @return bool|null
     */
    public function getTargetSizeMet()
    {
        return $this->container['target_size_met'];
    }

    /**
     * Sets target_size_met
     *
     * @param bool|null $target_size_met Whether the `target_size` encode landed at or under the requested `target_size_bytes`. `false` is an honest best-effort outcome (target unreachable at min quality), not a failure. Present only for a target_size operation. Mirrors `OperationMetrics.target_size_met`.
     *
     * @return self
     */
    public function setTargetSizeMet($target_size_met)
    {
        if (is_null($target_size_met)) {
            throw new \InvalidArgumentException('non-nullable target_size_met cannot be null');
        }
        $this->container['target_size_met'] = $target_size_met;

        return $this;
    }

    /**
     * Gets measured_quality
     *
     * @return float|null
     */
    public function getMeasuredQuality()
    {
        return $this->container['measured_quality'];
    }

    /**
     * Sets measured_quality
     *
     * @param float|null $measured_quality The achieved perceptual-quality score (0.0–1.0) for an `auto_quality` encode (compress.image jpeg/webp/avif). Present only for an auto_quality operation; pairs with `chosen_quality`. Metric-agnostic — the producing metric is named in `quality_metric`. Mirrors `OperationMetrics.measured_quality`.
     *
     * @return self
     */
    public function setMeasuredQuality($measured_quality)
    {
        if (is_null($measured_quality)) {
            throw new \InvalidArgumentException('non-nullable measured_quality cannot be null');
        }

        if (($measured_quality > 1)) {
            throw new \InvalidArgumentException('invalid value for $measured_quality when calling OperationResultMetrics., must be smaller than or equal to 1.');
        }
        if (($measured_quality < 0)) {
            throw new \InvalidArgumentException('invalid value for $measured_quality when calling OperationResultMetrics., must be bigger than or equal to 0.');
        }

        $this->container['measured_quality'] = $measured_quality;

        return $this;
    }

    /**
     * Gets quality_metric
     *
     * @return string|null
     */
    public function getQualityMetric()
    {
        return $this->container['quality_metric'];
    }

    /**
     * Sets quality_metric
     *
     * @param string|null $quality_metric The perceptual metric that produced `measured_quality` — a free-form string (not an enum) so it can evolve without contract churn. Present only for an auto_quality operation. Current value: `ssim`. Mirrors `OperationMetrics.quality_metric`.
     *
     * @return self
     */
    public function setQualityMetric($quality_metric)
    {
        if (is_null($quality_metric)) {
            throw new \InvalidArgumentException('non-nullable quality_metric cannot be null');
        }
        $this->container['quality_metric'] = $quality_metric;

        return $this;
    }

    /**
     * Gets duration_ms
     *
     * @return int|null
     */
    public function getDurationMs()
    {
        return $this->container['duration_ms'];
    }

    /**
     * Sets duration_ms
     *
     * @param int|null $duration_ms Processing time in milliseconds
     *
     * @return self
     */
    public function setDurationMs($duration_ms)
    {
        if (is_null($duration_ms)) {
            throw new \InvalidArgumentException('non-nullable duration_ms cannot be null');
        }
        $this->container['duration_ms'] = $duration_ms;

        return $this;
    }

    /**
     * Gets re_encode_decision
     *
     * @return \Gisl\Generated\OpenApi\Model\ReEncodeDecision|null
     */
    public function getReEncodeDecision()
    {
        return $this->container['re_encode_decision'];
    }

    /**
     * Sets re_encode_decision
     *
     * @param \Gisl\Generated\OpenApi\Model\ReEncodeDecision|null $re_encode_decision re_encode_decision
     *
     * @return self
     */
    public function setReEncodeDecision($re_encode_decision)
    {
        if (is_null($re_encode_decision)) {
            throw new \InvalidArgumentException('non-nullable re_encode_decision cannot be null');
        }
        $this->container['re_encode_decision'] = $re_encode_decision;

        return $this;
    }

    /**
     * Gets re_encode_reason
     *
     * @return string|null
     */
    public function getReEncodeReason()
    {
        return $this->container['re_encode_reason'];
    }

    /**
     * Sets re_encode_reason
     *
     * @param string|null $re_encode_reason Advisory explanation for `re_encode_decision` (e.g. `all_inputs_compatible`, `explicit_always_mode`, `input_codec_mismatch`, `input_framerate_mismatch`). Free-form string — not an enum — so the Lambda can emit human-readable diagnostics that evolve without contract changes. Mirrors `OperationMetrics.re_encode_reason`.
     *
     * @return self
     */
    public function setReEncodeReason($re_encode_reason)
    {
        if (is_null($re_encode_reason)) {
            throw new \InvalidArgumentException('non-nullable re_encode_reason cannot be null');
        }
        $this->container['re_encode_reason'] = $re_encode_reason;

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


