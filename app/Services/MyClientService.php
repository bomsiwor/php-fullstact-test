<?php

namespace App\Services;

use App\Http\Requests\MyClientRequest;
use App\Models\MyClient;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class MyClientService
{
    public function __construct(public MyClient $model) {}

    public function getList(array $query)
    {
        // Utilize query if any
        // Due to time constraint, this is not implemented
        return $this->model->get();
    }

    public function store(MyClientRequest $request)
    {
        $data = $request->validated();

        // Retrieve file from request
        // Then get url from storage s3 adapter
        if ($request->hasFile('client_logo')) {
            $path = $request->file('client_logo')->store('clients', 's3');

            // Retrieve s3 url
            $data['client_logo'] = Storage::disk('s3')->url($path);
        }

        // Generate client slug
        // Use timestapm to ensure uniqueness
        // Becase wedont have validation for client name
        $slug = Str::slug($data['name'] . " " . now()->timestamp);
        $data['slug'] = $slug;

        $client = MyClient::create($data);

        // Newe data stored on redis
        // Redis::set($client->slug, json_encode($client));

        return $client;
    }

    public function update(MyClientRequest $request, MyClient $client)
    {
        // Handle the file first
        if ($request->hasFile('client_logo')) {
            // Check if client logo already filled
            // Delete logo if any
            if ($client->client_logo !== 'no-image.jpg') {
                Storage::disk('s3')->delete($client->client_logo);
            }

            // Store new logo on s3
            $path = $request->file('client_logo')->store('clients', 's3');

            $data['client_logo'] = Storage::disk('s3')->url($path);
        }

        $client->update($data);

        // Delete current data on redis
        // Then set new data to redis using updated clientf
        Redis::del($client->slug);
        Redis::set($client->slug, json_encode($client));

        return $client;
    }

    public function delete(MyClient $client)
    {
        // Delete data
        // By default already using softdelte (defined on model)
        // Don't delete the client logo, because we only softdelete it
        $client->delete();

        Redis::del($client->slug);
    }
}
