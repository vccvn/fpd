<style>
    .col-inner {
        padding: 0px 5px 0px 5px;
    }

    .col-inner a {
        margin-bottom: 10px
    }

    .col-inner span {
        padding: 2px 0px 6px 0;
    }

    .mb-phone {
        border-radius: 10px;
        padding-top: 5px;
        background-color: #020000;
        opacity: 0.8
    }
</style>
<style>
    .lightbox-content {
        padding: 5px 5px 0px 5px;
    }
</style>
<div class="lightbox-by-id lightbox-content lightbox-white">
    <div class="accordion">
        <div class="accordion-item">
            <div class="accordion-inner m-active" style="display: block">
                <!-- {!!json_encode($products)!!} -->
                @if (count($products))
                    <div class="row row-collapse">
                    
                        @foreach ($products as $product)
                            <div class="col medium-3 small-6 large-3">
                                <div class="col-inner">
                                    <a class="button is-small expand mb-phone" onclick="loadDesign(this,{{$product->id}})" title="{{$product->name}}" data-toggle="modal" data-target="#exampleModalCenter">
                                        <span>{{$product->name}}</span>
                                    </a>
                                </div>
                            </div>
                                
                        @endforeach
                    
                    </div>
                @else
                    <div class="text-center">Không có sản phẩm</div>
                @endif
            </div>
        </div>
    </div>
</div>