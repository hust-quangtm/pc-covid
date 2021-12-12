@extends('layouts.app', ['title' => __('User Profile')])

@section('content')
    @include('users.partials.header', [
        'title' => __('Xin chào') . ' '. auth()->user()->name,
        'description' => __('Hãy cùng chung tay đẩy lùi Covid'),
        'class' => 'col-lg-12'
    ])

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <h3 class="mb-0">{{ __('Cập Nhật Thông Tin Cá Nhân') }}</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('profile.update') }}" autocomplete="off">
                            @csrf
                            @method('put')

                            <h6 class="heading-small text-muted mb-4">{{ __('User information') }}</h6>

                            @if (session('status'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('status') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif


                            <div class="pl-lg-4">
                                <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-name">{{ __('Tên Đăng Nhập') }}</label>
                                    <input type="text" name="name" id="input-name" class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ __('Name') }}" value="{{ old('name', auth()->user()->name) }}" required autofocus>

                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-email">{{ __('Email') }}</label>
                                    <input type="email" name="email" id="input-email" class="form-control form-control-alternative{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{ __('Email') }}" value="{{ old('email', auth()->user()->email) }}" required>

                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('full_name') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-fullname">{{ __('Họ Và Tên') }}</label>
                                    <input type="text" name="full_name" id="input-fullname" class="form-control form-control-alternative{{ $errors->has('full_name') ? ' is-invalid' : '' }}" placeholder="{{ __('Full Name') }}" value="{{ old('full_name', auth()->user()->full_name) }}" required>

                                    @if ($errors->has('full_name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('full_name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('address') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-address">{{ __('Địa Chỉ Hiện Tại') }}</label>
                                    <input type="text" name="address" id="input-address" class="form-control form-control-alternative{{ $errors->has('address') ? ' is-invalid' : '' }}" placeholder="{{ __('Nơi ở hiện tại') }}" value="{{ old('address', auth()->user()->address) }}" required>

                                    @if ($errors->has('address'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('address') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('identify_number') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-identify">{{ __('Số CMND/CCCD') }}</label>
                                    <input type="text" name="identify_number" id="input-identify" class="form-control form-control-alternative{{ $errors->has('identify_number') ? ' is-invalid' : '' }}" placeholder="{{ __('Số CMND/CCCD') }}" value="{{ old('identify_number', auth()->user()->identify_number) }}" required>

                                    @if ($errors->has('identify_number'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('identify_number') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('home_town') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-hometown">{{ __('Quê Quán') }}</label>
                                    <input type="text" name="home_town" id="input-hometown" class="form-control form-control-alternative{{ $errors->has('home_town') ? ' is-invalid' : '' }}" placeholder="{{ __('Quê quán') }}" value="{{ old('home_town', auth()->user()->home_town) }}" required>

                                    @if ($errors->has('home_town'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('home_town') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('residence') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-residence">{{ __('Nơi Cư Trú') }}</label>
                                    <input type="text" name="residence" id="input-residence" class="form-control form-control-alternative{{ $errors->has('residence') ? ' is-invalid' : '' }}" placeholder="{{ __('Nơi cư trú') }}" value="{{ old('residence', auth()->user()->residence) }}" required>

                                    @if ($errors->has('residence'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('residence') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('phone') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-phone">{{ __('Số Điện Thoại') }}</label>
                                    <input type="text" name="phone" id="input-phone" class="form-control form-control-alternative{{ $errors->has('phone') ? ' is-invalid' : '' }}" placeholder="{{ __('Số điện thoại') }}" value="{{ old('phone', auth()->user()->phone) }}" required>

                                    @if ($errors->has('phone'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('phone') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('birthday') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-birthday">{{ __('Ngày Sinh') }}</label>
                                    <input type="text" name="birthday" data-date-format="yyyy-mm-dd" id="input-birthday" class="form-control form-control-alternative{{ $errors->has('birthday') ? ' is-invalid' : '' }} datepicker" placeholder="{{ __('Ngày sinh') }}" value="{{ old('birthday', auth()->user()->birthday) }}" required>

                                    @if ($errors->has('birthday'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('birthday') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('note') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-note">{{ __('Ghi Chú') }}</label>
                                    <input type="text" name="note" id="input-note" class="form-control form-control-alternative{{ $errors->has('note') ? ' is-invalid' : '' }}" placeholder="{{ __('Ghi chú') }}" value="{{ old('note', auth()->user()->note) }}">

                                    @if ($errors->has('note'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('note') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-success mt-4">{{ __('Save') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        @include('layouts.footers.auth')
    </div>
@endsection
