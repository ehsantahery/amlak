@extends('admin.layouts.app')

@section('head')
    <title>پنل مدیریت | کامنت ها</title>
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
                        <h4 class="card-title">نظرات</h4>
                        <span><a href="#" class="btn btn-success disabled">ایجاد</a></span>
                    </div>
                    <div class="card-content">
                        <div class="card-body card-dashboard">

                            <div class="">
                                <table class="table zero-configuration">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>کاربر</th>
                                        <th>نظر</th>
                                        <th>وضعیت</th>
                                        <th>تنظیمات</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($coments as $coment){ ?>
                                        <tr role="row" class="odd">
                                            <td class="sorting_1"><?= $coment->id ?></td>
                                            <td><?= $coment->user()->first_name .' '.$coment->user()->last_name ?></td>
                                            <td><?= $coment->comment ?></td>
                                            <td><span class="<?= ClassActiveOrUnActive($coment->approved) ?>"><?= TexActiveOrUnActive($coment->approved) ?></span></td>
                                           <?php if($coment->parent_id == null){ ?>
                                            <td>
                                                <a href="<?= route('admin.coment.show',[$coment->id]) ?>" class="btn btn-success waves-effect waves-light">نمایش</a>
                                                <a href="<?= route('admin.coment.approved',[$coment->id]) ?>" class="btn waves-effect waves-light <?= ClassBtnActiveOrUn($coment->approved) ?>"><?= TexBtnActiveOrUn($coment->approved) ?></a>
                                            </td>
                                            <?php }
                                          
                                             ?>

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