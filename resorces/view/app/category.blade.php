@extends('app.layouts.app')


@section('header')
    <title>دسته بندی</title>
@endsection




@section('content')
<section class="ftco-section bg-light">
    <div class="container">
        <div class="row justify-content-center mb-5 pb-3">
            <div class="col-md-7 heading-section text-center ftco-animate">
                <h2 class="mb-4">دسته بندی</h2>
                <h3 class="mb-4"><?= $category->name ?></h3>
                <h4>اگهی ها</h4>
                
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
          
            <?php foreach($advertises as $ads){ ?>
               
            <div class="col-sm col-md-5 col-lg-4 ftco-animate">
                <div class="properties">
                    <a href="<?= route('home.ads',[$ads->id])?>" class="img img-2 d-flex justify-content-center align-items-center" style="background-image: url('<?= asset($ads->image) ?>');">
                        <div class="icon d-flex justify-content-center align-items-center">
                            <span class="icon-search2"></span>
                        </div>
                    </a>
                    <div class="text p-3">
                        <span class="status <?= $ads->sellstatusBtn() ?>"><?= $ads->sellstatus() ?></span>
                        <div class="d-flex">
                            <div class="one">
                                <h3><a href="<?= route('home.ads',[$ads->id])?>"><?= $ads->title ?></a></h3>
                                <p><?= $ads->type() ?></p>
                            </div>
                            <div class="two">
                                <span class="price">تومان<p><?= $ads->amount ?></p></span>
                            </div>
                        </div>
                        <p><?= substr(html_entity_decode($ads->description),0,100) ?></p>
                        <hr>
                        <p class="bottom-area d-flex">
                            <span><i class="flaticon-selection mx-1"></i>متر ۱۹۰</span>
                            <span class="ml-auto"><i class="flaticon-bathtub"></i> ۲</span>
                            <span><i class="flaticon-bed"></i> ۴</span>
                        </p>
                    </div>
                </div>
            </div>
            <?php } ?>
           
        </div>
    </div>
</section>
<section class="ftco-section">
    <div class="container">
        <div class="row justify-content-center mb-5 pb-3">
            <div class="col-md-7 heading-section text-center ftco-animate">
                <h4>بلاگها</h4>
            </div>
        </div>
        <div class="row d-flex">

            <?php foreach($posts as $post){ ?>
            <div class="col-md-4 d-flex ftco-animate">
                <div class="blog-entry align-self-stretch">
                    <a href="blog-single.html" class="block-20" style="background-image: url('<?= asset($post->image) ?>');">
                    </a>
                    <div class="text mt-3 d-block">
                        <h3 class="heading mt-3"><a href="#"><?= html_entity_decode($post->body) ?></a></h3>
                        <div class="meta mb-3">
                            <div><a class=" border" href="#"><?= \Morilog\Jalali\Jalalian::forge($post->published_at)->format('%B %d ،%Y') ?></a></div>
                            <div><a href="#"><?= $post->user()->first_name." ".$post->user()->last_name ?></a></div>
                            <div><a href="#" class="meta-chat"><span class="icon-chat"></span> ۳</a></div>
                        </div>
                    </div>
                </div>
            </div>
           <?php } ?>
        </div>
    </div>
</section>
@endsection