<?php

class OriginalContentExtension extends SiteTreeExtension
{

    public function contentcontrollerInit(ContentController $controller){
        Requirements::css(WF_USERFORMS_DIR . '/css/userforms.css');
    }

    public function OriginalContent()
    {
        return $this->owner->Content;
    }
}