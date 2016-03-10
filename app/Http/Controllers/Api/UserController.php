<?php

namespace CodeDelivery\Http\Controllers\Api;


use CodeDelivery\Http\Controllers\Controller;
use CodeDelivery\Repositories\UserRepository;
use Illuminate\Http\Request;
use LucaDegasperi\OAuth2Server\Facades\Authorizer;

class UserController extends Controller
{

    /**
     * @var UserRepository
     */
    private $userRepository;

    public function __construct(UserRepository $userRepository) {
        $this->userRepository = $userRepository;
    }

    public function authenticated(){

        $id = Authorizer::getResourceOwnerId();
        //alterado para skipPresenter = true apenas para a avaliacao
        return $this->userRepository->skipPresenter(true)->find($id);
    }

    public function updateDeviceToken(Request $request){
        $id = Authorizer::getResourceOwnerId();
        $deviceToken = $request->get('device_token');
       return $this->userRepository->updateDeviceToken($id,$deviceToken);
    }

}
