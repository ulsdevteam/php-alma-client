<?php

namespace Scriptotek\Alma\Users;

use Scriptotek\Alma\Model\Model;

class Address extends Model
{
    /**
     * Set the type of this address
     * 
     * @param string $address_type The address type
     * @param string $description The description of this address type
     */
    public function setAddressType($address_type, $description = null)
    {
        $addressTypeObj = ['value' => $address_type];
        if ($description) {
            $addressTypeObj['desc'] = $description;
        }
        $this->data->address_type = [(object) $addressTypeObj];
    }
}