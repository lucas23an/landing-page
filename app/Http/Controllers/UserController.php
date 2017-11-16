<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Business\UserBO;
use App\Util\Messages;
use App\Http\Requests\UserRequest;
use Illuminate\Http\Response;
use App\Models\User;

class UserController extends Controller
{
    /**
     * @var UserBO.
     */
    private $userBO;
    
    /**
     * UsersController constructor.
     * @param UserBO $userBO
     */
    public function __construct(UserBO $userBO)
    {
        $this->userBO = $userBO;
    }
    public function store(UserRequest $request)
    {
        $attributes = $request->all();
        $user =  $this->userBO->store($attributes);

        return $user;
    }
}
