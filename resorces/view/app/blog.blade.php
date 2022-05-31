@extends('app.layouts.app')


@section('header')
    <title>نمایش اگهی</title>
@endsection



@section('content')
<section class="ftco-section ftco-degree-bg">
   <div class="container">
   <div class="row">
      <div class="col-lg-8 ftco-animate">
         <img src="<?= asset($post->image) ?>" alt="" class="img-fluid">
         <h2 class="mb-3"><?= $post->title ?></h2>
         <p><?= html_entity_decode($post->body) ?></p>
         
        
         <div class="pt-5 mt-5">
            <h3 class="mb-5">نظرات</h3>
            <?php foreach($couments as $coment){ ?>      
                  <ul class="comment-list">
                     <li class="comment">
                       
                        <div class="vcard bio">
                           <img src="<?= asset($coment->user()->avatar) ?>" alt="Image placeholder">
                        </div>
                        <div class="comment-body">
                           <h3><?= $coment->user()->first_name.' '.$coment->user()->last_name ?></h3>
                           <div class="meta"><?= \Morilog\Jalali\Jalalian::forge($coment->created_at)->format('%B %d ،%Y') ?></div>
                           <p><?= $coment->comment ?></p>
                        </div>
                       <?php 
                       $ComentResult = $coment->child()->get();
                       if(!empty($ComentResult)){
                       ?>
                        <ul class="children">
                           <?php foreach($ComentResult as $result){ ?>
                           <li class="comment">
                              <div class="vcard bio">
                                 <img src="<?= asset($result->user()->avatar) ?>" alt="Image placeholder">
                              </div>
                              <div class="comment-body">
                                 <h3><?= $result->user()->first_name.' '.$result->user()->last_name ?></h3>
                                 <div class="meta"><?= \Morilog\Jalali\Jalalian::forge($result->created_at)->format('%B %d ،%Y') ?></div>
                                 <p><?= $result->comment ?></p>
                              </div>
                           </li>
                           <?php } ?>
                        </ul>
                      <?php } ?>
                     </li>
                  </ul>
             <?php } ?>
            <!-- END comment-list -->
            <?php if(\System\Auth\Auth::checkLogin()){ ?>
            <div class="comment-form-wrap pt-5">
               <h3 class="mb-5">درج نظر</h3>
               <form action="<?= route('home.comment',[$post->id]) ?>" method="POST" class="p-5 bg-light">
                
                  <div class="form-group">
                     <label for="message">پیام</label>
                     <textarea name="comment" id="message" cols="30" rows="10" class="form-control"></textarea>
                  </div>
                  <div class="form-group">
                     <input type="submit" value="ارسال نطر" class="btn py-3 px-4 btn-primary">
                  </div>
               </form>
            </div>
            <?php }else{ ?>

               <a href="<?=  route('auth.register.view') ?>" class="btn btn-success waves-effect waves-light">ثبت نام</a>
               <a href="<?= route('auth.login') ?>" class="btn btn-primary waves-effect waves-light">ورود</a>
             <?php } ?>
         </div>
        
      </div>
      <!-- .col-md-8 -->
      <div class="col-lg-4 sidebar ftco-animate">
         <div class="sidebar-box ftco-animate">
            <div class="categories">
               <h3>دسته بندی ها</h3>
               <?php foreach($categorys as $category){ ?>
               <li><a href="<?= route('home.category',[$category->id]) ?>"><?= $category->name ?><span>(<?= count($category->post()->get()) ?>)</span></a></li>
               <?php } ?>
            </div>
         </div>
         <div class="sidebar-box ftco-animate">
            <h3>اخرین بلاگ ها</h3>
            <?php foreach($posts as $post){ ?>
            <div class="block-21 mb-4 d-flex">
               <a class="blog-img mr-4" style="background-image: url('<?= asset($post->image) ?>');"></a>
               <div class="text">
                  <h3 class="heading"><a href="<?= route('home.blog',[$post->id]) ?>"><?= $post->title ?></a></h3>
                  <div class="meta">
                     <div><a href="<?= route('home.blog',[$post->id]) ?>"><span class="icon-calendar"></span><?= \Morilog\Jalali\Jalalian::forge($post->published_at)->format('%B %d ،%Y') ?></a></div>
                     <div><a href="<?= route('home.blog',[$post->id]) ?>"><span class="icon-person"></span><?= $post->user()->first_name.' '.$post->user()->last_name ?></a></div>
                     <div><a href="<?= route('home.blog',[$post->id]) ?>"><span class="icon-chat"></span><?= $post->view ?></a></div>
                  </div>
               </div>
            </div>
           <?php } ?>
           
         </div>
      </div>
   </div>
</section>
<!-- .section -->>
@endsection