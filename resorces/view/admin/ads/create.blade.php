@extends('admin.layouts.app')

@section('head')
<title>اگهی ها |ساخت اگهی جدید</title>
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
                        <h4 class="card-title">آگهی</h4>
                        <span><a href="<?= route('admin.ads.index') ?>" class="btn btn-success">بازگشت</a></span>
                    </div>
                    <div class="card-content">
                        <div class="card-body card-dashboard">

                            <form class="row" action="<?= route('admin.ads.store') ?>" method="post" enctype="multipart/form-data">

                                <div class="col-md-6">
                                    <fieldset class="form-group ">
                                        <label for="title">عنوان</label>
                                        <input  name="title" type="text" id="title" value="<?= old('title') ?>" class="form-control <?= errorClass('title') ?>" placeholder="عنوان ...">
                                        <?= errorText('title') ?>
                                    </fieldset>
                        
                                </div>



                                <div class="col-md-6">
                                    <fieldset class="form-group ">
                                        <label for="image">تصویر</label>
                                        <input name="image" type="file" id="image"  class="form-control-file <?= errorClass('image') ?>">
                                        <?= errorText('image') ?>
                                    </fieldset>
                                </div>

                                <div class="col-md-6">
                                    <fieldset class="form-group">
                                        <label for="address">آدرس</label>
                                        <input  name="address" type="text" id="address" value="<?= old('address') ?>" class="form-control <?= errorClass('address') ?>" placeholder="آدرس ...">
                                        <?= errorText('address') ?>
                                    </fieldset>
                                </div>


                                <div class="col-md-6">
                                    <fieldset class="form-group">
                                        <label for="floor">کف</label>
                                        <input name="floor" type="text" id="floor" value="<?= old('floor') ?>" class="form-control <?= errorClass('floor') ?>" placeholder="طبقه ...">
                                        <?= errorText('floor') ?>
                                    </fieldset>
                                </div>


                                <div class="col-md-6">
                                    <fieldset class="form-group">
                                        <label for="year">سال ساخت</label>
                                        <input  name="year" type="number" id="year" value="<?= old('year') ?>" class="form-control <?= errorClass('year') ?>" placeholder="سال ساخت ...">
                                        <?= errorText('year') ?>
                                    </fieldset>
                                </div>

                                <div class="col-md-6">
                                    <fieldset class="form-group">
                                        <label for="amount">قیمت</label>
                                        <input name="amount" type="text" id="amount" value="<?= old('amount') ?>" class="form-control <?= errorClass('amount') ?>" placeholder="قیمت ...">
                                        <?= errorText('amount') ?>
                                    </fieldset>
                                </div>

                                <div class="col-md-6">
                                    <fieldset class="form-group">
                                        <label for="area">متراژ</label>
                                        <input name="area" type="text" id="area" value="<?= old('area') ?>" class="form-control <?= errorClass('area') ?>" placeholder="متراژ ...">
                                        <?= errorText('area') ?>
                                    </fieldset>
                                </div>

                                <div class="col-md-6">
                                    <fieldset class="form-group">
                                        <label for="room">اتاق</label>
                                        <input name="room" type="text" id="room" value="<?= old('room') ?>" class="form-control <?= errorClass('room') ?>" placeholder="اتاق ...">
                                        <?= errorText('room') ?>
                                    </fieldset>
                                </div>


                                <div class="col-md-6">
                                    <fieldset class="form-group">
                                        <label for="tag">تگ</label>
                                        <input name="tag" type="text" id="tag" value="<?= old('tag') ?>" class="form-control <?= errorClass('tag') ?>" placeholder="تگ ...">
                                        <?= errorText('tag') ?>
                                    </fieldset>
                                </div>


                                <div class="col-md-12">
                                    <section class="form-group">
                                        <label for="description">متن</label>
                                        <textarea class="form-control <?= errorClass('description') ?>" id="description" rows="5" name="description" placeholder="متن ..."><?= old('description') ?></textarea>
                                        <?= errorText('description') ?>
                                    </section>
                                </div>


                                <div class="col-md-6">
                                    <fieldset class="form-group">
                                        <div class="form-group">
                                            <label for="storeroom">انبار</label>
                                            <select name="storeroom" value="<?= old('storeroom') ?>" class="select2 form-control <?= errorClass('storeroom') ?>">
                                                <option value="0">ندارد</option>
                                                <option value="1">دارد</option>
                                                <?= errorText('storeroom') ?>
                                            </select>
                                        </div>
                                    </fieldset>
                                </div>

                                <div class="col-md-6">
                                    <fieldset class="form-group">
                                        <div class="form-group">
                                            <label for="balcony">بالکن</label>
                                            <select name="balcony" value="<?= old('balcony') ?>" class="select2 form-control <?= errorClass('balcony') ?>">
                                                <option value="0">ندارد</option>
                                                <option value="1">دارد</option>
                                                <?= errorText('balcony') ?>
                                            </select>
                                        </div>
                                    </fieldset>
                                </div>

                                <div class="col-md-6">
                                    <fieldset class="form-group">
                                        <div class="form-group">
                                            <label for="toilet">توالت</label>
                                            <select name="toilet" value="<?= old('toilet') ?>" class="select2 form-control <?= errorClass('toilet') ?>">
                                                <option value="ایرانی">ایرانی</option>
                                                <option value="فرنگی">فرنگی</option>
                                                <option value="ایرانی و فرنگی">ایرانی و فرنگی</option>
                                            </select>
                                            <?= errorText('toilet') ?>
                                        </div>
                                    </fieldset>
                                </div>


                                <div class="col-md-6">
                                    <fieldset class="form-group">
                                        <div class="form-group">
                                            <label for="sell_status">نوع آگهی</label>
                                            <select name="sell_status" value="<?= old('sell_status') ?>" class="select2 form-control <?= errorClass('sell_status') ?>">
                                                <option value="0">خرید</option>
                                                <option value="1">اجاره</option>
                                                <?= errorText('sell_status') ?>
                                            </select>
                                        </div>
                                    </fieldset>
                                </div>

                                <div class="col-md-6">
                                    <fieldset class="form-group">
                                        <div class="form-group">
                                            <label for="type">نوع ملک</label>
                                            <select name="type" value="<?= old('type') ?>" class="select2 form-control <?= errorClass('type') ?>">
                                                <option value="0">آپارتمان</option>
                                                <option value="1">ویلایی</option>
                                                <option value="2">زمین</option>
                                                <option value="3">سوله</option>
                                                <?= errorText('type') ?>
                                            </select>
                                        </div>
                                    </fieldset>
                                </div>


                                <div class="col-md-6">
                                    <fieldset class="form-group">
                                        <div class="form-group">
                                            <label for="parking">پارکینگ</label>
                                            <select name="parking" value="<?= old('parking') ?>" class="select2 form-control <?= errorClass('parking') ?>">
                                                <option value="0">ندارد</option>
                                                <option value="1">دارد</option>
                                                <?= errorText('parking') ?>
                                            </select>
                                        </div>
                                    </fieldset>
                                </div>


                                <div class="col-md-6">
                                    <fieldset class="form-group">
                                        <div class="form-group">
                                            <label for="cat_id">دسته</label>
                                            <select name="cat_id" class="select2 form-control <?= errorClass('cat_id') ?>">
                                                <?php foreach ($categoris as $categori) { ?>
                                                <option value="<?= $categori->id ?>" <?= oldOrValue('cat_id',$categori->id) == old('cat_id') ? 'selected' : '' ?>><?= $categori->name ?></option>
                                                <?php } ?>
                                                <?= errorText('cat_id') ?>
                                            </select>
                                        </div>
                                    </fieldset>
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
      .create(document.querySelector('#description'))
      .catch(error => {
        console.error(error);
      });
  </script>
@endsection