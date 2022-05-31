@extends('app.layouts.app')


@section('header')
    <title>وبلاگ | نمایش</title>
@endsection




@section('content')
<section class="ftco-section">
  <div class="container">
      <div class="row">
          <div class="col-lg-8">
              <div class="row">
                  <div class="col-md-12 ftco-animate">
                      <div class="single-slider owl-carousel">
                        <?php foreach($gallerys as $gallery){ ?>
                          <div class="item">
                              <div class="properties-img" style="background-image:url('<?= asset($gallery->image) ?>')"></div>
                          </div>
                         <?php  } ?>
                      </div>
                  </div>
                  <div class="col-md-12 Properties-single mt-4 mb-5 ftco-animate">
                      <h2><?= $advertise->title ?></h2>
                      <p class="rate mb-4">
                          <span class="loc"><a href="#"><i class="icon-map"></i><?= $advertise->address ?></a></span>
                      </p>
                      <p><?= $advertise->category()->name ?></p>
                      <div class="d-md-flex mt-5 mb-5">
                          <ul class=" list-unstyled">
                              <li><span>متراژ : </span><?= $advertise->area ?></li>
                              <li><span>اتاق خواب : </span><?= $advertise->room ?></li>
                              <li><span>سرویس بهداشتی : </span><?= $advertise->toilet ?></li>
                              <li><span>پارکینگ : </span><?= $advertise->parking() ?></li>
                          </ul>
                          <ul class="ml-md-5 list-unstyled">
                              <li><span>سال ساخت : </span><?= $advertise->year ?></li>
                              <li><span>انباری : </span><?= $advertise->storeroom() ?></li>
                              <li><span>بالکن : </span><?= $advertise->balcony() ?></li>
                          </ul>
                      </div>
                      <p><?= html_entity_decode($advertise->description) ?></p>
                  </div>

                  <div class="col-md-12 properties-single ftco-animate mb-5 mt-5">
                    <h4 class="mb-4">آگهی های مرتبط</h4>
                    <div class="row">
                        <?php foreach($Allads as $ads){ ?>
                        <div class="col-md-6 ftco-animate">
                            <div class="properties">
                                <a href="<?= route('home.ads',[$ads->id])?>" class="img img-2 d-flex justify-content-center align-items-center" style="background-image: url('<?= asset($ads->image) ?>');">
                                    <div class="icon d-flex justify-content-center align-items-center">
                                        <span class="icon-search2"></span>
                                    </div>
                                </a>
                                <div class="text p-3">
                                    <span class="status sale"><?= $ads->sellstatus() ?></span>
                                    <div class="d-flex">
                                        <div class="one">
                                            <h3><a href="property-single.html"><?= $ads->address ?></a></h3>
                                            <p><?= $ads->category()->name ?></p>
                                        </div>
                                        <div class="two">
                                            <span class="price"><?= $ads->amount ?></span>
                                        </div>
                                    </div>
                                    <p><?= html_entity_decode(substr($ads->description,0,400)) ?></p>
                                    <hr>
                                    <p class="bottom-area d-flex">
                                        <span><i class="flaticon-selection"></i><?= $ads->area ?></span>
                                        <span class="ml-auto"><i class="flaticon-bathtub"></i><?= $ads->toilet ?></span>
                                        <span><i class="flaticon-bed"></i><?= $ads->room ?></span>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>
                 
                     
              </div>
          </div>
          <!-- .col-md-8 -->
         
          <div class="col-lg-4 sidebar ftco-animate">

              <div class="sidebar-box ftco-animate">
                <h3>دسته بندی ها</h3>
                  <div class="categories">
                    <?php foreach($categorys as $category){ ?>
                      
                    <li><a href="<?= route('home.category',[$category->id]) ?>"><?= $category->name ?><span>(<?= count($category->ads()->get()) ?>)</span></a></li>
                    <?php } ?>
                  </div>
              </div>

              <div class="sidebar-box ftco-animate">
                  <h3>اخرین بلاگ ها</h3>
                  <?php foreach($Allpost as $post){ ?>
                  <div class="block-21 mb-4 d-flex">
                      <a href="<?= route('home.blog',[$post->id]) ?>" class="blog-img mr-4" style="background-image: url('<?= asset($post->image) ?>')"></a>
                      <div class="text">
                          <h3 class="heading"><a href=""><?= $post->title ?></a></h3>
                          <div class="meta">
                              <div><a href="<?= route('home.blog',[$post->id]) ?>"><span class="icon-calendar"></span><?= \Morilog\Jalali\Jalalian::forge($post->published_at)->format('%B %d ،%Y') ?></a></div>
                              <div><a href="<?= route('home.blog',[$post->id]) ?>"><span class="icon-person"></span><?= $post->user()->first_name.' '.$post->user()->last_name ?></a></div>
                              <div><a href="<?= route('home.blog',[$post->id]) ?>"><span class="icon-chat"></span><?= $post->view ?></a></div>
                          </div>
                      </div>
                  </div>
                 <?php } ?>
              </div>


</section>
@endsection