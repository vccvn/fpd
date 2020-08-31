<?php

namespace App\Models;

class FPDTemplate extends Model
{
    public $table = 'fpd_templates';
    public $fillable = ['product_id', 'name', 'thumbnail', 'options', 'elements', 'stage_width', 'stage_height', 'deleted'];


    public $optionData = [];
    public $elementData = [];
    


    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    public function parseJsonData()
    {
        if(!$this->optionData && is_array($od = json_decode($this->options, true))) {
            $this->optionData = $od;
        }
        if(!$this->elementData && is_array($ed = json_decode($this->elements, true))) {
            $this->elementData = $ed;
        }
        
    }

    public function getTemplateData()
    {
        $this->parseJsonData();
        return array_merge($this->toArray(),[
            'options' => $this->optionData,
            'elements' => $this->elementData,
            
        ]);
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
        $path = 'static/fpd/templates/';
        
        $url = asset($path.$filename);
        

        return $url;
    }

    
    public function toAdminData()
    {
        $data = $this->toArray();
        $data['thumbnail_url'] = $this->getThumbnail();
        return $data;
    }
    
    /**
     * xoa avatar
     */
    public function deleteFile()
    {
        $path1 = 'static/fpd/templates/';
        if($this->thumbnail && $this->thumbnail != 'default.png' && file_exists($path = public_path($path1.$this->thumbnail))){
            unlink($path);
        }

    }

}
