<?php
namespace System\DataBase\Traits;


trait HasRealationShip{

protected function hasOn($model,$foreignkey,$localkey){

    if($this->{$this->primarykey}){
        
        $object = new $model();
        return $object->gethasOnrelation($this->tabel,$foreignkey,$localkey,$this->localkey);

    }


}



protected function gethasOnrelation($tabel,$foreignkey,$otherkey,$otherkeyvalue){

    $this->setsql("SELECT `b`.* FROM `{$tabel}` AS `a` JOIN ON".$this->GetNameTabel()."AS `b` ON  `a`.`{$otherkey}` = `b`.`{$foreignkey}` ");
    $this->setwhere("AND"," `a`.`{$otherkey}` = ?");
    $this->tabel = "b";
    $this->addbindvalue($otherkey,$otherkeyvalue);
    $statmebt = $this->addquary();
    $data = $statmebt->fetch();
    if($data)
    return $this->ArrayToAttributes($data);
    return null;
    
    

}


protected function hasMany($model, $foreignKey, $otherKey){
    if($this->{$this->primarykey}){
        $modelObject = new $model;
        return $modelObject->getHasManyRelation($this->tabel, $foreignKey, $otherKey, $this->$otherKey);
    }
}

public function getHasManyRelation($tabel, $foreignKey, $otherKey, $otherKeyValue){
    // sql = 'SELECT posts.* FROM categories JOIN posts ON categories.id = posts.cat_id'
    // sql = 'SELECT categories.* FROM categories JOIN categories ON categories.id = categories.parent_id'
    $this->setsql("SELECT `b`.* FROM `{$tabel}` AS `a` JOIN ".$this->GetNameTabel()." AS `b` on `a`.`{$otherKey}` = `b`.`{$foreignKey}` ");
    $this->setwhere('AND', "`a`.`$otherKey` = ? ");
    $this->tabel = 'b';
    $this->addbindvalue($otherKey, $otherKeyValue);
   return $this;
}

protected function belongsTo($model, $foreignKey, $localKey){
    if($this->{$this->primarykey}){
        $modelObject = new $model;
        return $modelObject->getBelongsToRelation($this->tabel, $foreignKey, $localKey, $this->$foreignKey);
    }
}

public function getBelongsToRelation($tabel, $foreignKey, $otherKey, $foreignKeyValue){
    // sql = 'SELECT posts.* FROM categories JOIN posts ON categories.id = posts.cat_id'
    $this->setsql("SELECT `b`.* FROM `{$tabel}` AS `a` JOIN ".$this->GetNameTabel()." AS `b` on `a`.`{$foreignKey}` = `b`.`{$otherKey}` ");
    $this->setwhere('AND', "`a`.`$foreignKey` = ? ");
    $this->tabel = 'b';
    $this->addbindvalue($foreignKey, $foreignKeyValue);
    $statement = $this->addquary();
    $data = $statement->fetch();
    if ($data)
    return $this->ArrayToAttributes($data);
     return null;
}


protected function belongsToMany($model,$commontabel,$localkey,$middelforignkey,$middelrelation,$foreignkey){

  

    if($this->{$this->primarykey}){
        $object = new $model();

        return $object->gethasbelongsToMany($this->tabel,$commontabel,$localkey,$this->$localkey,$middelforignkey,$middelrelation,$foreignkey);

    }

}



protected function gethasbelongsToMany($tabel,$commontabel,$localkey,$localkeyvalue,$middelforignkey,$middelrelation,$foreignkey){

    
    $this->setsql("SELECT `c`.* FROM (SELECT `b`.* FROM {$tabel} AS `a` JOIN {$commontabel} AS `b` ON `a`.`{$localkey}`
    = `b`.`{$middelforignkey}` WHERE `a`.`{$localkey}` = ? ) AS `relation` JOIN".$this->GetNameTabel()." AS `c` ON `relation`.`{$middelrelation}` = `c`.`{$foreignkey}`");
    $this->addbindvalue("`{$tabel}_{$localkey}`",$localkeyvalue);
    $this->tabel = "c";
    return $this;

}


}