@extends('admin.layouts.app')


@section('head')
<title>پنل مدیریت | اسلایدر</title>
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
                        <h4 class="card-title">اسلاید</h4>
                        <span><a href="<?= route('admin.slider.create') ?>" class="btn btn-success">ایجاد</a></span>
                    </div>
                    <div class="card-content">
                        <div class="card-body card-dashboard">

                            <div class="">
                                <table class="table zero-configuration">

                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>عنوان</th>
                                        <th>لینک</th>
                                        <th>آدرس</th>
                                        <th>مبلغ</th>
                                        <th>تصویر</th>
                                        <th style="min-width: 16rem; text-align: left;">تنظیمات</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($sliders as $slider){ ?>
                                        <tr role="row" class="odd">
                                            <td class="sorting_1">1</td>
                                            <td><?= $slider->title ?></td>
                                            <td><?= $slider->url ?></td>
                                            <td><?= $slider->address ?></td>
                                            <td><?= $slider->amount ?></td>
                                            <td><img src="<?= asset($slider->image) ?>" width="100px" height="100px" alt=""></td>
                                            <td style="min-width: 16rem; text-align: left;">
                                                <a href="<?= route('admin.slider.edit',[$slider->id]) ?>" class="btn btn-info waves-effect waves-light">ویرایش</a>
                                                <form class="d-inline" action="<?= route('admin.slider.delete',[$slider->id]) ?>" method="post">
                                                    <input type="hidden" name="_method" value="delete">
                                                    <button type="submit" class="btn btn-danger waves-effect waves-light">حذف</button>
                                                </form>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection