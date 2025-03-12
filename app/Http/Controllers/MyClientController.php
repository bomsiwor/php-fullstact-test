<?php

namespace App\Http\Controllers;

use App\Http\Requests\MyClientRequest;
use App\Http\Resources\MyClientResource;
use App\Models\MyClient;
use App\Services\MyClientService;
use Illuminate\Http\Request;

class MyClientController extends Controller
{
    public function __construct(protected MyClientService $service) {}
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Query as filter for list
        $result = $this->service->getList($request->query());

        return $this->successResponse(message: "Success get list", data: new MyClientResource($result));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MyClientRequest $request)
    {
        try {
            $result = $this->service->store($request);

            return $this->successResponse("New Client created", data: new MyClientResource($result));
        } catch (\Throwable $th) {
            return $this->errorResponse("Error server : "  . $th->getMessage(), code: 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(MyClient $model)
    {
        return $this->successResponse(data: new MyClientResource($model));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MyClientRequest $request, MyClient $model)
    {
        try {
            $result = $this->service->update($request, $model);

            return $this->successResponse("Client updated", data: new MyClientResource($result));
        } catch (\Throwable $th) {
            return $this->errorResponse("Error server : " . $th->getMessage(), code: 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MyClient $model)
    {
        try {
            $this->service->delete($model);

            return $this->successResponse("Client deleted");
        } catch (\Throwable $th) {
            return $this->errorResponse("Error server : " . $th->getMessage(), code: 500);
        }
    }
}
