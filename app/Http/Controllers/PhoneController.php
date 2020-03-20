<?php

namespace App\Http\Controllers;

use App\Interfaces\PhoneNumber;
use App\Jobs\CreatePhoneJob;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PhoneController extends Controller implements PhoneNumber
{
    protected $phone_type;

    /**
     * {@inheritdoc}
     *
     * Declare type of phone number. whether is MTN or IMI
     */
    public function phoneType(String $phone_number): void
    {
        $code = substr($phone_number,0, 3);
        if($code == '093'){
            $this->phone_type = 'MTN';
        }else{
            $this->phone_type = 'IMI';
        }
    }

    /**
     * Return the type of given phone number.
     *
     * @param Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function networkType(Request $request)
    {
        $this->validator($request->all())->validate();

        if(method_exists($this, 'phoneType')){

            $this->phoneType($request->phone);

            CreatePhoneJob::dispatch($request->phone)->onQueue($this->phone_type);

            return response()->json($this->phone_type);
        }

        throw new Exception("Method Not Implemented");
    }

    /**
     * Get a validator for an incoming phone number request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'phone' => ['required', 'string' ,'regex:/^(((\+{1})|(0{2}))98|(0{1}))9[0-9]{1}\d{8}\Z$/im'],
        ]);
    }
}
