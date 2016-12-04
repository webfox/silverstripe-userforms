<?php

class WebFoxUserDefinedFormExtension extends SiteTreeExtension
{
    public function getHasForm(){
        return !!$this->owner->Fields()->exclude(['ClassName' => 'EditableFormStep'])->Count();
    }
}
