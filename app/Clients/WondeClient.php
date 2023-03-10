<?php

namespace App\Clients;

use Exception;
use Illuminate\Support\Facades\Cache;
use Wonde\Client;
use Wonde\Endpoints\Schools;
use Wonde\Exceptions\InvalidTokenException;

class WondeClient implements WondeClientInterface
{
    private Client $client;

    /**
     * @throws InvalidTokenException
     */
    public function __construct()
    {
        $this->client = new Client(env('WONDE_API_TOKEN'));
    }

    /**
     * @inheritDoc
     */
    public function getSchool(string $schoolId): Schools
    {
        try {
            return $this->client->school($schoolId);
        } catch (Exception $e) {
            report($e);

            return false;
        }
    }

    public function getAllStaff(string $schoolId, array $params = []): mixed
    {
        $cacheKey = array_merge($params, ['schoolId' => $schoolId]);
        $cacheKey = 'all_staff.' . http_build_query($cacheKey, '', ',');

        if (Cache::has($cacheKey) === true) {
            return Cache::get($cacheKey);
        }

        try {
            $school = $this->getSchool($schoolId);
            $employees = $school->employees->all([], $params);
            Cache::put($cacheKey, $employees, 60);
            return $employees;
        } catch (Exception $e) {
            report($e);

            return false;
        }
    }

    /**
     * @inheritDoc
     */
    public function getStaffClasses(string $schoolId, string $employeeId): mixed
    {
        $cacheKey = 'staff_classes.' . $schoolId . $employeeId;
        if (Cache::has($cacheKey) === true) {
            return Cache::get($cacheKey);
        }

        try {
            $school = $this->getSchool($schoolId);
            $employeeClasses = $school->employees->get($employeeId, ['classes']);
            Cache::put($cacheKey, $employeeClasses, 60);
            return $employeeClasses;
        } catch (Exception $e) {
            report($e);

            return false;
        }
    }

    /**
     * @inheritDoc
     */
    public function getClass(string $schoolId, string $classId): mixed
    {
        $cacheKey = 'classes.' . $schoolId . $classId;
        if (Cache::has($cacheKey) === true) {
            return Cache::get($cacheKey);
        }

        try {
            $school = $this->getSchool($schoolId);
            $classes = $school->classes->get($classId, ['students', 'lessons']);
            Cache::put($cacheKey, $classes, 60);
            return $classes;
        } catch (Exception $e) {
            report($e);

            return false;
        }
    }
}
