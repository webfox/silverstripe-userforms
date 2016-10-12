<?php

class OriginalContentExtension extends SiteTreeExtension
{

    public function updateCMSFields(FieldList $fields) {
        Requirements::css(WF_USERFORMS_DIR . '/css/userforms_cms.css');
    }

    public function contentcontrollerInit(ContentController $controller){
        Requirements::block(FRAMEWORK_DIR . '/thirdparty/jquery/jquery.js');
        Requirements::css(WF_USERFORMS_DIR . '/css/userforms.css');
        Requirements::set_force_js_to_bottom(true);
    }

    public function OriginalContent()
    {
        return $this->owner->Content;
    }

    public function getHasForm(){
        return !!$this->owner->Fields()->exclude(['ClassName' => 'EditableFormStep'])->Count();
    }
}
