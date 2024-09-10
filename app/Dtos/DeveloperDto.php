<?php

namespace App\Dtos;

class DeveloperDto
{
    public $name;
    public $capacityPerHour;
    public $weeklyHours;
    public $availableHours;

    public function __construct($name, $capacityPerHour, $weeklyHours = 45)
    {
        $this->name = $name;
        $this->capacityPerHour = $capacityPerHour;
        $this->weeklyHours = $weeklyHours;
        $this->availableHours = $weeklyHours; // İlk hafta tam kapasite
    }

    public function resetAvailableHours()
    {
        $this->availableHours = $this->weeklyHours; // Her hafta başında kapasiteyi sıfırlıyoruz
    }

    public function canTakeTask($taskValue)
    {
        // Bu geliştiricinin işi yapma süresi
        $timeRequired = $taskValue / $this->capacityPerHour;

        // Eğer yeterli saat varsa iş alabilir
        return $timeRequired <= $this->availableHours;
    }

    public function assignTask($taskValue)
    {
        $timeRequired = $taskValue / $this->capacityPerHour;
        $this->availableHours -= $timeRequired;

        return [
            'developer' => $this->name,
            'task_value' => $taskValue,
            'time_required' => $timeRequired,
            'remaining_hours' => $this->availableHours
        ];
    }
}
