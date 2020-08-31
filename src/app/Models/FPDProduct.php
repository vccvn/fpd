<?php

namespace App\Models;

class FPDProduct extends Model
{
    public $table = 'fpd_products';
    public $fillable = ['title', 'thumbnail', 'options', 'deleted'];

    
    public $optionData = [];

    public function templates()
    {
        return $this->hasMany(FPDTemplate::class, 'fpd_product_id', 'id');
    }

    /**
     * get avatar url
     * @param boolean $urlencode mã hóa url
     * @return string 
     */
    public function getThumbnail()
    {
        if($this->thumbnail){
            $filename = $this->thumbnail;
        }else{
            $filename = 'default.png';
        }
        $path = 'static/fpd/products/';
        
        $url = asset($path.$filename);
        

        return $url;
    }

    public function parseJsonData()
    {
        if(!$this->optionData && is_array($od = json_decode($this->options, true))) {
            $this->optionData = $od;
        }
        
    }

    public function toAdminData()
    {
        $data = $this->toArray();
        $data['thumbnail_url'] = $this->getThumbnail();
        return $data;
    }

    public function getProductData()
    {
        $this->parseJsonData();
        return array_merge($this->toArray(),[
            'options' => $this->optionData,
            
        ]);
    }

    
    /**
     * xoa ảnh
     */
    public function deleteFile()
    {
        $path1 = 'static/fpd/products/';
        if($this->thumbnail && $this->thumbnail != 'default.png' && file_exists($path = public_path($path1.$this->thumbnail))){
            unlink($path);
        }
        $this->deleteList('templates');


    }

    public function beforeDelete()
    {
        $this->deleteFile();
    }
    
}
