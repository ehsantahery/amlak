<section class="home-slider owl-carousel">
   <?php foreach($allsliders as $slid){ ?>
    <div class="slider-item"  style="background-image:url('<?= asset($slid->image) ?>');">
        <div class="overlay"></div>
        <div class="container">
            <div class="row no-gutters slider-text align-items-md-end align-items-center justify-content-end">
                <div class="col-md-6 text p-4 ftco-animate" style="direction: rtl;">
                    <h1 class="mb-3"><?= $slid->title ?></h1>
                    <span class="location d-block mb-3"><i class="icon-my_location"><?= $slid->address ?></i></span>
                    <p><?= html_entity_decode(substr($slid->body,0,400)) ?></p>
                    <span class="price"></span><a href="#" class="btn-custom p-3 px-4 bg-primary">مشاهده جزئیات<span class="icon-plus mr-1"></span></a>
                </div>
            </div>
        </div>
    </div>
    <?php  } ?>
</section>

