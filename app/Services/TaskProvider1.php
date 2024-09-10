<?php

namespace App\Services;
use Illuminate\Support\Facades\Http;

class TaskProvider1 implements TaskProvider{
    public function execute() {
        $this->fakeRequest();
        $response = Http::get('https://enuygun.com/mock1');
        if ($response->successful()) {
            return $response->json();
        }

        return [];
    }

    public function fakeRequest(): void {
        Http::fake([
            'enuygun.com/mock1' => Http::response([
                [
                    "id" => 1,
                    "value" => 3,
                    "estimated_duration" => 4
                ],
                [
                    "id" => 2,
                    "value" => 6,
                    "estimated_duration" => 12
                ],
                [
                    "id" => 3,
                    "value" => 5,
                    "estimated_duration" => 9
                ],
                [
                    "id" => 4,
                    "value" => 5,
                    "estimated_duration" => 5
                ],
                [
                    "id" => 5,
                    "value" => 7,
                    "estimated_duration" => 7
                ],
                [
                    "id" => 6,
                    "value" => 3,
                    "estimated_duration" => 5
                ],
                [
                    "id" => 7,
                    "value" => 4,
                    "estimated_duration" => 8
                ],
                [
                    "id" => 8,
                    "value" => 6,
                    "estimated_duration" => 3
                ],
            ])
        ]);
    }
}
