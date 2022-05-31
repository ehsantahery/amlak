<?php

namespace System\DataBase\Traits;

trait HasAttribute
{

    public function registerAttribute($object, string $attribute, $value)
    {

        $this->IncastAttribute($attribute) == true ? $object->$attribute = $this->CastdecodeValue($attribute, $value)  : $object->$attribute = $value;
    }

    protected function ArrayToAttributes(array $array, $object = null)
    {

        if (!$object) {
            $classname = get_called_class();
            $object = new $classname;
        }
        foreach ($array as $attribute => $value) {

            if ($this->InhiddenAttribute($attribute))
                continue;
            $this->registerAttribute($object, $attribute, $value);
        }

        return $object;
    }

    protected function ArrayToObject(array $array)
    {
        $collection = [];
        foreach ($array as $value) {
            $object = $this->ArrayToAttributes($value);
            array_push($collection, $object);
        }

        $this->Collection = $collection;
    }

    private function InhiddenAttribute($attribute)
    {

        return in_array($attribute, $this->Hidden);
    }

    protected function IncastAttribute($attribute)
    {

        return in_array($attribute, array_keys($this->Casts));
    }

    private function CastdecodeValue($attributekey, $value)
    {


        if ($this->casts[$attributekey] == 'array' || $this->casts[$attributekey] == 'object') {

            return unserialize($value);
        }
    }

    private function CastencodeValue($attributekey, $value)
    {
        var_dump($attributekey);
        if ($this->casts[$attributekey] == 'array' || $this->casts[$attributekey] == 'object') {

            return serialize($value);
        }
    }

    private function arrayToencodvalu($values)
    {

        $newarray = [];
        foreach ($values as $attribute => $value) {
            $this->IncastAttribute($attribute) == true ? $newarray[$attribute] = $this->CastencodeValue($attribute, $value) :
                $newarray[$attribute] = $value;
        }

        return $newarray;
    }
}
