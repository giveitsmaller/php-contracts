<?php
/**
 * OperationDownload
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
 * OperationDownload Class Doc Comment
 *
 * @category Class
 * @description A single deliverable output file for an operation. For multi-output fan-out (e.g. convert PDF-&gt;image emits one file per page), each entry carries an indexing field. This is the REST projection of the same indexing model the AsyncAPI &#x60;OperationResultOutputEntry&#x60; defines per ADR-0009 §D2 — &#x60;page_index&#x60; for PDF-page outputs, &#x60;position&#x60; for generic ordinals, mutually exclusive within an entry.
 * @package  Gisl\Generated\OpenApi
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<string, mixed>
 */
class OperationDownload implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
     * The original name of the model.
     *
     * @var string
     */
    protected static $openAPIModelName = 'OperationDownload';

    /**
     * Array of property to type mappings. Used for (de)serialization
     *
     * @var string[]
     */
    protected static $openAPITypes = [
        'operation' => 'string',
        'operation_id' => 'string',
        'filename' => 'string',
        'size_bytes' => 'int',
        'chosen_quality' => 'int',
        'target_size_met' => 'bool',
        'measured_quality' => 'float',
        'quality_metric' => 'string',
        'download_url' => 'string',
        'page_index' => 'int',
        'position' => 'int',
        'target_id' => 'string',
        'node_id' => 'string'
    ];

    /**
     * Array of property to format mappings. Used for (de)serialization
     *
     * @var string[]
     * @phpstan-var array<string, string|null>
     * @psalm-var array<string, string|null>
     */
    protected static $openAPIFormats = [
        'operation' => null,
        'operation_id' => 'uuid',
        'filename' => null,
        'size_bytes' => 'int64',
        'chosen_quality' => null,
        'target_size_met' => null,
        'measured_quality' => 'double',
        'quality_metric' => null,
        'download_url' => 'uri',
        'page_index' => null,
        'position' => null,
        'target_id' => null,
        'node_id' => null
    ];

    /**
     * Array of nullable properties. Used for (de)serialization
     *
     * @var boolean[]
     */
    protected static array $openAPINullables = [
        'operation' => false,
        'operation_id' => false,
        'filename' => false,
        'size_bytes' => false,
        'chosen_quality' => false,
        'target_size_met' => false,
        'measured_quality' => false,
        'quality_metric' => false,
        'download_url' => false,
        'page_index' => false,
        'position' => false,
        'target_id' => false,
        'node_id' => false
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
        'operation' => 'operation',
        'operation_id' => 'operation_id',
        'filename' => 'filename',
        'size_bytes' => 'size_bytes',
        'chosen_quality' => 'chosen_quality',
        'target_size_met' => 'target_size_met',
        'measured_quality' => 'measured_quality',
        'quality_metric' => 'quality_metric',
        'download_url' => 'download_url',
        'page_index' => 'page_index',
        'position' => 'position',
        'target_id' => 'target_id',
        'node_id' => 'node_id'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'operation' => 'setOperation',
        'operation_id' => 'setOperationId',
        'filename' => 'setFilename',
        'size_bytes' => 'setSizeBytes',
        'chosen_quality' => 'setChosenQuality',
        'target_size_met' => 'setTargetSizeMet',
        'measured_quality' => 'setMeasuredQuality',
        'quality_metric' => 'setQualityMetric',
        'download_url' => 'setDownloadUrl',
        'page_index' => 'setPageIndex',
        'position' => 'setPosition',
        'target_id' => 'setTargetId',
        'node_id' => 'setNodeId'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'operation' => 'getOperation',
        'operation_id' => 'getOperationId',
        'filename' => 'getFilename',
        'size_bytes' => 'getSizeBytes',
        'chosen_quality' => 'getChosenQuality',
        'target_size_met' => 'getTargetSizeMet',
        'measured_quality' => 'getMeasuredQuality',
        'quality_metric' => 'getQualityMetric',
        'download_url' => 'getDownloadUrl',
        'page_index' => 'getPageIndex',
        'position' => 'getPosition',
        'target_id' => 'getTargetId',
        'node_id' => 'getNodeId'
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
        $this->setIfExists('operation', $data ?? [], null);
        $this->setIfExists('operation_id', $data ?? [], null);
        $this->setIfExists('filename', $data ?? [], null);
        $this->setIfExists('size_bytes', $data ?? [], null);
        $this->setIfExists('chosen_quality', $data ?? [], null);
        $this->setIfExists('target_size_met', $data ?? [], null);
        $this->setIfExists('measured_quality', $data ?? [], null);
        $this->setIfExists('quality_metric', $data ?? [], null);
        $this->setIfExists('download_url', $data ?? [], null);
        $this->setIfExists('page_index', $data ?? [], null);
        $this->setIfExists('position', $data ?? [], null);
        $this->setIfExists('target_id', $data ?? [], null);
        $this->setIfExists('node_id', $data ?? [], null);
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

        if ($this->container['operation'] === null) {
            $invalidProperties[] = "'operation' can't be null";
        }
        if ($this->container['operation_id'] === null) {
            $invalidProperties[] = "'operation_id' can't be null";
        }
        if (!preg_match("/^[0-9a-f]{8}-[0-9a-f]{4}-7[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/", $this->container['operation_id'])) {
            $invalidProperties[] = "invalid value for 'operation_id', must be conform to the pattern /^[0-9a-f]{8}-[0-9a-f]{4}-7[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/.";
        }

        if ($this->container['filename'] === null) {
            $invalidProperties[] = "'filename' can't be null";
        }
        if ($this->container['size_bytes'] === null) {
            $invalidProperties[] = "'size_bytes' can't be null";
        }
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

        if ($this->container['download_url'] === null) {
            $invalidProperties[] = "'download_url' can't be null";
        }
        if (!is_null($this->container['page_index']) && ($this->container['page_index'] < 1)) {
            $invalidProperties[] = "invalid value for 'page_index', must be bigger than or equal to 1.";
        }

        if (!is_null($this->container['position']) && ($this->container['position'] < 0)) {
            $invalidProperties[] = "invalid value for 'position', must be bigger than or equal to 0.";
        }

        if (!is_null($this->container['target_id']) && (mb_strlen($this->container['target_id']) > 64)) {
            $invalidProperties[] = "invalid value for 'target_id', the character length must be smaller than or equal to 64.";
        }

        if (!is_null($this->container['target_id']) && !preg_match("/^[A-Za-z0-9._-]+$/", $this->container['target_id'])) {
            $invalidProperties[] = "invalid value for 'target_id', must be conform to the pattern /^[A-Za-z0-9._-]+$/.";
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
     * @param string $operation Operation type that produced this file
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
     * Gets operation_id
     *
     * @return string
     */
    public function getOperationId()
    {
        return $this->container['operation_id'];
    }

    /**
     * Sets operation_id
     *
     * @param string $operation_id UUID v7 format identifier (time-ordered)
     *
     * @return self
     */
    public function setOperationId($operation_id)
    {
        if (is_null($operation_id)) {
            throw new \InvalidArgumentException('non-nullable operation_id cannot be null');
        }

        if ((!preg_match("/^[0-9a-f]{8}-[0-9a-f]{4}-7[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/", ObjectSerializer::toString($operation_id)))) {
            throw new \InvalidArgumentException("invalid value for \$operation_id when calling OperationDownload., must conform to the pattern /^[0-9a-f]{8}-[0-9a-f]{4}-7[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/.");
        }

        $this->container['operation_id'] = $operation_id;

        return $this;
    }

    /**
     * Gets filename
     *
     * @return string
     */
    public function getFilename()
    {
        return $this->container['filename'];
    }

    /**
     * Sets filename
     *
     * @param string $filename The **download filename** the API synthesises for this output — a human-friendly, extension-bearing name. This is a DIFFERENT surface from the S3 object key (an opaque UUID/`output-NNN` leaf governed by ADR-0014 §D9); the two are independent by design. Composed as `<stem><marker><suffix><.ext>`:  - **stem** — derived from the originating upload's `original_name`   (a chained job resolves through its upstream to the original   upload; path separators, control characters and quotes stripped);   collapses to `download` if the sanitised stem is empty. When there   is **no** original name at all (a `job_output`-sourced job with no   upstream upload, or an unrecorded/purged name — rare), the whole   field falls back to the S3-key basename **as-is, unmarked**; the   per-op marker below applies only to the `original_name`-derived   stem, so that fallback path is the one unlabelled case and is   outside this map's scope. - **marker** — a per-operation label so **every** processed output   is self-describing: it names what the output IS and disambiguates   the different operations of a job from each other and from the   original (ticket [`50obWMbm`](https://trello.com/c/50obWMbm), user   launch feedback — the user hit a watermarked-main + thumbnail   collision within one job). **Scope:** the marker resolves   within-job and vs-original ambiguity, NOT workflow-wide uniqueness   — two SEPARATE jobs running the same op on the same-named upload   still produce the same name (a rarer case a job/node identifier   would address; out of scope for this label map). **Invariant, with   two explicit exceptions:** every op below **except `passthrough`**   carries a non-empty marker, so a terminal deliverable **derived   from an `original_name`** never falls back to a bare, op-less stem   (the bug this fixes). The two exceptions are inline: `passthrough`   (the identity op — its output IS the original) and the   no-`original_name` S3-key fallback described under **stem** above. The   canonical marker is keyed on the **public (masked) operation   type** — a long-form concat surfaces as `compress` and carries its   marker:     - `compress` → `-compressed`     - `thumbnail` (and the `thumbnail_image` / `thumbnail_video` /       `thumbnail_document` / `thumbnail_office` sub-types, which all       surface publicly as `thumbnail`) → `-thumbnail`     - `image_watermark` / `text_watermark` / `video_watermark` /       `video_text_watermark` / `audio_watermark` → `-watermarked`     - `convert` → `-converted` (the extension changes too, but the       marker keeps naming consistent — no operation is a special case)     - `merge` → `-merged`     - `transform` → `-transformed`     - `custom_luma` → `-graded`     - `audio_overlay` → `-overlay`     - `audio_to_video` → `-video`     - `render_variants` → `-variant`     - `split` → `-part`, plus the `-<n>` piece suffix (below) when       the run yields more than one piece. The word-marker is required       because a split can legally produce a SINGLE output (e.g.       `frame_range: \"5-5\"`, a one-page PDF range, or an interval that       exceeds the media duration) — without it a single-piece split       would fall back to the bare original stem.     - `archive` → `-archive` (the archive OPERATION's output). Note:       the workflow `delivery.bundle` path names its zip from       `delivery.bundle_filename` instead — that is a separate surface       and takes precedence when a bundle is requested.     - `passthrough` → **none, by design** — it emits the input       UNCHANGED (it is the identity/plumbing op), so its output IS the       original file and carries the original name. It is normally       consumed by a downstream job (not a terminal deliverable); when       it is a leaf, returning the original name is correct, not a       mislabel.   **This whole map is co-owned with `compression_api`'s   `DownloadFilenameComputer`** (as the `MIME_EXTENSION` table is) —   api implements it; contracts is the normative source. - **suffix** — `-<n>` **only** when the operation produced more than   one output. `<n>` is the output's **0-based position in the   producer's `outputs[]` array** — a uniqueness key. It is   **INDEPENDENT of `page_index` and must NOT be read as a page   number**: a `pages: '5-7'` PDF fan-out emits   `{ filename: \"report-converted-0.png\", page_index: 5 }` (PDF→PNG is a   `convert`, hence `-converted`) — the `-0` is the   array position, `5` is the source page. Reconciling them is a bug. - **.ext** — the extension of the **actual produced format**, never   the input's and never guessed. Resolved from the worker-reported   `output_file_type` (AsyncAPI `OperationResult.output_file_type`,   ADR-0022) when present — authoritative for formats the API cannot   infer (e.g. `compress.output_format` ∈ `{auto, smallest}`) — else   derived from the operation chain. The chain additionally   disambiguates a MIME→extension collision even when the MIME is   known (`audio/ogg` → `.ogg` for Vorbis vs `.opus` for Opus). When   the produced format is   genuinely unknown at download time the name is emitted with **no   extension** rather than a wrong one. `split` and `audio_to_video`   derive to no format, so their extension comes **only** from   `output_file_type`.  Sanitised for JSON (Unicode-safe); the `Content-Disposition` header on the presigned `download_url` is ASCII-sanitised separately, so the two user-visible names may legitimately differ.
     *
     * @return self
     */
    public function setFilename($filename)
    {
        if (is_null($filename)) {
            throw new \InvalidArgumentException('non-nullable filename cannot be null');
        }
        $this->container['filename'] = $filename;

        return $this;
    }

    /**
     * Gets size_bytes
     *
     * @return int
     */
    public function getSizeBytes()
    {
        return $this->container['size_bytes'];
    }

    /**
     * Sets size_bytes
     *
     * @param int $size_bytes Output file size in bytes
     *
     * @return self
     */
    public function setSizeBytes($size_bytes)
    {
        if (is_null($size_bytes)) {
            throw new \InvalidArgumentException('non-nullable size_bytes cannot be null');
        }
        $this->container['size_bytes'] = $size_bytes;

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
     * @param int|null $chosen_quality The encoder quality the search settled on — for a `target_size` encode OR an `auto_quality` encode (the quality that met the `quality_preset` perceptual target). Present only for a target_size or auto_quality output; absent otherwise. Optional/additive (rides the shared property bag — not in any oneOf `required`/`not`). The per-output `/downloads` read is the canonical output-properties surface per the ZjVXHkYK narrowing (alongside `size_bytes`); mirrors the worker source `OperationMetrics.chosen_quality`. Pairs with `target_size_met` (target_size) or `measured_quality` (auto_quality).
     *
     * @return self
     */
    public function setChosenQuality($chosen_quality)
    {
        if (is_null($chosen_quality)) {
            throw new \InvalidArgumentException('non-nullable chosen_quality cannot be null');
        }

        if (($chosen_quality > 100)) {
            throw new \InvalidArgumentException('invalid value for $chosen_quality when calling OperationDownload., must be smaller than or equal to 100.');
        }
        if (($chosen_quality < 1)) {
            throw new \InvalidArgumentException('invalid value for $chosen_quality when calling OperationDownload., must be bigger than or equal to 1.');
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
     * @param bool|null $target_size_met For a `target_size` encode: whether the output landed at or under the requested `target_size_bytes`. `false` is an honest best-effort outcome (target unreachable at min quality), NOT a failure. Present only for a target_size output. Mirrors `OperationMetrics.target_size_met`.
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
     * @param float|null $measured_quality For an `auto_quality` encode (`encoding_mode: auto_quality`): the achieved perceptual-quality score (0.0–1.0) that met the `quality_preset` target. Present only for an auto_quality output; pairs with `chosen_quality`. Metric-agnostic — the producing metric is named in `quality_metric`. Mirrors `OperationMetrics.measured_quality`.
     *
     * @return self
     */
    public function setMeasuredQuality($measured_quality)
    {
        if (is_null($measured_quality)) {
            throw new \InvalidArgumentException('non-nullable measured_quality cannot be null');
        }

        if (($measured_quality > 1)) {
            throw new \InvalidArgumentException('invalid value for $measured_quality when calling OperationDownload., must be smaller than or equal to 1.');
        }
        if (($measured_quality < 0)) {
            throw new \InvalidArgumentException('invalid value for $measured_quality when calling OperationDownload., must be bigger than or equal to 0.');
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
     * @param string|null $quality_metric For an `auto_quality` encode: the perceptual metric that produced `measured_quality` — a free-form string (not an enum) so it can evolve without contract churn. Present only for an auto_quality output. Current value: `ssim`. Mirrors `OperationMetrics.quality_metric`.
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
     * Gets download_url
     *
     * @return string
     */
    public function getDownloadUrl()
    {
        return $this->container['download_url'];
    }

    /**
     * Sets download_url
     *
     * @param string $download_url Pre-signed download URL
     *
     * @return self
     */
    public function setDownloadUrl($download_url)
    {
        if (is_null($download_url)) {
            throw new \InvalidArgumentException('non-nullable download_url cannot be null');
        }
        $this->container['download_url'] = $download_url;

        return $this;
    }

    /**
     * Gets page_index
     *
     * @return int|null
     */
    public function getPageIndex()
    {
        return $this->container['page_index'];
    }

    /**
     * Sets page_index
     *
     * @param int|null $page_index 1-based **literal source page number** for PDF-page fan-out outputs (convert PDF->image) — the actual page from the input PDF. A full conversion emits `1..N`; a sparse `pages` selection (e.g. `'1-5,8'`) emits exactly the selected pages (`1,2,3,4,5,8`), so it is gapless ONLY for a full conversion, not for a sparse selection. NOT the download `filename` suffix (that is a 0-based array position — see `OperationDownload.filename`). Mutually exclusive with `position`. Normative semantics: ADR-0009 §D2. Absent on non-indexed (single-output) downloads. Mirrors `OperationResultOutputEntry.page_index`. Per ADR-0009 §D2.
     *
     * @return self
     */
    public function setPageIndex($page_index)
    {
        if (is_null($page_index)) {
            throw new \InvalidArgumentException('non-nullable page_index cannot be null');
        }

        if (($page_index < 1)) {
            throw new \InvalidArgumentException('invalid value for $page_index when calling OperationDownload., must be bigger than or equal to 1.');
        }

        $this->container['page_index'] = $page_index;

        return $this;
    }

    /**
     * Gets position
     *
     * @return int|null
     */
    public function getPosition()
    {
        return $this->container['position'];
    }

    /**
     * Sets position
     *
     * @param int|null $position 0-based ordinal for non-PDF multi-output operations (e.g. frame strip, chapter split). Mutually exclusive with `page_index`. Absent on non-indexed downloads. Forward-looking — not emitted by any current operation; declared for parity with `OperationResultOutputEntry.position`. Per ADR-0009 §D2.
     *
     * @return self
     */
    public function setPosition($position)
    {
        if (is_null($position)) {
            throw new \InvalidArgumentException('non-nullable position cannot be null');
        }

        if (($position < 0)) {
            throw new \InvalidArgumentException('invalid value for $position when calling OperationDownload., must be bigger than or equal to 0.');
        }

        $this->container['position'] = $position;

        return $this;
    }

    /**
     * Gets target_id
     *
     * @return string|null
     */
    public function getTargetId()
    {
        return $this->container['target_id'];
    }

    /**
     * Sets target_id
     *
     * @param string|null $target_id The caller-assigned `id` of the `render_variants` target that produced this output, echoed verbatim (the image-fan-out addressing contract). Carried on the `Unindexed` branch (variant outputs are not page/position indexed); no operation emits `target_id` together with `page_index` / `position`. Mirrors `OperationResultOutputEntry.target_id`. Per ticket `w3EwzHYd`.
     *
     * @return self
     */
    public function setTargetId($target_id)
    {
        if (is_null($target_id)) {
            throw new \InvalidArgumentException('non-nullable target_id cannot be null');
        }
        if ((mb_strlen($target_id) > 64)) {
            throw new \InvalidArgumentException('invalid length for $target_id when calling OperationDownload., must be smaller than or equal to 64.');
        }
        if ((!preg_match("/^[A-Za-z0-9._-]+$/", ObjectSerializer::toString($target_id)))) {
            throw new \InvalidArgumentException("invalid value for \$target_id when calling OperationDownload., must conform to the pattern /^[A-Za-z0-9._-]+$/.");
        }

        $this->container['target_id'] = $target_id;

        return $this;
    }

    /**
     * Gets node_id
     *
     * @return string|null
     */
    public function getNodeId()
    {
        return $this->container['node_id'];
    }

    /**
     * Sets node_id
     *
     * @param string|null $node_id Symbolic composition `node_id` correlating this download to its canonical node in `WorkflowCreateResponse.composition_plan` (e.g. `encode`, `thumbnail`, `processed_base`). Lets consumers label and group delivered files by composition role (e.g. sdks `byNode()`, FE \"Main image\" / \"Thumbnail\" labels). **Optional** — emitted once the canonicalization engine is live (optional-then-promote, mirroring `composition_plan` and `DeliveryPlanOutput.node_id`); absent until then. Additive carrier only; the normative `/downloads == delivery_plan.outputs[]` rendezvous invariant lands with the delivery-selection promotion, not here.
     *
     * @return self
     */
    public function setNodeId($node_id)
    {
        if (is_null($node_id)) {
            throw new \InvalidArgumentException('non-nullable node_id cannot be null');
        }
        $this->container['node_id'] = $node_id;

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


