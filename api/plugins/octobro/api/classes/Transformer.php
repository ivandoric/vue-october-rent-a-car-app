<?php namespace Octobro\API\Classes;

use Closure;
use League\Fractal\Scope;
use League\Fractal\TransformerAbstract;

abstract class Transformer extends TransformerAbstract
{
    use \October\Rain\Extension\ExtendableTrait;

    public $implement;

    public $defaultIncludes = [];

    public $availableIncludes = [];

    protected $additionalFields = [];
    /**
     * Instantiate a new BackendController instance.
     */
    public function __construct()
    {
        $this->extendableConstruct();
    }

    /**
     * Extend this object properties upon construction.
     */
    public static function extend(Closure $callback)
    {
        self::extendableExtendCallback($callback);
    }

    final public function transform($data)
    {
        $additionalData = [];

        foreach ($this->additionalFields as $key => $additionalField) {
            $additionalData[$key] = is_callable($additionalField) ? $additionalField($data) : $data->{$key};
        }

        return array_merge($data ? $this->data($data) : [], $additionalData);
    }

    /**
     * Perform dynamic methods
     */
    public function __call($method, $parameters)
    {
        if (isset($this->extensionData['dynamicMethods'][$method])) {
            return call_user_func_array($this->extensionData['dynamicMethods'][$method], $parameters);
        }

        return call_user_func_array([$this, $method], $parameters);
    }

    public function addField($key, $callback = null)
    {
        $this->additionalFields[$key] = $callback;
    }

    public function addFields($fields)
    {
        foreach ($fields as $key => $field) {
            if (is_int($key)) {
                $this->addField($field);
            } else {
                $this->addField($key, $field);
            }
        }
    }

    /**
     * [addInclude description]
     * @param [type]  $key        [description]
     * @param [type]  $callback   [description]
     * @param boolean $addDefault [description]
     */
    public function addInclude($key, $callback, $addDefault = false)
    {
        $this->availableIncludes[] = $key;

        if ($addDefault) {
            $this->defaultIncludes[] = $key;
        }

        $this->addDynamicMethod(camel_case('include ' . $key), $callback);
    }

    public function addDefaultInclude($key, $callback)
    {
        $this->addInclude($key, $callback, true);
    }

    protected function file($file)
    {
        if (!$file)
            return null;

        return array_only($file->toArray(), ['file_name', 'file_size', 'path']);
    }

    protected function image($file, Array $customSizes = [], $replace = false)
    {
        if (!$file)
            return null;

        $image = [
            'original' => $file->path,
        ];

        // If the custom size is not array
        if (! is_array(reset($customSizes)) && count($customSizes) >= 2) {
            $customSizes = [
                'default' => $customSizes,
            ];
        }

        if ($replace) {
            $sizes = $customSizes;
        } else {
            $sizes = array_merge([
                'small' => [160, 160, 'crop'],
                'medium' => [240, 240, 'crop'],
                'large' => [800, 800, 'crop'],
                'thumb' => [480, 480],
            ], $customSizes);
        }

        if (!count($sizes)) {
            return $image['original'];
        }

        foreach ($sizes as $name => $size) {
            $image[$name] = call_user_func_array([$file, 'getThumb'], $size);
        }

        return $image;
    }

    protected function files($files)
    {
        $result = [];

        foreach ($files as $file) {
            $result[] = $this->file($file);
        }

        return $result;
    }

    protected function images($files, Array $customSizes = [])
    {
        $result = [];

        foreach ($files as $file) {
            $result[] = $this->image($file);
        }

        return $result;
    }

}
