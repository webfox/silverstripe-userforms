<?php

/**
 * Class WebFoxUserFormExtension
 *
 * @property UserForm $owner
 */
class WebFoxUserFormExtension extends SiteTreeExtension
{
    public function updateForm()
    {
        $data = [];
        foreach ($this->owner->getController()->getRequest()->getVars() as $key => $value) {
            if (!in_array($key, ['url', 'flush'])) $data[$key] = $value;
        }
        $this->owner->loadDataFrom($data);
    }
}
