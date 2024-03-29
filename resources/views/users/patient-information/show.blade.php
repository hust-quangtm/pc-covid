@extends('layouts.app', ['title' => __('Yêu Cầu Xác Nhận Dương Tính')])

@section('content')
    @include('users.partials.header', [
        'title' => __('Xin chào') . ' '. auth()->user()->name,
        'description' => __('Hãy cùng chung tay đẩy lùi Covid'),
        'class' => 'col-lg-12'
    ])

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                @include('layouts.messages.flash-message');
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <h3 class="mb-0">{{ __('Yêu Cầu Xác Nhận Dương Tính') }}</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="pl-lg-4">
                            <h6 class="heading-small text-muted mb-4">{{ __('Thông Tin Khai Báo') }}</h6>
                            <div class="edit-information">
                                <div class="col-12 pl-0">
                                    <div class="form-group{{ $errors->has('declaration_date') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-declaration_date">{{ __('Ngày Khai Báo') }}</label>
                                        <input type="text" name="declaration_date" data-date-format="yyyy-mm-dd" value="{{ $data->declaration_date ? date_format(new DateTime($data->declaration_date), 'Y-m-d') : ''}}" class="form-control form-control-alternative{{ $errors->has('dateOfInjectionRegister') ? ' is-invalid' : '' }} datepicker" required>
                                        @if ($errors->has('declaration_date'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('declaration_date') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-12 pl-0">
                                    <div class="form-group{{ $errors->has('proof_of_image') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-proof_of_image">{{ __('Hình Ảnh Minh Chứng') }}</label>
                                        <input type="file" name="proof_of_image" class="form-control" value="{{$data->proof_of_image}}">
                                        <div class="proof_of_image mt-3">
                                            <img src="{{ asset($data->proof_of_image) }}" class="img-fluid img-thumbnail" alt="f0_proof_of_image" style="">
                                        </div>
                                        @if ($errors->has('proof_of_image'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('proof_of_image') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-12 pl-0">
                                    <div class="form-group{{ $errors->has('expected_schedule') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-declaration_date">{{ __('Thời gian dự kiến tham gia test dưới sự dám sát của nhân viên y tế:') }}</label>
                                        <input type="text" name="expected_schedule" data-date-format="yyyy-mm-dd" value="{{ $data->expected_schedule ? date_format(new DateTime($data->expected_schedule), 'Y-m-d') : ''}}" class="form-control form-control-alternative{{ $errors->has('dateOfInjectionRegister') ? ' is-invalid' : '' }} datepicker" required>
                                        @if ($errors->has('expected_schedule'))
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('expected_schedule') }}</strong>
                                                </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label" for="input-note">{{ __('Ghi chú:') }}</label>
                                    <input type="text" class="form-control" name="note" placeholder="Ghi chú khác của người bệnh" value="{{ $data->note }}">
                                </div>
                            </div>
                            <div class="card bg-secondary shadow mt-5">
                                <div class="card-header bg-white border-0">
                                    <div class="row align-items-center">
                                        <h3 class="mb-0">{{ __('Xác Nhận Của Nhân Viên Y Tế') }}</h3>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="col-12 pl-0">
                                        <div class="form-group{{ $errors->has('confirm_status') ? ' has-danger' : '' }}">
                                            <label class="form-control-label" for="input-confirm_status">{{ __('Xác Nhận Của Nhân Viên Y Tế') }}</label>
                                            <select class="form-control" id="confirm_status" name="confirm_status">
                                                <option value="not_checked">Chọn Trạng Thái</option>
                                                <option value="infected" {{$data->confirm_status == 'infected' ? 'selected' : ''}}>Dương Tính Covid 19</option>
                                                <option value="not_infected" {{$data->confirm_status == 'not_infected' ? 'selected' : ''}}>Âm Tính Với Covid 19</option>
                                                <option value="cannot_proof" {{$data->confirm_status == 'cannot_proof' ? 'selected' : ''}}>Chưa Đủ Điều Kiện Để Xác Minh</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 pl-0">
                                        <div class="form-group{{ $errors->has('proof_schedule') ? ' has-danger' : '' }}">
                                            <label class="form-control-label" for="input-proof_schedule">{{ __('Thời Gian Hẹn Test Trực Tuyến') }}</label>
                                            <input type="text" name="proof_schedule" data-date-format="yyyy-mm-dd" value="{{ $data->proof_schedule ? date_format(new DateTime($data->proof_schedule), 'Y-m-d') : ''}}" class="form-control datepicker">
                                            @if ($errors->has('proof_schedule'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('proof_schedule') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-12 pl-0">
                                        <div class="form-group{{ $errors->has('infected_day') ? ' has-danger' : '' }}">
                                            <label class="form-control-label" for="input-infected_day">{{ __('Ngày Nhiễm Bệnh') }}</label>
                                            <input type="text" name="infected_day" data-date-format="yyyy-mm-dd" value="{{ $data->infected_day ? date_format(new DateTime($data->infected_day), 'Y-m-d') : ''}}" class="form-control datepicker">
                                            @if ($errors->has('infected_day'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('infected_day') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-12 pl-0">
                                        <div class="form-group{{ $errors->has('recovery_day') ? ' has-danger' : '' }}">
                                            <label class="form-control-label" for="input-recovery_day">{{ __('Ngày Khỏi Bệnh') }}</label>
                                            <input type="text" name="recovery_day" data-date-format="yyyy-mm-dd" value="{{ $data->recovery_day ? date_format(new DateTime($data->recovery_day), 'Y-m-d') : ''}}" class="form-control datepicker">
                                            @if ($errors->has('recovery_day'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('recovery_day') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center">
                                <a class="btn btn-info mt-4" href="{{ route('check-patient.index') }}">{{ __('Trở Lại') }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.footers.auth')
    </div>
@endsection
