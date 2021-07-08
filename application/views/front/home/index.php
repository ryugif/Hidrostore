<section class="slider-section pt-4 pb-4">
        <div class="container">
            <div class="slider-inner">
                <div class="row">
                    <div class="col-md-3">
                        <nav class="nav-category">
                            <h2>Categories</h2>
                           
                            <ul class="menu-category">
                            <?php foreach($category as $kat){?>
                                <li><a href="#"><?=$kat->category_name ?></a></li>
                                <!-- <li><a href="#">Electronics</a></li>
                                <li><a href="#">Home and Kitchen</a></li>
                                <li><a href="#">Baby and Toys</a></li>
                                <li><a href="#">Sports</a></li>
                                <li><a href="#">Digital Goods</a></li> -->
                                <?php }?>
                            </ul>
                           
                        </nav>
                    </div>
                    <div class="col-md-9">
                        <div id="carouselExampleIndicators" class="carousel slide carousel-fade" data-ride="carousel">
                            <ol class="carousel-indicators">
                                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                            </ol>
                            <div class="carousel-inner shadow-sm rounded">
                                <div class="carousel-item active">
                                    <img class="d-block w-100" src="<?= base_url(); ?>assets_front/assets/img/slides/slide1.jpg" alt="First slide">
                                    <div class="carousel-caption d-none d-md-block">
                                        <h5>Mountains, Nature Collection</h5>
                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <img class="d-block w-100" src="<?= base_url(); ?>assets_front/assets/img/slides/slide2.jpg" alt="Second slide">
                                    <div class="carousel-caption d-none d-md-block">
                                        <h5>Freedom, Sea Collection</h5>
                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <img class="d-block w-100" src="<?= base_url(); ?>assets_front/assets/img/slides/slide3.jpg" alt="Third slide">
                                    <div class="carousel-caption d-none d-md-block">
                                        <h5>Living the Dream, Lost Island</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Slider -->
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Services -->
    <section class="pt-5 pb-5">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="media">
                        <div class="iconbox iconmedium rounded-circle text-info mr-4">
                            <i class="fa fa-truck"></i>
                        </div>
                        <div class="media-body">
                            <h5>Delivery</h5>
                            <p class="text-muted">
                            Pengiriman ke seluruh Indonesia dengan pengiriman JNE, Tiki & POS.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="media">
                        <div class="iconbox iconmedium rounded-circle text-purple mr-4">
                            <i class="fa fa-credit-card-alt"></i>
                        </div>
                        <div class="media-body">
                            <h5>Online Payment</h5>
                            <p class="text-muted">
                                Pembayaran dengan banyak metode: kartu kredit/debit, transfer bank, e-Money, dan masih banyak lagi.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="media">
                        <div class="iconbox iconmedium rounded-circle text-warning mr-4">
                            <i class="fa fa-refresh"></i>
                        </div>
                        <div class="media-body">
                            <h5>Free Return</h5>
                            <p class="text-muted">
                                All you have to do is to bring your passion. We take care of the rest.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Services -->
    <section class="products-grids trending pb-4">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title">
                        <h2>Trending Items</h2>
                    </div>
                </div>
            </div>
            <div class="row mt-4">
            <?php foreach($product as $produk){?>
                <div class="col-xl-3 col-lg-4 col-md-4 col-12">
                    <div class="single-product">
                        <div class="product-img">
                            <a href="<?=base_url('front/productfront/detail/'.$produk->id.'')?>">
                                <img src=" <?= base_url('uploads/'.$produk->thumbnail.'') ?>" style="height:250px; width:300px; margin:auto;" class="img-fluid" />
                            </a>
                        </div>
                        <div class="product-content">
                            <h3><a href="<?=base_url('front/productfront/detail/'.$produk->id.'')?>"><?= $produk->name?></a></h3>
                            <div class="product-price">
                                <span><?= indo_currency($produk->price)?></span>
                            </div>
                        </div>
                    </div>
                </div>
                <?php }?>
                <!-- <div class="col-xl-3 col-lg-4 col-md-4 col-12">
                    <div class="single-product">
                        <div class="product-img">
                            <a href="product-detail.html">
                                <img src="<?= base_url(); ?>assets_front/assets/img/products/p1.jpg" class="img-fluid" />
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
                <div class="col-xl-3 col-lg-4 col-md-4 col-12">
                    <div class="single-product">
                        <div class="product-img">
                            <a href="product-detail.html">
                                <img src="<?= base_url(); ?>assets_front/assets/img/products/p2.jpg" class="img-fluid" />
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
                <div class="col-xl-3 col-lg-4 col-md-4 col-12">
                    <div class="single-product">
                        <div class="product-img">
                            <a href="product-detail.html">
                                <img src="<?= base_url(); ?>assets_front/assets/img/products/p3.jpg" class="img-fluid" />
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
                <div class="col-xl-3 col-lg-4 col-md-4 col-12">
                    <div class="single-product">
                        <div class="product-img">
                            <a href="product-detail.html">
                                <img src="<?= base_url(); ?>assets_front/assets/img/products/p4.jpg" class="img-fluid" />
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
        </div>
    </section>
    <section class="mobile-apps pt-5 pb-3 border-top">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h3>Download apps</h3>
                    <p>Get an amazing app to make Your life easy</p>
                </div>
                <div class="col-md-6 text-md-right">
                    <a href="#"><img src="<?= base_url(); ?>assets_front/assets/img/appstore.png" height="40"></a>
                    <a href="#"><img src="<?= base_url(); ?>assets_front/assets/img/appstore.png" height="40"></a>
                </div>
            </div> <!-- row<?= base_url(); ?> assets_front// -->
        </div><!-- container // -->
    </section>