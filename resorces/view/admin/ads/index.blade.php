@extends('admin.layouts.app')


@section('head')
    <title>پنل ادمین|بخش اگهی</title>
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
                        <span><a href="<?= route('admin.ads.create') ?>" class="btn btn-success">ایجاد</a></span>
                    </div>
                    <div class="card-content">
                        <div class="card-body card-dashboard">

                            <div class="">
                                <table class="table zero-configuration">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>عنوان</th>
                                        <th>دسته</th>
                                        <th>آدرس</th>
                                        <th>تصویر</th>
                                        <th>مشخصات</th>
                                        <th>تگ</th>
                                        <th>کاربر</th>
                                        <th style="width: 22rem;">تنظیمات</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($ads as $ad) { ?>
                                        <tr role="row" class="odd">
                                            <td class="sorting_1"><?=  $ad->id ?></td>
                                            <td><?=  $ad->title ?></td>
                                            <td><?= $ad->category()->name ?></td>
                                            <td><?= $ad->address ?></td>
                                            <td><img style="width: 90px;" src="<?= asset($ad->image) ?>" alt=""></td>
                                            <td>
                                                <ul>
                                                    <li>طبقه :<?= $ad->floor ?></li>
                                                    <li>سال ساخت :<?= $ad->year ?></li>
                                                    <li>انباری :<?= $ad->storeroom ?></li>
                                                    <li>بالکن :<?= $ad->balcony ?></li>
                                                    <li>متراژ :<?= $ad->area ?></li>
                                                    <li>اتاق :<?= $ad->room ?></li>
                                                    <li>سرویس بهداشتی :<?= $ad->toilet ?></li>
                                                    <li>پارکینگ :<?= $ad->parking ?></li>
                                                </ul>
                                            </td>
                                            <td><?= $ad->tag ?></td>
                                            <td><?= $ad->user()->first_name . ' '. $ad->user()->last_name ?></td>
                                            <td style="width: 22rem;">
                                                <a href="<?= route('admin.ads.gallery',[$ad->id]) ?>" class="btn btn-warning waves-effect waves-light">گالری</a>
                                                <a href="<?= route('admin.ads.edit',[$ad->id]) ?>" class="btn btn-info waves-effect waves-light">ویرایش</a>
                                                <form class="d-inline" action="<?= route('admin.ads.delete',[$ad->id]) ?>" method="post">
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