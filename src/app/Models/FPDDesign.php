<?php

namespace FPD\Models;
use App\Models\Model;
class Design extends Model
{
    public $table = 'fpd_designs';
    public $fillable = [
        'category_id', 'title', 'filename', 'original_filename', 'mime', 
        'extension', 'size', 'parameters'
    ];

    /**
     * tính kích thước
     */
    public function sizeinfo()
    {
        
        $size_unit = "KB";
        $size = $this->size;
        if($size>=1024){
            $size = round($size*10/1024)/10;
            $size_unit = 'MB';
            if($size>=1024){
                $size = round($size*10/1024)/10;
                $size_unit = 'GB';
                if($size>=1024){
                    $size = round($size*10/1024)/10;
                    $size_unit = 'TB';
                }
            }
        }
        return compact('size', 'size_unit');
    }
    
    /**
     * get avatar url
     * @return string 
     */
    public function getThumbnail()
    {
        if($this->filename){
            $filename = $this->filename;
        }else{
            $filename = 'default.png';
        }
        $path = '/static/fpd/designs/';
        
        $url = $path.$filename;
        

        return $url;
    }

    public function getSource()
    {
        return $this->getThumbnail();
    }

    public function getUrl()
    {
        return $this->getThumbnail();
    }

    /**
     * xoa ảnh
     */
    public function deleteFile()
    {
        $path1 = 'static/fpd/designs/';
        if($this->filename && $this->filename != 'default.png' && file_exists($path = public_path($path1.$this->filename))){
            unlink($path);
        }


    }

    public function beforeDelete()
    {
        $this->deleteFile();
    }
    

    
    /**
     * lay du lieu form
     * @return array
     */
    public function toFormData()
    {
        $data = $this->toArray();
        
        
        $data['url'] = $this->getSource();
        $data['thumbnail'] = $this->getThumbnail();
        $data['source'] = $data['url'];

        
        return $data;
    }
    
}
