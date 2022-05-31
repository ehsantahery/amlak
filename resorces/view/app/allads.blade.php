@extends('app.layouts.app')


@section('header')
  <title>اگهی ها</title>
@endsection






@section('content')
<section class="ftco-section bg-light">
    <div class="container">
        <div class="row">
            <?php foreach(paginate($Allads,6) as $ads){ ?>
            <div class="col-md-4 ftco-animate">
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
                                <h3><a href="property-single.html"><?= $ads->title ?></a></h3>
                                <p><?= $ads->category()->name ?></p>
                            </div>
                            <div class="two">
                                <span class="price"><?= $ads->amount ?></span>
                            </div>
                        </div>
                        <p><?= html_entity_decode(substr($ads->description,0,150)) ?></p>
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
       <?= paginateView($Allads,6) ?>
    </div>
</section>
@endsection