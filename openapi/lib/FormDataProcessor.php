<?php
/**
 * FormDataProcessor
 * PHP version 7.4
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

namespace Gisl\Generated\OpenApi;

use ArrayAccess;
use DateTime;
use GuzzleHttp\Psr7\Utils;
use Psr\Http\Message\StreamInterface;
use SplFileObject;
use Gisl\Generated\OpenApi\Model\ModelInterface;

/**
 * FormDataProcessor Class Doc Comment
 *
 * @category Class
 * @package  Gisl\Generated\OpenApi
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */
class FormDataProcessor
{
    /**
     * Tags whether payload passed to ::prepare() contains one or more
     * SplFileObject or stream values.
     */
    public bool $has_file = false;

    /**
     * Take value and turn it into an array suitable for inclusion in
     * the http body (form parameter). If it's a string, pass through unchanged
     * If it's a datetime object, format it in ISO8601
     *
     * @param array<string|bool|array|DateTime|ArrayAccess|SplFileObject> $values the value of the form parameter
     *
     * @return array [key => value] of formdata
     */
    public function prepare(array $values): array
    {
        $this->has_file = false;
        $result = [];

        foreach ($values as $k => $v) {
            if ($v === null) {
                continue;
            }

            $result[$k] = $this->makeFormSafe($v);
        }

        return $result;
    }

    /**
     * Flattens a multi-level array of data and generates a single-level array
     * compatible with formdata - a single-level array where the keys use bracket
     * notation to signify nested data.
     *
     * credit: https://github.com/FranBar1966/FlatPHP
     */
    public static function flatten(array $source, string $start = ''): array
    {
        $opt = [
            'prefix'          => '[',
            'suffix'          => ']',
            'suffix-end'      => true,
            'prefix-list'     => '[',
            'suffix-list'     => ']',
            'suffix-list-end' => true,
        ];

        if ($start === '') {
            $currentPrefix    = '';
            $currentSuffix    = '';
            $currentSuffixEnd = false;
        } elseif (array_is_list($source)) {
            $currentPrefix    = $opt['prefix-list'];
            $currentSuffix    = $opt['suffix-list'];
            $currentSuffixEnd = $opt['suffix-list-end'];
        } else {
            $currentPrefix    = $opt['prefix'];
            $currentSuffix    = $opt['suffix'];
            $currentSuffixEnd = $opt['suffix-end'];
        }

        $currentName = $start;
        $result = [];

        foreach ($source as $key => $val) {
            $currentName .= $currentPrefix.$key;

            if (is_array($val) && !empty($val)) {
                $currentName .= $currentSuffix;
                $result += self::flatten($val, $currentName);
            } else {
                if ($currentSuffixEnd) {
                    $currentName .= $currentSuffix;
                }

                if (is_resource($val)) {
                    $result[$currentName] = $val;
                } else {
                    $result[$currentName] = ObjectSerializer::toString($val);
                }
            }

            $currentName = $start;
        }

        return $result;
    }

    /**
     * formdata must be limited to scalars or arrays of scalar values,
     * or a resource for a file upload. Here we iterate through all available
     * data and identify how to handle each scenario
     */
    protected function makeFormSafe($value)
    {
        if ($value instanceof SplFileObject) {
            return $this->processFiles([$value])[0];
        }

        if (is_resource($value)) {
            $this->has_file = true;

            return $value;
        }

        if ($value instanceof ModelInterface) {
            return $this->processModel($value);
        }

        if (is_array($value) || (is_object($value) && !$value instanceof \DateTimeInterface)) {
            $data = [];

            foreach ($value as $k => $v) {
                $data[$k] = $this->makeFormSafe($v);
            }

            return $data;
        }

        return ObjectSerializer::toString($value);
    }

    /**
     * We are able to handle nested ModelInterface. We do not simply call
     * json_decode(json_encode()) because any given model may have binary data
     * or other data that cannot be serialized to a JSON string
     */
    protected function processModel(ModelInterface $model): array
    {
        $result = [];

        foreach ($model::openAPITypes() as $name => $type) {
            $value = $model->offsetGet($name);

            if ($value === null) {
                continue;
            }

            if (strpos($type, '\SplFileObject') !== false) {
                $file = is_array($value) ? $value : [$value];
                $result[$name] = $this->processFiles($file);

                continue;
            }

            if ($value instanceof ModelInterface) {
                $result[$name] = $this->processModel($value);

                continue;
            }

            if (is_array($value) || is_object($value)) {
                $result[$name] = $this->makeFormSafe($value);

                continue;
            }

            $result[$name] = ObjectSerializer::toString($value);
        }

        return $result;
    }

    /**
     * Handle file data
     */
    protected function processFiles(array $files): array
    {
        $this->has_file = true;

        $result = [];

        foreach ($files as $i => $file) {
            if (is_array($file)) {
                $result[$i] = $this->processFiles($file);

                continue;
            }

            if ($file instanceof StreamInterface) {
                $result[$i] = $file;

                continue;
            }

            if ($file instanceof SplFileObject) {
                $result[$i] = $this->tryFopen($file);
            }
        }

        return $result;
    }

    private function tryFopen(SplFileObject $file)
    {
        return Utils::tryFopen($file->getRealPath(), 'rb');
    }
}
