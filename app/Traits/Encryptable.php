<?php

namespace App\Traits;

use Illuminate\Support\Facades\Crypt;

trait Encryptable
{
    /**
     * Get the attributes that should be encrypted.
     *
     * @return array<string>
     */
    protected function getEncryptableAttributes(): array
    {
        if (property_exists($this, 'encryptable')) {
            return $this->encryptable;
        }
        
        return [];
    }

    /**
     * Get an attribute from the model.
     *
     * @param string $key
     * @return mixed
     */
    public function getAttribute($key)
    {
        $value = parent::getAttribute($key);

        if (in_array($key, $this->getEncryptableAttributes()) && !is_null($value)) {
            try {
                return Crypt::decryptString($value);
            } catch (\Exception $e) {
                return $value;
            }
        }

        return $value;
    }

    /**
     * Set a given attribute on the model.
     *
     * @param string $key
     * @param mixed $value
     * @return mixed
     */
    public function setAttribute($key, $value)
    {
        if (in_array($key, $this->getEncryptableAttributes()) && !is_null($value)) {
            $value = Crypt::encryptString($value);
        }

        return parent::setAttribute($key, $value);
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        $casts = [];
        
        foreach ($this->getEncryptableAttributes() as $attribute) {
            $casts[$attribute] = 'string';
        }
        
        return $casts;
    }
}