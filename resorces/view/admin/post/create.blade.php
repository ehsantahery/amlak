@extends('admin.layouts.app')


@section('head')
<title>پنل مدیریت | ساخت پست جدید</title>    
@endsection




@section('content')
<div class="content-header row">

</div>
<div class="content-body">
    <!-- Zero configuration table -->
    <section id="basic-datatable">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">پست</h4>
                        <span><a href="<?= route('admin.post.index') ?>" class="btn btn-success">بازگشت</a></span>
                    </div>
                    <div class="card-content">
                        <div class="card-body card-dashboard">

                            <form class="row" action="<?= route('admin.post.store') ?>" method="post" enctype="multipart/form-data">

                                <div class="col-md-6">
                                    <fieldset class="form-group">
                                        <label for="title">عنوان</label>
                                        <input value="" name="title" type="text" id="title" class="form-control <?= errorClass('title') ?>" placeholder="نام ...">
                                        <?= errorText('title') ?>
                                    </fieldset>
                                </div>



                                <div class="col-md-6">
                                    <fieldset class="form-group">
                                        <label for="published_at">تاریخ انتشار</label>
                                        <input value="" name="published_at" type="date" id="published_at" class="form-control <?= errorClass('published_at') ?>">
                                        <?= errorText('published_at') ?>
                                    </fieldset>
                                </div>


                                <div class="col-md-6">
                                    <fieldset class="form-group">
                                        <label for="image">تصویر</label>
                                        <input name="image" type="file" id="image" class="form-control-file <?= errorClass('image') ?>">
                                        <?= errorText('image') ?>
                                    </fieldset>
                                </div>


                                <div class="col-md-6">
                                    <fieldset class="form-group">
                                        <div class="form-group">
                                            <label for="cat_id">دسته</label>
                                            <select name="cat_id" class="select2 form-control <?= errorClass('cat_id') ?>">
                                                <?php foreach ($catgorys as $category ) { ?>
                                                <option value="<?= $category->id ?>"<?= oldOrValue('cat_id',$category->id) === old('cat_id') ? 'selected' : '' ?>><?= $category->name ?></option>
                                                <?php } ?>
                                                <?= errorText('cat_id') ?>
                                            </select>
                                        </div>
                                    </fieldset>
                                </div>

                                <div class="col-md-12">
                                    <section class="form-group">
                                        <label for="body">متن</label>
                                        <textarea class="form-control <?= errorClass('body') ?>" id="body" rows="5" name="body" placeholder="متن ..."></textarea>
                                        <?= errorText('body') ?>
                                    </section>
                                </div>

                                <div class="col-md-6">
                                    <section class="form-group">
                                        <button type="submit" class="btn btn-primary">ایجاد</button>
                                    </section>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@section('scripts')
    <script src="<?= asset("ckeditor/ckeditor.js") ?>"></script>
    <script>
        ClassicEditor
          .create(document.querySelector('#body'))
          .catch(error => {
            console.error(error);
          });
      </script>
@endsection