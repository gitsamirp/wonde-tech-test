<?php

namespace App\Clients;

use Wonde\Endpoints\Schools;

interface WondeClientInterface
{
    /**
     * @param string $schoolId
     * @return Schools
     */
    public function getSchool(string $schoolId): Schools;

    /**
     * @param string $schoolId
     * @param array $params
     * @return mixed
     */
    public function getAllStaff(string $schoolId, array $params = []): mixed;


    /**
     * @param string $schoolId
     * @param string $employeeId
     * @return mixed
     */
    public function getStaffClasses(string $schoolId, string $employeeId): mixed;

    /**
     * @param string $schoolId
     * @param string $classId
     * @return mixed
     */
    public function getClass(string $schoolId, string $classId): mixed;
}
