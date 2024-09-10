<?php

namespace App\Dtos;

class TaskDto
{
    private int $value;
    private int $estimatedDuration;
    private string $provider;
    private int $providerId;

    public function __construct(int $value, int $estimatedDuration, string $provider, int $providerId)
    {
        $this->value = $value;
        $this->estimatedDuration = $estimatedDuration;
        $this->provider = $provider;
        $this->providerId = $providerId;
    }

    public function getValue(): int
    {
        return $this->value;
    }

    public function getEstimatedDuration(): int
    {
        return $this->estimatedDuration;
    }

    public function getProvider(): string
    {
        return $this->provider;
    }

    public function getProviderId(): int
    {
        return $this->providerId;
    }


    public function setValue(int $value)
    {
        $this->value = $value;
    }

    public function setEstimatedDuration(int $estimatedDuration)
    {
        $this->estimatedDuration = $estimatedDuration;
    }

    public function setProvider(string $provider)
    {
        $this->provider = $provider;
    }

    public function setProviderId(int $providerId)
    {
        $this->providerId = $providerId;
    }


    // Convert the object to an array
    public function toArray(): array
    {
        return [
            'value' => $this->getValue(),
            'estimated_duration' => $this->getEstimatedDuration(),
            'provider' => $this->getProvider(),
            'provider_id' => $this->getProviderId(),
        ];
    }
}
