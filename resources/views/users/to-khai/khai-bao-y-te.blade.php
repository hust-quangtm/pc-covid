@extends('layouts.app', ['title' => __('Khai Báo Y Tế')])

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
                            <h3 class="mb-0">{{ __('Khai Báo Y Tế') }}</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('store.khai-bao') }}" autocomplete="off">
                            @csrf

                            @if (session('status'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('status') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif

                            <div class="pl-lg-4">
                                <h6 class="heading-small text-muted mb-4">{{ __('Khai báo di chuyển nội địa') }}</h6>
                                <div class="di-chuyen-noi-dia">
                                    <div class="transportation col-12 d-flex flex-row px-0">
                                        <div class="transportation col-8 pl-0">
                                            <div class="form-group{{ $errors->has('transportations') ? ' has-danger' : '' }}">
                                                <label class="form-control-label" for="input-transportations">{{ __('Phương tiện đi lại') }}</label>
                                                <select class="form-control" id="exampleFormControlSelect1" name="transportations">
                                                    <option value="Cá nhân">Cá nhân</option>
                                                    <option value="Máy bay">Máy bay</option>
                                                    <option value="Tàu hỏa">Tàu hỏa</option>
                                                    <option value="Xe khách">Xe khách</option>
                                                    <option value="Tàu thuyền">Tàu thuyền</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="transportation-identify col-4 pr-0">
                                            <div class="form-group{{ $errors->has('transportations_identify') ? ' has-danger' : '' }}">
                                                <label class="form-control-label" for="input-transportations-identify">{{ __('Số hiệu phương tiện') }}</label>
                                                <input type="text" name="transportations_identify" id="input-transportations-identify" class="form-control form-control-alternative{{ $errors->has('transportations_identify') ? ' is-invalid' : '' }}" placeholder="{{ __('Số hiệu phương tiện') }}" required autofocus>
                                                @if ($errors->has('transportations_identify'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('transportations_identify') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group{{ $errors->has('departure_place') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-departure-place">{{ __('Nơi đi') }}</label>
                                        <input type="text" name="departure_place" id="input-departure-place" class="form-control form-control-alternative{{ $errors->has('departure_place') ? ' is-invalid' : '' }}" placeholder="{{ __('Nơi xuất phat') }}" required autofocus>
                                        @if ($errors->has('departure_place'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('departure_place') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group{{ $errors->has('departure_date') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-departure-date">{{ __('Ngày khởi hành') }}</label>
                                        <input type="text" name="departure_date" data-date-format="yyyy-mm-dd" id="input-departure-date" class="form-control form-control-alternative{{ $errors->has('departure_date') ? ' is-invalid' : '' }} datepicker" placeholder="{{ __('Chọn ngày khởi hành') }}" required>

                                        @if ($errors->has('departure_date'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('departure_date') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group{{ $errors->has('arrival_place') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-arrival-place">{{ __('Nơi đến') }}</label>
                                        <input type="text" name="arrival_place" id="input-arrival-place" class="form-control form-control-alternative{{ $errors->has('arrival_place') ? ' is-invalid' : '' }}" placeholder="{{ __('Nơi đến') }}" required autofocus>
                                        @if ($errors->has('arrival_place'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('arrival_place') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="pass-country">
                                        <div class="d-flex flex-row">
                                            <h6 class="heading-small mb-4 mr-3">{{ __('Trong vòng 14 ngày qua, bạn có tới quốc gia/vùng lãnh thổ nào?') }}</h6>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" id="customRadioInline1" name="pass_country" class="custom-control-input" value="0" checked="checked" onclick="passCountry()">
                                                <label class="custom-control-label" for="customRadioInline1">Không</label>
                                            </div>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" id="customRadioInline2" name="pass_country" class="custom-control-input" value="1" onclick="passCountry()">
                                                <label class="custom-control-label" for="customRadioInline2">Có</label>
                                            </div>
                                        </div>
                                        <div class="form-group country-note" style="display: none">
                                            <textarea class="form-control pass_country_note" id="exampleFormControlTextarea1" name="pass_country_note" rows="3"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="khai-bao-dich-te">
                                    <h6 class="heading-small text-muted mb-4">{{ __('Khai báo di dịch tễ') }}</h6>
                                    <div class="has-signal">
                                        <div class="d-flex flex-row">
                                            <h6 class="heading-small mb-4 mr-3">{{ __('Trong vòng 14 ngày qua, bạn có các biểu hiện: ho, sốt, khó thở, mệt mỏi?') }}</h6>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" id="customRadioInline3" name="has_signal" class="custom-control-input" value="0" checked="checked" onclick="hasSignal()">
                                                <label class="custom-control-label" for="customRadioInline3">Không</label>
                                            </div>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" id="customRadioInline4" name="has_signal" class="custom-control-input" value="1" onclick="hasSignal()">
                                                <label class="custom-control-label" for="customRadioInline4">Có</label>
                                            </div>
                                        </div>
                                        <div class="form-group signal-note" style="display: none">
                                            <textarea class="form-control signal-note" id="exampleFormControlTextarea2" name="signal_note" rows="3"></textarea>
                                        </div>
                                    </div>
                                    <div>
                                        <h6 class="heading-small mb-4 mr-3">{{ __('Trong vòng 14 ngày qua, bạn có tiếp xúc với:') }}</h6>
                                        <table class="table table-bordered">
                                            <thead>
                                              <tr>
                                                <th scope="col"></th>
                                                <th scope="col" style="width: 10%" class="text-center">Có</th>
                                                <th scope="col" style="width: 10%" class="text-center">Không</th>
                                              </tr>
                                            </thead>
                                            <tbody>
                                              <tr>
                                                <th scope="row">Người bệnh tật hoặc nghi ngờ, mắc bệnh COVID-19</th>
                                                <td style="width: 10%">
                                                    <input type="radio" name="has_patient" value="1" class="ml-3">
                                                </td>
                                                <td style="width: 10%">
                                                    <input type="radio" name="has_patient" value="0" class="ml-3" checked>
                                                </td>
                                              </tr>
                                              <tr>
                                                <th scope="row">Người từ nước có bệnh COVID-19</th>
                                                <td style="width: 10%">
                                                    <input type="radio" name="has_from_sick_country" value="1" class="ml-3">
                                                </td>
                                                <td style="width: 10%">
                                                    <input type="radio" name="has_from_sick_country" value="0" class="ml-3" checked>
                                                </td>
                                              </tr>
                                              <tr>
                                                <th scope="row">Người có biểu hiện (Sốt, ho, khó thở, viêm phổi)</th>
                                                <td style="width: 10%">
                                                    <input type="radio" name="has_sick" value="1" class="ml-3">
                                                </td>
                                                <td style="width: 10%">
                                                    <input type="radio" name="has_sick" value="0" class="ml-3" checked>
                                                </td>
                                              </tr>
                                            </tbody>
                                          </table>
                                    </div>
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
@push('js')
    <script type="text/javascript">
        passCountry();
        hasSignal();
    </script>
@endpush

