@extends('app.layouts.app')


@section('header')
    <title>جستجو</title>
@endsection


@section('content')
<section class="ftco-section bg-light">
    <div class="container">
        <div class="row justify-content-center mb-5 pb-3">
            <div class="col-md-7 heading-section text-center ftco-animate">
                <?php if(!empty($advertises)){ ?>
                    <h2 class="mb-4">نتایج پیدا شده در اگهی ها</h2>
                    <?php }else{ ?>
                    <h2>!نتیجه ای یافت نشد</h2>
                    <?php } ?>
                <h4>مورد جستجو<span>: <?= $result ?></span></h4>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
          
            <?php foreach($advertises as $ads){ ?>
               
            <div class="col-sm col-md-6 col-lg ftco-animate">
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
                            <span><i class="flaticon-selection mx-1"></i><?= $ads->area ?></span>
                            <span class="ml-auto"><i class="flaticon-bathtub"></i><?= $ads->toilet ?></span>
                            <span><i class="flaticon-bed"></i><?= $ads->room ?></span>
                            <span><i class=" icon-street-view "></i><?=$ads->view?></span>
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
                <?php if(!empty($posts)){ ?>
                <h2 class="mb-4">نتایج پیدا شده در بلاگ ها</h2>
                <?php }else{ ?>
                <h2>!نتیجه ای یافت نشد</h2>
                <?php } ?>
                <h4>مورد جستجو<span>: <?= $result ?></span></h4>
            </div>
        </div>
        <div class="row d-flex">
           
            <?php foreach($posts as $post){ ?>
             
            <div class="col-md-4 d-flex ftco-animate">
                <div class="blog-entry align-self-stretch">
                    <a href="<?= route('home.blog',[$post->id]) ?>" class="block-20" style="background-image: url('<?= asset($post->image) ?>');">
                    </a>
                    <div class="text mt-3 d-block">
                        <h3 class="heading mt-3"><a href="#"><?= html_entity_decode($post->body) ?></a></h3>
                        <div class="meta mb-3">
                            <div><a class=" border" href="#"><?= \Morilog\Jalali\Jalalian::forge($post->published_at)->format('%B %d ،%Y') ?></a></div>
                            <div><a href="#"><?= $post->user()->first_name." ".$post->user()->last_name ?></a></div>
                            <div><a href="#" class="meta-chat"><span class="icon-chat"><?= count($post->coumment()->whereNull('parent_id')->get()) ?></span></a></div>
                        </div>
                    </div>
                </div>
            </div>
           <?php } ?>
        </div>
    </div>
</section>
@endsection