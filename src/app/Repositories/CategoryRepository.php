<?php

namespace FPD\Repositories;

use App\Repositories\Base\BaseRepository;
use Crazy\Helpers\Arr;
use Illuminate\Support\Facades\DB;

class CategoryRepository extends BaseRepository
{    
        
    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return \App\Models\FPDCategory::class;
    }

    /**
     * class chứ các phương thức để validate dử liệu
     * @var string $validatorClass 
     */
    protected $validatorClass = 'FPD\CategoryValidator';

    /**
     * tên class mặt nạ. Thược có tiền tố [tên thư mục] + \ vá hậu tố Mask
     *
     * @var string
     */
    protected $maskClass = 'FPD\CategoryMask';

    /**
     * tên collection mặt nạ
     *
     * @var string
     */
    protected $maskCollectionClass = 'FPD\CategoryCollection';
    /**
     * @var string $system
     */
    protected $system = 'both';

    /**
     * @var boolean $isSetDefault
     */
    public $isSetDefault = false;
    
    

    /**
     * đã kiểm tra hay chưa
     * @var boolean $checked
     */
    protected $checked = false;

    
    protected $joibDesigns = false;
    
    /**
     * @var array $sortByRules kiểu sắp xếp
     */
    protected $sortByRules = [
        1 => 'id-DESC',
        2 => 'name-ASC',
        3 => 'name-DESC',
        4 => 'designs',
        5 => 'rand()',
        6 => 'id-ASC'
    ];

    /**
     * thiết lập ban đầu
     */
    public function init()
    {
        $this->addDefaultValue('type','fpd.design')->addDefaultParam('type', 'type', 'fpd.design');
        $this->setJoinable([
            ['leftJoin', 'fpd_designs', 'fpd_designs.category_id', '=', 'categories.id']
            
        ])
        ->setSelectRaw(['COUNT(fpd_designs.id) as design_count'])
        ->setSelectable(['categories.*'])
        ->setGroupBy('categories.id')
        ->setWith('designs');
    }
    

    /**
     * lam gi do truoc khi lay data
     */
    public function beforeGetData($args = [])
    {

        if(isset($args['@count_design'])){
            $this->joibDesigns = true;
            $this->leftJoin('fpd_designs', 'fpd_designs.category_id', '=', 'categories.id')->groupBy('categories.id')
            ->select('categories.*')
            ->selectRaw('count(fpd_designs.id) as '.str_slug($args['@count_design'], '_'));
        }
        // elseif(isset($args['@count_all'])){
        //     $this->leftJoin('posts', function($join){
        //         $join->on('posts.category_id', '=', 'categories.id');
        //         $join->on('posts.type', '=', 'post');

        //     })->groupBy('categories.id')
        //     ->select('categories.*')
        //     ->selectRaw('count(posts.id) as '.str_slug($args['@count_post'], '_'));
        // }
    }

    public function avaliableCategory()
    {
        return $this;
    }
        /**
     * lấy danh sach danh mục
     *
     * @param array $args
     * @return collection|\App\Masks\Categories\CategoryCollection|[]
     */
    public function getCategories($args = [])
    {
        // tham số nâng cao
        if(isset($args['@advance']) && is_array($args['@advance']) && in_array('design_count', $args['@advance']))
        {
            // nếu cần đếm toàn bộ số sản phẩm
            $this->joibDesigns = true;
            $columns = 'categories.*, count(fpd_designs.id) as design_count';
            $this->selectRaw($columns)->leftJoin('fpd_designs', 'fpd_designs.category_id', '=', 'categories.id')->groupBy('categories.id');
        }

        // sap xep danh sach
        $a = false;
        foreach (['', 'type', 'Type', '_type'] as $k) {
            if(isset($args['@sort'.$k])){
                if(!$a){
                    $this->parseSortBy($args['@sort'.$k]);
                    $a = true;
                }
                unset($args['@sort'.$k]);
            }    
        }
        
        return $this->parseCollection($this->get($args));
    }


    
    /**
     * xử lý order by cho hàm lấy sản phẩm
     *
     * @param array|string $sortBy
     * @return void
     */
    public function parseSortBy($sortBy)
    {
        if(is_array($sortBy)){
            // truong hop mang toan index la so
            if(Arr::isNumericKeys($sortBy)){
                foreach ($sortBy as $by) {
                    $this->checkSortBy($by);
                }
            }else{
                foreach ($sortBy as $column => $type) {
                    if(is_numeric($column)){
                        $this->checkSortBy($type);
                    }elseif(strtolower($column) == 'designs') {
                        $this->orderByDesignCount($type);
                    }else{
                        $this->order_by($column, $type);
                    }
                }
            }
        }else{
            $this->checkSortBy($sortBy);
        }
    }


    /**
     * kiểm tra tính hợp lệ của tham sớ truyền vào
     *
     * @param string $sortBy
     * @param string $type
     * @return void
     */
    protected function checkSortBy($sortBy = null, $type = null)
    {
        if(in_array($sortBy, $this->sortByRules)){
            $this->orderByRule($sortBy);
        }elseif (array_key_exists($sortBy, $this->sortByRules)) {
            $this->orderByRule($this->sortByRules[$sortBy]);
        }elseif(strtolower($sortBy) == 'seller'){
            $this->orderByPostDesignCount($type?$type:'DESC');
        }elseif($sortBy){
            $this->order_by($sortBy, $type?$type:'ASC');
        }
    }


    /**
     * order by rule
     *
     * @param string $rule
     * @return void
     */
    protected function orderByRule($rule)
    {
        if($rule == 'rand()'){
            $this->orderByRaw($rule);
            
        }elseif($rule == 'posts'){
            $this->orderByPostCount();
        }
        else{
            $a = explode('-', $rule);
            $this->order_by($a[0], $a[1]);
        }
    }

    
    /**
     * sap xep theo ban nhieu
     *
     * @param string $type
     * @return void
     */
    protected function orderByDesignCount($type = 'DESC')
    {
        if(strtoupper($type) != 'ASC') $type = 'DESC';
        if(!$this->joibDesigns){
            $this->selectRaw('categories.*, count(fpd_designs.id) as design_count')
            ->leftJoin('fpd_designs', 'fpd_designs.category_id', '=', 'categories.id');
            
        }
        $this->groupBy('categories.id')
            ->orderByRaw('count(posts.id) '.$type);
    }
}