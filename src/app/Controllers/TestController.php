<?php

namespace FPD\Controllers;

use App\Http\Controllers\Admin\AdminController;

use Illuminate\Http\Request;
use Crazy\Helpers\Arr;

use App\Repositories\FPD\ProductRepository;
use App\Repositories\Metadatas\MetadataRepository;

class TestController extends AdminController
{
    protected $module = 'fpd.products';

    protected $moduleName = 'Sản phẩm';

    protected $viewFolder = '';
    /**
     * repository chinh
     *
     * @var ProductRepository
     */
    public $repository;
    
    /**
     * meta
     *
     * @var MetadataRepository $metadataRepository
     */
    public $metadataRepository;
    /**
     * Create a new controller instance.
     *
     * @param ProductRepository $repository
     * @param MetadataRepository $metadataRepository
     *
     * @return void
     */
    public function __construct(ProductRepository $repository, MetadataRepository $metadataRepository)
    {
        $this->repository = $repository;
        $this->metadataRepository = $metadataRepository;
        $this->init();
        $this->activeMenu("fpd");
        $this->repository->mode('mask')->setWith([
            'templates' => function($query){
                $query->where('deleted', 0);
            }, 
            'metadatas'
        ]);
        // $this->addEventListener('gettinglist', function(){
        //     $this->repository->mode('mask')->setWith(['templates', 'metadatas']);
        // });
        
        
        
    }

    public function HelloWorld(Request $request)
    {
        dd($this);
    }

    public function welcome(Request $request)
    {
        return view('fpd::client.welcome');
    }
}
