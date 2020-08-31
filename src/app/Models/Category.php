<?php

namespace App\Models;

class FPDCategory extends Category
{
    
    public function designs()
    {
        return $this->hasMany(FPDDesign::class, 'category_id', 'id');
    }

    public function beforeDelete()
    {
        $this->deleteFeatureImage();
        $this->deleteList('designs');
    }
    
    public function getThumbnail()
    {
        return $this->getFeatureImage();
    }
}
