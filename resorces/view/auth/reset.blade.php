@extends('admin.layouts.page')


@section('head')
    <title></title>
@endsection


@section('content')
<div class="content-header row">
</div>
<div class="content-body">
    <section class="row flexbox-container">
        <div class="col-xl-7 col-10 d-flex justify-content-center">
            <div class="card bg-authentication rounded-0 mb-0 w-100">
                <div class="row m-0">
                    <div class="col-lg-6 d-lg-block d-none text-center align-self-center p-0">
                        <img src="<?= asset('admin-assets/images/pages/reset-password.png') ?>" alt="branding logo">
                    </div>
                    <div class="col-lg-6 col-12 p-0">
                        <div class="card rounded-0 mb-0 px-2">
                            <div class="card-header pb-1">
                                <div class="card-title">
                                    <h4 class="mb-0">تغییر کلمه عبور</h4>
                                </div>
                            </div>
                            <p class="px-2">لطفا کلمه عبور جدید را وارد کنید</p>
                          <?php if(errorExist()){ ?>
                            <div class="alert alert-danger">
                                <ul>
                                <?php foreach(alleErors() as $error){ ?>
                                    <li>
                                      <?= $error ?>
                                    </li>
                                  <?php } ?>
                                </ul>
                            </div>
                            <?php } ?>
                        
                            <div class="card-content">
                                <div class="card-body pt-1">
                                    <form action="<?= route('auth.change',[$token]) ?>" method="post">
                                        <input type="hidden" name="_method" value="put">
                                        <fieldset class="form-label-group">
                                            <input name="password" type="password" class="form-control" id="user-password" placeholder="Password">
                                            <label for="user-password">Password</label>
                                        </fieldset>

                                        <fieldset class="form-label-group">
                                            <input name="confirm_password" type="password" class="form-control" id="new-password" placeholder="Confirm Password" >
                                            <label for="confirm-password">Confirm Password</label>
                                        </fieldset>
                                        <div class="row pt-2">
                                            <div class="col-12 col-md-6 mb-1">
                                                <a href="<?= route('auth.login') ?>" class="btn btn-outline-primary btn-block px-0">بازگشت به پنل ورود</a>
                                            </div>
                                            <div class="col-12 col-md-6 mb-1">
                                                <button type="submit" class="btn btn-primary btn-block px-0">ثبت کلمه عبور جدید</button>
                                            </div>
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