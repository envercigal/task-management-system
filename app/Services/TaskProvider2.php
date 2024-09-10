<?php

namespace App\Services;
use Illuminate\Support\Facades\Http;

class TaskProvider2 implements TaskProvider {
    public function execute() {
        $this->fakeRequest();
        $response = Http::get('https://enuygun.com/mock2');
        if ($response->successful()) {
            return $response->json();
        }

        return [];
    }

    public function fakeRequest(): void {
        Http::fake([
            'enuygun.com/mock2' => Http::response([
                [
                    "id" => 1,
                    "zorluk" => 3,
                    "sure" => 5
                ],
                [
                    "id" => 2,
                    "zorluk" => 2,
                    "sure" => 3
                ],
                [
                    "id" => 3,
                    "zorluk" => 1,
                    "sure" => 2
                ],
                [
                    "id" => 4,
                    "zorluk" => 4,
                    "sure" => 7
                ],
                [
                    "id" => 5,
                    "zorluk" => 5,
                    "sure" => 8
                ],
                [
                    "id" => 6,
                    "zorluk" => 2,
                    "sure" => 4
                ],
                [
                    "id" => 7,
                    "zorluk" => 3,
                    "sure" => 6
                ],
                [
                    "id" => 8,
                    "zorluk" => 1,
                    "sure" => 3
                ]
            ])
        ]);
    }
}
