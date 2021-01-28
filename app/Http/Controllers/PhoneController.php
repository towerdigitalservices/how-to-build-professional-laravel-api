<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Transformers\PhoneTransformer;
use App\Repositories\PhoneRepository;
use App\Http\Requests\Phone\ProvisionPhoneRequest;
use App\Http\Requests\Phone\DeletePhoneRequest;
use App\Http\Requests\Phone\NumberSearchRequest;
use App\Http\Requests\Phone\SendMessageRequest;

class PhoneController extends Controller
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

    public function index()
    {
        $phones = $this->phones->all();
        return $this->respondWithCollection($phones);
    }

    public function getUserPhones(Request $request)
    {
        $user = $request->user();
        return $this->respondWithCollection($user->phones);
    }

    public function searchNumbers(NumberSearchRequest $request)
    {
        $phones = $this->phones->searchForNumber($request->area_code, $request->count);
        return $this->respondWithArray($phones);
    }

    public function create(ProvisionPhoneRequest $request)
    {
        $phone = $this->phones->provisionPhone($request->phone_number, $request->user_id);
        return $this->respondWithItem($phone);
    }

    public function sendMessage(SendMessageRequest $request)
    {
        $this->phones->sendMessage($request->phone->id, $request->to_number, $request->message);
        return $this->respondWithMessage('Message Sent Successfullly');
    }

    public function delete($id)
    {
        $this->phones->delete($id);
        return $this->respondWithMessage('Phone Deleted Successfully');
    }

}
