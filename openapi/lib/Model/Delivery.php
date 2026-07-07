<?php
/**
 * Delivery
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
 * Delivery Class Doc Comment
 *
 * @category Class
 * @description Workflow-level delivery configuration per [ADR-0003](../docs/decisions/0003-delivery-mode.md). Optional — when absent, the workflow defaults to &#x60;mode: individual, selection.type: terminal&#x60; (current V1 behaviour).  **Validator rules (runtime-enforced; spec documents):** 1. If &#x60;selection.type: explicit&#x60; AND any job in &#x60;jobs[]&#x60; has    &#x60;deliver: true&#x60;, the request is rejected with HTTP 422 —    these two promotion mechanisms are mutually exclusive. 2. If &#x60;mode !&#x3D; individual&#x60;, &#x60;bundle_format&#x60; is required.
 * @package  Gisl\Generated\OpenApi
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<string, mixed>
 */
class Delivery implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
     * The original name of the model.
     *
     * @var string
     */
    protected static $openAPIModelName = 'Delivery';

    /**
     * Array of property to type mappings. Used for (de)serialization
     *
     * @var string[]
     */
    protected static $openAPITypes = [
        'mode' => 'string',
        'bundle_format' => 'string',
        'bundle_filename' => 'string',
        'include_metadata' => 'bool',
        'selection' => '\Gisl\Generated\OpenApi\Model\DeliverySelection'
    ];

    /**
     * Array of property to format mappings. Used for (de)serialization
     *
     * @var string[]
     * @phpstan-var array<string, string|null>
     * @psalm-var array<string, string|null>
     */
    protected static $openAPIFormats = [
        'mode' => null,
        'bundle_format' => null,
        'bundle_filename' => null,
        'include_metadata' => null,
        'selection' => null
    ];

    /**
     * Array of nullable properties. Used for (de)serialization
     *
     * @var boolean[]
     */
    protected static array $openAPINullables = [
        'mode' => false,
        'bundle_format' => false,
        'bundle_filename' => false,
        'include_metadata' => false,
        'selection' => false
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
        'mode' => 'mode',
        'bundle_format' => 'bundle_format',
        'bundle_filename' => 'bundle_filename',
        'include_metadata' => 'include_metadata',
        'selection' => 'selection'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'mode' => 'setMode',
        'bundle_format' => 'setBundleFormat',
        'bundle_filename' => 'setBundleFilename',
        'include_metadata' => 'setIncludeMetadata',
        'selection' => 'setSelection'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'mode' => 'getMode',
        'bundle_format' => 'getBundleFormat',
        'bundle_filename' => 'getBundleFilename',
        'include_metadata' => 'getIncludeMetadata',
        'selection' => 'getSelection'
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

    public const MODE_INDIVIDUAL = 'individual';
    public const MODE_BUNDLE = 'bundle';
    public const MODE_BOTH = 'both';
    public const BUNDLE_FORMAT_ZIP = 'zip';
    public const BUNDLE_FORMAT_TAR_GZ = 'tar_gz';

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getModeAllowableValues()
    {
        return [
            self::MODE_INDIVIDUAL,
            self::MODE_BUNDLE,
            self::MODE_BOTH,
        ];
    }

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getBundleFormatAllowableValues()
    {
        return [
            self::BUNDLE_FORMAT_ZIP,
            self::BUNDLE_FORMAT_TAR_GZ,
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
        $this->setIfExists('mode', $data ?? [], 'individual');
        $this->setIfExists('bundle_format', $data ?? [], null);
        $this->setIfExists('bundle_filename', $data ?? [], null);
        $this->setIfExists('include_metadata', $data ?? [], false);
        $this->setIfExists('selection', $data ?? [], null);
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

        $allowedValues = $this->getModeAllowableValues();
        if (!is_null($this->container['mode']) && !in_array($this->container['mode'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'mode', must be one of '%s'",
                $this->container['mode'],
                implode("', '", $allowedValues)
            );
        }

        $allowedValues = $this->getBundleFormatAllowableValues();
        if (!is_null($this->container['bundle_format']) && !in_array($this->container['bundle_format'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'bundle_format', must be one of '%s'",
                $this->container['bundle_format'],
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
     * Gets mode
     *
     * @return string|null
     */
    public function getMode()
    {
        return $this->container['mode'];
    }

    /**
     * Sets mode
     *
     * @param string|null $mode Delivery mode. `individual` is the only committed value today (per ticket [`co0CERtJ`](https://trello.com/c/co0CERtJ)). `bundle` and `both` are `planned`: the API runtime returns `422 feature_not_available` for any non-`individual` value, which per the `info.description` availability taxonomy is the `planned` behaviour (`stable`/`beta` MUST NOT 422).  For workflows that need a packaged output today, compose a terminal `archive` job whose `sources` are `JobOutputSource` refs to the upstream jobs — `archive` is the canonical output-bundler per ADR-0017. `delivery.mode: bundle` is the deferred post-launch ergonomic sugar that will reuse the same `archive` runtime under the hood.
     *
     * @return self
     */
    public function setMode($mode)
    {
        if (is_null($mode)) {
            throw new \InvalidArgumentException('non-nullable mode cannot be null');
        }
        $allowedValues = $this->getModeAllowableValues();
        if (!in_array($mode, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'mode', must be one of '%s'",
                    $mode,
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['mode'] = $mode;

        return $this;
    }

    /**
     * Gets bundle_format
     *
     * @return string|null
     */
    public function getBundleFormat()
    {
        return $this->container['bundle_format'];
    }

    /**
     * Sets bundle_format
     *
     * @param string|null $bundle_format Required when `mode != individual`. Format of the bundle output. Validator rule encoded in description per repo convention; runtime returns 422 if missing.
     *
     * @return self
     */
    public function setBundleFormat($bundle_format)
    {
        if (is_null($bundle_format)) {
            throw new \InvalidArgumentException('non-nullable bundle_format cannot be null');
        }
        $allowedValues = $this->getBundleFormatAllowableValues();
        if (!in_array($bundle_format, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'bundle_format', must be one of '%s'",
                    $bundle_format,
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['bundle_format'] = $bundle_format;

        return $this;
    }

    /**
     * Gets bundle_filename
     *
     * @return string|null
     */
    public function getBundleFilename()
    {
        return $this->container['bundle_filename'];
    }

    /**
     * Sets bundle_filename
     *
     * @param string|null $bundle_filename Optional bundle filename (without extension; server adds `.zip` / `.tar.gz` as appropriate). Server generates one from workflow_id when omitted.
     *
     * @return self
     */
    public function setBundleFilename($bundle_filename)
    {
        if (is_null($bundle_filename)) {
            throw new \InvalidArgumentException('non-nullable bundle_filename cannot be null');
        }
        $this->container['bundle_filename'] = $bundle_filename;

        return $this;
    }

    /**
     * Gets include_metadata
     *
     * @return bool|null
     */
    public function getIncludeMetadata()
    {
        return $this->container['include_metadata'];
    }

    /**
     * Sets include_metadata
     *
     * @param bool|null $include_metadata When `true`, embed a `manifest.json` inside the bundle describing each output (job_id, operation, original filename, size, etc.). The manifest's exact wire shape is runtime-defined and not pinned in this spec; consumers should treat it as an additive JSON object whose schema may evolve in minor versions.
     *
     * @return self
     */
    public function setIncludeMetadata($include_metadata)
    {
        if (is_null($include_metadata)) {
            throw new \InvalidArgumentException('non-nullable include_metadata cannot be null');
        }
        $this->container['include_metadata'] = $include_metadata;

        return $this;
    }

    /**
     * Gets selection
     *
     * @return \Gisl\Generated\OpenApi\Model\DeliverySelection|null
     */
    public function getSelection()
    {
        return $this->container['selection'];
    }

    /**
     * Sets selection
     *
     * @param \Gisl\Generated\OpenApi\Model\DeliverySelection|null $selection How to pick outputs. Default `terminal` (leaves only).
     *
     * @return self
     */
    public function setSelection($selection)
    {
        if (is_null($selection)) {
            throw new \InvalidArgumentException('non-nullable selection cannot be null');
        }
        $this->container['selection'] = $selection;

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


