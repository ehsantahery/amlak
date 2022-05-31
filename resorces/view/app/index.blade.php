@extends('app.layouts.app')




@section('header')
<title>صفحه اصلی</title>
@endsection


@section('content')
<section class="ftco-search">
    <div class="container">
        <div class="row">
            <div class="col-md-12 search-wrap">
                <h2 class="heading h5 d-flex align-items-center pr-4"><span class="ion-ios-search mr-3"></span>جستوجو</h2>
                <form action="<?= route('home.search') ?>" class="search-property" method="GET">
                    <div class="row">
                        <div class="col-md align-items-end">
                            <div class="form-group">
                                <label for="#">عنوان اگهی</label>
                                <div class="form-field">
                                    <div class="icon"><span class="icon-pencil "></span></div>
                                    <input type="text" name="search" class="form-control text-right" placeholder="عنوان">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">

                        <div class="col-md align-self-end">
                            <div class="form-group">
                                <div class="form-field">
                                    <input type="submit" value="جستوجو" class="form-control btn btn-primary">
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>


<section class="ftco-section bg-light">
    <div class="container">
        <div class="row d-flex">
            <div class="col-md-3 d-flex align-self-stretch ftco-animate">
                <div class="media block-6 services py-4 d-block text-center">
                    <div class="d-flex justify-content-center">
                        <div class="icon"><span class="flaticon-pin"></span></div>
                    </div>
                    <div class="media-body p-2 mt-2">
                        <h3 class="heading mb-3">پیدا کردن خانه در هرجای </h3>
                        <p>به راحتی در هرجای ایران خانه موردنظر خود را انتخاب کنید</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 d-flex align-self-stretch ftco-animate">
                <div class="media block-6 services py-4 d-block text-center">
                    <div class="d-flex justify-content-center">
                        <div class="icon"><span class="flaticon-detective"></span></div>
                    </div>
                    <div class="media-body p-2 mt-2">
                        <h3 class="heading mb-3">نمایندگان فعال</h3>
                        <p>نمایندگان فعال در سراسر کشور</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 d-flex align-sel Searchf-stretch ftco-animate">
                <div class="media block-6 services py-4 d-block text-center">
                    <div class="d-flex justify-content-center">
                        <div class="icon"><span class="flaticon-house"></span></div>
                    </div>
                    <div class="media-body p-2 mt-2">
                        <h3 class="heading mb-3">خرید و یا اجاره</h3>
                        <p>دسته بندی جدا خانه های خریدنی و یا اجاره کردنی</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 d-flex align-self-stretch ftco-animate">
                <div class="media block-6 services py-4 d-block text-center">
                    <div class="d-flex justify-content-center">
                        <div class="icon"><span class="flaticon-purse"></span></div>
                    </div>
                    <div class="media-body p-2 mt-2">
                        <h3 class="heading mb-3">دو سر سود</h3>
                        <p>منفعت برای خریدار و فروشنده</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="ftco-section ftco-properties">
    <div class="container">
        <div class="row justify-content-center mb-5 pb-3">
            <div class="col-md-7 heading-section text-center ftco-animate">
                <span class="subheading">اخرین پست ها</span>
                <h2 class="mb-4">اخرین اگهی ها</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
               
                <div class="properties-slider owl-carousel ftco-animate">
                    <?php foreach($newestAds as $ad){ ?>
                    <div class="item">
                        <div class="properties">
                            <a href="<?= route('home.ads',[$ad->id])?>" class="img d-flex justify-content-center align-items-center" style="background-image: url('<?= asset($ad->image) ?>')">
                                <div class="icon d-flex justify-content-center align-items-center">
                                    <span class="icon-search2"></span>
                                </div>
                            </a>
                            <div class="text p-3">
                                <span class="status <?= $ad->sellstatusBtn() ?>"><?= $ad->sellstatus() ?></span>
                                <div class="d-flex">
                                    <div class="one">
                                        <h3><a href="<?= route('home.ads',[$ad->id])?>"><?= $ad->title ?></a></h3>
                                        <p><?= substr(html_entity_decode($ad->description),0,100) ?></p>
                                    </div>
                                    <div class="two">
                                        <span class="price"><?= $ad->amount ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </div>   
               
            </div>
        </div>
    </div>
</section>

<section class="ftco-section bg-light">
    <div class="container">
        <div class="row justify-content-center mb-5 pb-3">
            <div class="col-md-7 heading-section text-center ftco-animate">
                <span class="subheading">پیشنهادات ویژه</span>
                <h2 class="mb-4">بهترین اگهی ها</h2>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
          
            <?php foreach($bestAds as $ads){ ?>
               
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

<section class="ftco-section ftco-counter img" id="section-counter" style="background-image: url(<?= asset('/app/images/bg_1.jpg') ?>);">
    <div class="container">
        <div class="row justify-content-center mb-3 pb-3">
            <div class="col-md-7 text-center heading-section heading-section-white ftco-animate">
                <h2 class="mb-4">برخی اطلاعات جالب</h2>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="row">
                    <div class="col-md-3 d-flex justify-content-center counter-wrap ftco-animate">
                        <div class="block-18 text-center">
                            <div class="text">
                                <strong class="number" data-number="<?= $alluser ?>">0</strong>
                                <span>مشتریان خوشحال</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 d-flex justify-content-center counter-wrap ftco-animate">
                        <div class="block-18 text-center">
                            <div class="text">
                                <strong class="number" data-number="<?= $allads ?>">0</strong>
                                <span>آگهی ها</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 d-flex justify-content-center counter-wrap ftco-animate">
                        <div class="block-18 text-center">
                            <div class="text">
                                <strong class="number" data-number="<?= $allpost ?>">0</strong>
                                <span>بلاگها</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 d-flex justify-content-center counter-wrap ftco-animate">
                        <div class="block-18 text-center">
                            <div class="text">
                                <strong class="number" data-number="<?= $sumarea ?>">0</strong>
                                <span>متراژ کلی </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>








<section class="ftco-section">
    <div class="container">
        <div class="row justify-content-center mb-5 pb-3">
            <div class="col-md-7 heading-section text-center ftco-animate">
                <span class="subheading">مقالات</span>
                <h2>آخرین بلاگ ها</h2>
            </div>
        </div>
        <div class="row d-flex" id="ajax">
           
           
        </div>
    </div>
</section>
@endsection


@section('script')

<script>
 
 $(window).on('load', function(){
        $.ajax({
            url : "<?= route('home.ajax') ?>",
            success: function(result){
                posts = result;
               
                var htmlString = '';
                for (var i = 0; i < posts.length; i++){
                    var post = posts[i];
                   
                    htmlString += '<div class="col-md-4 d-flex ftco-animated">';
                        htmlString += '<div class="blog-entry align-self-stretch">';
                            htmlString += '<a href="'+ post.url +'" class="block-20" style="background-image: url('+ post.image +');">';
                                htmlString += '</a>';
                                htmlString += '<div class="text mt-3 d-block">';
                                    htmlString += '<h3 class="heading mt-3"><a href="'+ post.url +'">'+ post.title +'</a></h3>';
                                    htmlString += '<p class=" text-lg-right">'+ post.body +'</p>'
                                    htmlString += '<div class="meta mb-3">';
                                        htmlString += '<div class="border">'+ post.publish +'</div>';
                                        htmlString += '<div>'+ post.user +'</div>';
                                        htmlString += '<div><a href="#" class="meta-chat"><span class="icon-chat">'+ post.commentnumber +'</span></a></div>'
                                    htmlString += '</div>';
                                htmlString += '</div>';
                            htmlString += '</div>';
                        htmlString += '</div>';
                }
               
                $('#ajax').html(htmlString);
                
            }
            
        });
    });

</script>

@endsection