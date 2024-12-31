<?php

namespace App\Wine\Domain\Service;

use App\Shared\Domain\Criteria\Criteria;
use App\Wine\Domain\Entity\User;
use App\Wine\Domain\Exception\UserNotFound;
use App\Wine\Domain\Repository\UserRepository;

class GetOneUserByCriteria
{
    public function __construct(
        private UserRepository $userRepository
    ) {
    }

    /**
     * @throws UserNotFound
     */
    public function execute(Criteria $criteria): User
    {
        return $this->userRepository->findOneBy($criteria) ?? throw new UserNotFound('User not found', 404);
    }
}