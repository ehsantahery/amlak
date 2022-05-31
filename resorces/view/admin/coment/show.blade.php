@extends('admin.layouts.app')



@section('head')
    <title>پنل مدیریت | نمایش پیام</title>
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
                        <span><a href="<?= route('admin.coment.index') ?>" class="btn btn-success">بازگشت</a></span>
                    </div>
                    <div class="card-content">
                        <div class="card-body card-dashboard">

                            <div class="row">
                                <div class="col-md-12">
                                    <h2><?= $coment->user()->first_name.' '.$coment->user()->last_name ?></h2>
                                    <p><?= $coment->comment ?></p>
                                </div>

                                <div class="col-md-12 mt-4 pt-4 border-top">
                                    <form action="<?= route('admin.coment.ansverd',[$coment->id]) ?>" method="post">
                                        <section class="form-group">
                                            <label for="comment">پاسخ</label>
                                            <textarea class="form-control " id="comment" rows="5" name="comment" placeholder="پاسخ ..."></textarea>
                                        </section>
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
            </div>
        </div>
    </section>

</div>
@endsection