@extends('admin.layouts.app')


@section('head')
    <title>پنل مدیریت | کاربر ها</title>
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
                        <h4 class="card-title">کاربران</h4>
                        <span><a href="#>" class="btn btn-success disabled">ایجاد</a></span>
                    </div>
                    <div class="card-content">
                        <div class="card-body card-dashboard">

                            <div class="">
                                <table class="table zero-configuration">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>ایمیل</th>
                                            <th>نام</th>
                                            <th>نام خانوادگی</th>
                                            <th>تصویر</th>
                                            <th>وضعیت</th>
                                            <th style="width: 22rem; text-align: left;">تنظیمات</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($users as $user){ ?>
                                        <tr role="row" class="even">
                                            <td class="sorting_1"><?= $user->id ?></td>
                                            <td><?= $user->email ?></td>
                                            <td><?= $user->first_name ?></td>
                                            <td><?= $user->last_name ?></td>
                                            <td><img src="<?= asset($user->avatar) ?>" style="width:6rem;" alt=""></td>
                                            <td><span class="<?= ClassTextColor($user->is_active) ?>"><?= texBtnActiveOrUn($user->is_active) ?></span></td>
                                            <td style="width: 22rem; text-align: left;">
                                                <a href="<?= route('admin.user.edit',[$user->id]) ?>" class="btn btn-info waves-effect waves-light">ویرایش</a>
                                                <a href="<?= route('admin.user.approved',[$user->id]) ?>" class="btn waves-effect waves-light <?= ClassBtnActiveOrUn_2($user->is_active) ?>">تغییر وضعیت</a>
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