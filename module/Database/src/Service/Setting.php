<?php

namespace Database\Service;

use Database\Mapper\Setting;
use Database\Model\Setting as SettingModel;

class Query
{
    public function __construct(private readonly Setting $settingMapper)
    {
    }

    /**
     * Save a query.
     */
    public function update(array $data): SettingModel
    {

    }
}
