<?php

namespace App\Http\Controllers;

use App\Http\Transformers\PhoneTransformer;
use App\Repositories\PhoneRepository;

class RoleController extends Controller
{
    /**
     * @property PhoneRepository
     */
    protected $phones;

    public function __construct(
        PhoneTransformer $transformer,
        PhoneRepository $phones,
        Request $request)
    {
        parent::__construct($transformer, $request);

        $this->phones = $phones;
    }

    public function index() {

    }
}
