<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;
use League\Fractal\Manager;
use League\Fractal\TransformerAbstract as Transformer;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;

class Controller
{
    use DispatchesJobs;

    /**
     * @property Manager
     */
    protected $fractal;

    /**
     * @property Transformer
     */
    protected $transformer;

    public function __construct(
        Transformer $transformer,
        Request $request
    )
    {
        $this->fractal = new Manager();
        $this->transformer = $transformer;

        $this->fractal->parseIncludes(explode(',', $request->get('include')));
    }

    protected function respondWithToken($token)
    {
        $data = [
            'token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
        ];
        return response()->json(compact('data'));
    }

    protected function respondWithError($message, $status)
    {
        $data = [
            'message' => $message,
            'status' => $status,
        ];
        return response(compact('data'), $status);
    }

    protected function respondWithMessage(string $message)
    {
        $data = [
            'message' => $message,
            'status' => 200
        ];
        return response(compact('data'));
    }

    protected function respondWithArray(array $array)
    {
        $data = [
            'results' => $array,
            'status' => 200
        ];
        return response(compact('data'));
    }

    protected function respondWithItem($item, $status = 200)
    {
        $item = new Item($item, $this->transformer);

        $response = $this->fractal->createData($item)->toArray();
        return response($response, $status);
    }

    protected function respondWithCollection($item)
    {
        $collection = new Collection($item, $this->transformer);

        return $this->fractal->createData($collection)->toArray();
    }
}
