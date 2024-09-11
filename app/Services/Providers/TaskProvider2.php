<?php

namespace App\Services\Providers;

use Illuminate\Support\Facades\Http;

class TaskProvider2 implements TaskProvider
{
    public function execute()
    {
        $this->fakeRequest();
        $response = Http::get('https://enuygun.com/mock2');
        if ($response->successful()) {
            return $response->json();
        }

        return [];
    }

    public function fakeRequest(): void
    {

        $mockArray = include base_path('resources/mocks/provider2.php');

        Http::fake([
            'enuygun.com/mock2' => Http::response($mockArray),
        ]);
    }
}
