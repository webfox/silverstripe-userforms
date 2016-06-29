<?php

class EditableDropdownExtension extends DataExtension
{

    protected static $db = [
        'EmptyText' => 'Varchar(255)'
    ];
    
    public function updateCMSFields(FieldList $fields){
        
        $fields->addFieldToTab('Root.Main',
            TextField::create('EmptyText')->setDescription('if not empty this value will be used as a placeholder')
        );
        
    }

    public function beforeUpdateFormField(DropdownField $field){
        if($this->owner->EmptyText){
            $field->setEmptyString($this->owner->EmptyText);
        }
    }

}
