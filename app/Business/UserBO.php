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
        try {
            $this->beginTransaction();
            
            $newUser = $this->repository->create($attributes);

            $this->commit();

            return response()->json([
                'message' => Messages::SUCCESS,
                'data' => $newUser
                ], Response::HTTP_CREATED);
        } catch (\Exception $e) {
            $this->rollback();
            return response()->json([
                'data' => [
                    'message' => Messages::NOT_CREATED,
                    'errors' => $e->getMessage()
                ]
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}