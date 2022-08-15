<?php

namespace Database\Model;

use Doctrine\ORM\Mapping\{
    Column,
    Entity,
    Id,
};
use Database\Model\Enums\SettingTypes;

/**
 * Setting model.
 */
#[Entity]
class Setting
{
    /**
     * Name
     */
    #[Id]
    #[Column(
        type: "string",
        enumType: SettingTypes::class,
    )]
    protected SettingTypes $name;

    /**
     * Value
     */
    #[Column(type: "blob")]
    protected mixed $value;

    /**
     * Get the name.
     */
    public function getName(): SettingTypes
    {
        return $this->name;
    }

    /**
     * Set the name.
     */
    public function setName(SettingTypes $name): void
    {
        $this->name = $name;
    }

    /**
     * Get the value, deserialized.
     */
    public function getValue(): mixed
    {
        if (null !== $this->value) {
            return unserialize($this->value);
        }

        return null;
    }

    /**
     * Set the value, serialized.
     */
    public function setValue(mixed $value): void
    {
        $this->value = serialize($value);
    }
}
