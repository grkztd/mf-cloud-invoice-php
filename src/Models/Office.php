<?php

namespace Grkztd\MfCloud\Models;

use Grkztd\MfCloud\Models\Base;

class Office extends Base
{
    protected $fields = [
        'name', 'zip', 'prefecture', 'address1', 'address2', 'tel', 'fax',
    ];

    public function update(array $params){
        $this->attributes = $this->api->update('', $params);

        return $this;
    }
}
