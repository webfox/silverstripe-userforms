<?php

/**
 * EditableCheckbox
 *
 * A user modifiable checkbox on a UserDefinedForm
 *
 * @package userforms
 */
class EditableLinkedCheckbox extends EditableFormField
{

    private static $singular_name = 'Linked Checkbox Field';

    private static $plural_name = 'Linked Checkboxes';

    private static $db = [
        'CheckedDefault' => 'Boolean', // from CustomSettings
        'LabelText' => 'Varchar(255)',
    ];

    private static $has_one = [
        'Link' => 'Page'
    ];

    private static $defaults = [
        'LabelText' => 'I agree to the'
    ];

    /**
     * @return FieldList
     */
    public function getCMSFields()
    {
        $defaults        = Config::inst()->get(get_class($this), 'defaults', Config::UNINHERITED);
        $this->LabelText = $this->LabelText ?: $defaults['LabelText'];

        $fields = parent::getCMSFields();

        $fields->insertBefore('Default', $labelText = TextField::create('LabelText'));
        $fields->insertBefore('Default', TreeDropdownField::create('LinkID', 'Page', 'SiteTree'));

        $fields->replaceField('Default', CheckboxField::create(
            "CheckedDefault",
            _t('EditableFormField.CHECKEDBYDEFAULT', 'Checked by Default?')
        ));

        return $fields;
    }

    public function getFormField()
    {
        $link = $this->Link();
        if($link->exists()){
            $label = $this->LabelText . ' <a href="' . $link->Link() . '" target="_blank">' . $link->MenuTitle . '</a>';
        } else {
            $label = 'Link not set: Did you want a normal checkbox instead?';
        }

        $field = CheckboxField::create($this->Name, $label, $this->CheckedDefault)
            ->setFieldHolderTemplate('UserFormsCheckboxField_holder')
            ->setTemplate('UserFormsCheckboxField');

        $this->doUpdateFormField($field);

        return $field;
    }

    public function getValueFromData($data)
    {
        $value = (isset($data[$this->Name])) ? $data[$this->Name] : false;

        return ($value) ? _t('EditableFormField.YES', 'Yes') : _t('EditableFormField.NO', 'No');
    }

    public function migrateSettings($data)
    {
        // Migrate 'Default' setting to 'CheckedDefault'
        if (isset($data['Default'])) {
            $this->CheckedDefault = (bool)$data['Default'];
            unset($data['Default']);
        }

        parent::migrateSettings($data);
    }
}
