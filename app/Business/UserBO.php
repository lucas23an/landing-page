<?php

namespace App\Business;

use Illuminate\Http\Response;
use App\Repositories\UserRepository;
use App\Util\Messages;

class UserBO extends AbstractBO
{
    /**
     * @var UserRepository
     */
    private $repository;
    
    /**
     * UserBO constructor.
     * @param UserRepository $repository
     */
    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Save new user.
     *
     * @param array $attributes
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function store(array $attributes)
    {
        $this->beginTransaction();
        
        $attributes['birthdate'] = $this->formatDateFromEn($attributes['birthdate']);

        $newUser = $this->repository->create($attributes);

        $this->commit();

        return $newUser;
    }
}