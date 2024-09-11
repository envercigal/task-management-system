<?php

namespace App\Services\Providers;

use Illuminate\Support\Facades\Http;

class TaskProvider1 implements TaskProvider
{
    public function execute()
    {
        $this->fakeRequest();
        $response = Http::get('https://enuygun.com/mock1');
        if ($response->successful()) {
            return $response->json();
        }

        return [];
    }

    public function fakeRequest(): void
    {
        $mockArray = include base_path('resources/mocks/provider1.php');

        Http::fake([
            'enuygun.com/mock1' => Http::response($mockArray),
        ]);
    }
}
