<?php

namespace App\Http\Transformers;

use App\Models\Example;
use League\Fractal\TransformerAbstract;

class ExampleTransformer extends TransformerAbstract
{
    /**
     * The relations to include by default
     * when preparing a response
     *
     * @property Array
     */
    protected $defaultIncludes = [
        //
    ];

    /**
     * The relations to include if specified in the query param
     * when preparing a response
     *
     * @property Array
     */
    protected $availableIncludes = [
        //
    ];

    public function transform(Example $example)
    {
        return [
            'field1' => $example->field1,
            //...
        ];
    }
}
