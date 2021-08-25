<?php

declare(strict_types=1);

namespace App\DataTransferObjects;

final class SettingsDto extends \Spatie\DataTransferObject\DataTransferObject
{
    public string $name;

    public string $value;
}
