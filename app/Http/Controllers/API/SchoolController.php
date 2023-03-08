<?php

namespace App\Http\Controllers\API;

use App\Http\Clients\WondeClientInterface;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use Wonde\Exceptions\InvalidTokenException;

class SchoolController extends Controller
{
    /**
     * @var string
     */
    private string $schoolId = 'A1930499544';
    private WondeClientInterface $wondeClient;

    public function __construct(WondeClientInterface $wondeClient)
    {
        $this->wondeClient = $wondeClient;
    }

    /**
     * @throws InvalidTokenException
     */
    public function index(Request $request): JsonResponse
    {
        $params = [
            'page' => $request->input('currentPage', 1)
        ];

        $employees = $this->wondeClient->getAllStaff($this->schoolId, $params);

        return response()->json([
            'status' => 'OK',
            'employees' => $employees->array,
        ]);
    }

    public function staffClasses($employeeId): JsonResponse
    {
        return response()->json([
            'status' => 'OK',
            'employee' => $this->wondeClient->getStaffClasses($this->schoolId, $employeeId),
        ]);
    }

    public function class(string $classId): JsonResponse
    {
        return response()->json([
            'status' => 'OK',
            'class' => $this->wondeClient->getClass($this->schoolId, $classId),
        ]);
    }
}
