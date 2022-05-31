@extends('admin.layouts.app')


@section('head')
    <title>پنل مدیریت | ساخت اسلاید جدید</title>
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
                        <h4 class="card-title">اسلایدشو</h4>
                        <span><a href="<?= route('admin.slider.index') ?>" class="btn btn-success">بازگشت</a></span>
                    </div>
                    <div class="card-content">
                        <div class="card-body card-dashboard">

                            <form class="row" action="<?= route('admin.slider.store') ?>" method="post" enctype="multipart/form-data">

                                <div class="col-md-6">
                                    <fieldset class="form-group">
                                        <label for="title">عنوان</label>
                                        <input value="<?= old('title') ?>" name="title" type="text" id="title" class="form-control <?= errorClass('title') ?>" placeholder="عنوان ...">
                                        <?= errorText('title') ?>
                                    </fieldset>
                                </div>


                                <div class="col-md-6">
                                    <fieldset class="form-group">
                                        <label for="url">لینک</label>
                                        <input value="<?= old('url') ?>" name="url" type="text" id="url" class="form-control <?= errorClass('url') ?>" placeholder="عنوان ...">
                                        <?= errorText('url') ?>
                                    </fieldset>
                                </div>


                                <div class="col-md-6">
                                    <fieldset class="form-group">
                                        <label for="address">آدرس</label>
                                        <input value="<?= old('address') ?>" name="address" type="text" id="address" class="form-control <?= errorClass('address') ?>" placeholder="عنوان ...">
                                        <?= errorText('address') ?>
                                    </fieldset>
                                </div>

                                <div class="col-md-6">
                                    <fieldset class="form-group">
                                        <label for="amount">مبلغ</label>
                                        <input value="<?= old('amount') ?>" name="amount" type="text" id="amount" class="form-control <?= errorClass('amount') ?>" placeholder="عنوان ...">
                                        <?= errorText('amount') ?>
                                    </fieldset>
                                </div>


                                <div class="col-md-6">
                                    <fieldset class="form-group">
                                        <label for="image">تصویر</label>
                                        <input name="image" type="file" id="image" class="form-control-file <?= errorClass('image') ?>">
                                        <?= errorText('image') ?>
                                    </fieldset>
                                </div>


                                <div class="col-md-12">
                                    <section class="form-group">
                                        <label for="body">متن</label>
                                        <textarea class="form-control <?= errorClass('body') ?>" id="body" rows="5" name="body" placeholder="متن ..."><?= old('body') ?></textarea>
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