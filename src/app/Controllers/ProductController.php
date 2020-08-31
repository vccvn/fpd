<?php

namespace FPD\Controllers;

use App\Http\Controllers\Clients\ClientController;
// use App\Repositories\FPD\CategoryRepository;
use Illuminate\Http\Request;
use Crazy\Helpers\Arr;

use App\Repositories\FPD\ProductRepository;
use App\Repositories\Metadatas\MetadataRepository;
use App\Repositories\Products\CategoryRepository;

class ProductController extends ClientController
{
    protected $module = 'fpd.products';

    protected $moduleName = 'Fancy Product Designer';

    protected $flashMode = true;


    /**
     * repository chinh
     *
     * @var ProductRepository
     */
    public $repository;
    
    /**
     * meta
     *
     * @var CategoryRepository $categoryRepository
     */
    public $categoryRepository;
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
    public function __construct(ProductRepository $repository, CategoryRepository $categoryRepository, MetadataRepository $metadataRepository)
    {
        $this->repository = $repository;
        $this->metadataRepository = $metadataRepository;
        $this->categoryRepository = $categoryRepository->addDefaultParam('deleted', 0);
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

    public function customProduct(Request $request)
    {
        $categories = $this->categoryRepository->withCount([
            'products' => function($query){
                $query->where('type', 'design')->where('deleted', 0);
            }
        ])->havingRaw('products_count > 0')->get();
        return view('fpd::client.welcome', compact('categories'));
    }

    public function getProducts(Request $request)
    {
        $products = $this->repository->get(['category_id'=>$request->category_id]);
        return view('fpd::client.products', compact('products'));
    }

    public function design(Request $request)
    {
        $product = $this->repository->mode('mask')->detail(['id' => $request->id]);
        $stage_width = 400;
        $stage_height = 600;
        return view('fpd::client.design', compact('product'));
        
    }

}
