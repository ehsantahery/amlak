@extends('app.layouts.app')



@section('header')
    <title>وبلاگ</title>
@endsection




@section('content')
<section class="ftco-section bg-light">
  <div class="container">
  <div class="row d-flex">
    <?php foreach(paginate($posts,8) as $blog){ ?>
     <div class="col-md-3 d-flex ftco-animate">
        <div class="blog-entry align-self-stretch">
           <a href="<?= route('home.blog',[$blog->id]) ?>" class="block-20" style="background-image: url('<?= asset($blog->image) ?>');">
           </a>
           <div class="text mt-3 d-block">
              <h3 class="heading mt-3"><a href="#"><?= $blog->title ?></a></h3>
              <p class=" text-lg-right"><?= html_entity_decode(substr($blog->body,0,300)) ?></p>
              <div class="meta mb-3">
                 <div><a href="<?= route('home.blog',[$blog->id]) ?>"><?= $blog->published_at ?></a></div>
                 <div><a href="<?= route('home.blog',[$blog->id]) ?>"><?= $blog->user()->first_name.' '.$blog->user()->last_name ?></a></div>
                 <div><a href="<?= route('home.blog',[$blog->id]) ?>" class="meta-chat"><span class="icon-chat"></span><?= $blog->view ?></a></div>
              </div>
           </div>
        </div>
     </div>
     <?php } ?>
     
  </div>
  <?= paginateView($posts,8) ?>
</section>
@endsection