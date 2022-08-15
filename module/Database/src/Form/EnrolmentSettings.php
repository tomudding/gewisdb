<?php

namespace Database\Form;

use Database\Model\Enums\SettingTypes;
use Laminas\Form\Element\{
    Checkbox,
    Submit,
};
use Laminas\Filter\Boolean;
use Laminas\Form\Form;
use Laminas\InputFilter\InputFilterProviderInterface;

class EnrolmentSettings extends Form implements InputFilterProviderInterface
{
    public function __construct()
    {
        parent::__construct();

        $this->add([
            'name' => SettingTypes::RequireIban->value,
            'type' => Checkbox::class,
            'options' => [
                'label' => 'Vereis IBAN voor SEPA machtiging',
                'use_hidden_element' => true,
                'checked_value' => '1',
                'unchecked_value' => '0',
            ],
        ]);

        $this->add([
            'name' => 'submit',
            'type' => Submit::class,
            'attributes' => [
                'value' => 'Wijzig adres',
            ],
        ]);
    }

    /**
     * Specification of input filter.
     */
    public function getInputFilterSpecification(): array
    {
        return [
            SettingTypes::RequireIban->value => [
                'required' => true,
                'allow_empty' => true,
                'continue_if_empty' => true,
                'filters' => [
                    ['name' => Boolean::class],
                ],
            ],
        ];
    }
}
