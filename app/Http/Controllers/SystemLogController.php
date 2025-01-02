<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSystemLogRequest;
use App\Http\Requests\UpdateSystemLogRequest;
use App\Models\SystemLog;
use App\Http\Resources\SystemLogResource;
use App\Interfaces\Services\SystemLogServiceInterface;
use Illuminate\Http\Request;

class SystemLogController extends Controller
{
    public function __construct(protected SystemLogServiceInterface $service) {}

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $logs = $this->service->getLogs(
            $request->only(['type', 'date_range']),
            $request->input('per_page', 15)
        );

        return SystemLogResource::collection($logs);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSystemLogRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return new SystemLogResource(
            $this->service->findById($id)
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SystemLog $systemLog)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSystemLogRequest $request, SystemLog $systemLog)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SystemLog $systemLog)
    {
        //
    }
}
