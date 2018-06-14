<?php


class AppHelper extends Helper {

    public function assetUrl($path, $options = []){

        if(!empty($this->request->params['_ext']) && $this->request->params['_ext'] === 'pdf'){
            $options['fullBase'] = true;
        }

        return parent::assetUrl($path, $options);
    }
}

?>