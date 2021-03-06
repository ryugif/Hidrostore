<style>
#loading
{
    text-align: center;
    background: url('<?= base_url();?>assets_front/loader.gif') 
    no-repeat center ;
    height: 150px;
}
</style>
<!-- <div id="loading"></div> -->
<section class="breadcrumb-section pb-3 pt-3">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Products</li>
            </ol>
        </div>
    </section>
    <section class="products-grid pb-4 pt-4">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-4 col-12">
                    <div class="sidebar">
                        <div class="sidebar-widget">
                            <div class="widget-title">
                                <h3>Shop by Price</h3>
                            </div>
                            <div class="widget-content shop-by-price">
                                <form method="GET" action="/tesas">
                                    <div class="price-filter">
                                        <div class="price-filter-inner">
                                        <input type="hidden" id="hidden_minimum_price" value="0">
                                        <input type="hidden" id="hidden_maximum_price" value="100000">
                                        <p id="price_show">1000 - 100000</p>
                                            <div id="price_range"></div>
                                            <!-- <div class="price_slider_amount">
                                                <div class="label-input">
                                                    <input type="text" id="amount" name="price"
                                                        placeholder="Add Your Price" />
                                                    <button type="submit">Filter</button>
                                                </div>
                                            </div> -->
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="sidebar-widget">
                            <div class="widget-title">
                                <h3>Categories</h3>
                            </div>
                            <div class="widget-content widget-categories">
                            <?php foreach($category->result_array() as $row){?>
                            <div class="list-group-item checkbox">
                                <label><input type="checkbox" class="common_selector category"
                                value="<?= $row['category_name'];?>">
                                <?= $row['category_name'];?>
                                </label>
                            </div>
                                <!-- <ul>
                                    <li><a href="#">Fashions</a></li>
                                    <li><a href="#">Electronics</a>
                                        <ul>
                                            <li><a href="#">Hand Phone</a></li>
                                            <li><a href="#">Laptops</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="#">Home and Kitchen</a></li>
                                    <li><a href="#">Baby and Toys</a></li>
                                    <li><a href="#">Sports</a></li>
                                    <li><a href="#">Digital Goods</a></li>
                                </ul> -->
                                <?php }?>
                            </div>
                        </div>
                        <!-- <div class="sidebar-widget">
                            <div class="widget-title">
                                <h3>Brands</h3>
                            </div>
                            <div class="widget-content widget-brands">
                                <ul>
                                    <li><a href="#">Apple</a></li>
                                    <li><a href="#">Samsung</a></li>
                                    <li><a href="#">Lenovo</a></li>
                                    <li><a href="#">Asus</a></li>
                                    <li><a href="#">Xiaomi</a></li>
                                </ul>
                            </div>
                        </div> -->
                    </div>
                </div>
                <div class="col-lg-9 col-md-8 col-12">
                    <div class="row">
                        <div class="col-12">
                        <?php echo form_open('front/productfront/search')?>
                        <div class="input-group w-100">
                                <input type="text" name="keyword"class="form-control" placeholder="Search">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="submit">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </div>
                            </div>
                            <?php form_close() ?>
                        </div>
                    </div>
                    <br>
                    <div class="row filter_data">
                        <!-- <div class="col-lg-4 col-md-6 col-12">
                            <div class="single-product">
                                <div class="product-img">
                                    <a href="product-detail.html">
                                        <img src="<?= base_url();?>assets_front/assets/img/products/p1.jpg" class="img-fluid" />
                                    </a>
                                </div>
                                <div class="product-content">
                                    <h3><a href="product-detail.html">Cool &amp; Awesome Item</a></h3>
                                    <div class="product-price">
                                        <span>$57.00</span>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                        <!-- <div class="col-lg-4 col-md-6 col-12">
                            <div class="single-product">
                                <div class="product-img">
                                    <a href="product-detail.html">
                                        <img src="<?= base_url();?>assets_front/assets/img/products/p2.jpg" class="img-fluid" />
                                    </a>
                                </div>
                                <div class="product-content">
                                    <h3><a href="product-detail.html">Cool &amp; Awesome Item</a></h3>
                                    <div class="product-price">
                                        <span>$57.00</span>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                        <!-- <div class="col-lg-4 col-md-6 col-12">
                            <div class="single-product">
                                <div class="product-img">
                                    <a href="product-detail.html">
                                        <img src="<?= base_url();?>assets_front/assets/img/products/p3.jpg" class="img-fluid" />
                                    </a>
                                </div>
                                <div class="product-content">
                                    <h3><a href="product-detail.html">Cool &amp; Awesome Item</a></h3>
                                    <div class="product-price">
                                        <span>$57.00</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-12">
                            <div class="single-product">
                                <div class="product-img">
                                    <a href="product-detail.html">
                                        <img src="<?= base_url();?>assets_front/assets/img/products/p4.jpg" class="img-fluid" />
                                    </a>
                                </div>
                                <div class="product-content">
                                    <h3><a href="product-detail.html">Cool &amp; Awesome Item</a></h3>
                                    <div class="product-price">
                                        <span>$57.00</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-12">
                            <div class="single-product">
                                <div class="product-img">
                                    <a href="product-detail.html">
                                        <img src="<?= base_url();?>assets_front/assets/img/products/p1.jpg" class="img-fluid" />
                                    </a>
                                </div>
                                <div class="product-content">
                                    <h3><a href="product-detail.html">Cool &amp; Awesome Item</a></h3>
                                    <div class="product-price">
                                        <span>$57.00</span>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                        <!-- <div class="col-lg-4 col-md-6 col-12">
                            <div class="single-product">
                                <div class="product-img">
                                    <a href="product-detail.html">
                                        <img src="<?= base_url();?>assets_front/assets/img/products/p2.jpg" class="img-fluid" />
                                    </a>
                                </div>
                                <div class="product-content">
                                    <h3><a href="product-detail.html">Cool &amp; Awesome Item</a></h3>
                                    <div class="product-price">
                                        <span>$57.00</span>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                    </div>
                    <div class="row">
                    <div id="pagination_link">
                        <!-- <div class="col-12">
                            <ul class="pagination">
                                <li class="page-item disabled">
                                    <a class="page-link" href="#" tabindex="-1">
                                        <i class="fa fa-angle-left"></i>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                </li>
                                <li class="page-item"><a class="page-link" href="#">1</a></li>
                                <li class="page-item active">
                                    <a class="page-link" href="#">2 <span class="sr-only">(current)</span></a>
                                </li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item">
                                    <a class="page-link" href="#">
                                        <i class="fa fa-angle-right"></i>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </li>
                            </ul>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    