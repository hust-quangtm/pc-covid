@extends('layouts.app', ['title' => __('Chỉnh Sửa Khai Báo')])

@section('content')
    <div class="header pb-8 pt-5 pt-lg-8 d-flex align-items-center" style="background-image: url(../../argon/img/theme/profile-cover.jpg); background-size: cover; background-position: center top;">
        <!-- Mask -->
        <span class="mask bg-gradient-default opacity-8"></span>
        <!-- Header container -->
        <div class="container-fluid d-flex align-items-center">
            <div class="row">
                <div class="col-md-12 {{ $class ?? '' }}">
                    <h1 class="display-2 text-white">Xin chào {{ auth()->user()->name }}</h1>
                    <p class="text-white mt-0 mb-5">Hãy cùng chung tay đẩy lùi Covid</p>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <h3 class="mb-0">{{ __('Chỉnh Sửa Khai Báo') }}</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('update.to-khai', $data->id) }}" autocomplete="off">
                            @csrf
                            @include('layouts.messages.flash-message')
                            <div class="pl-lg-4">
                                <h6 class="heading-small text-muted mb-4">{{ __('Khai báo di chuyển nội địa') }}</h6>
                                <div class="di-chuyen-noi-dia">
                                    <div class="transportation col-12 d-flex flex-row px-0">
                                        <div class="transportation col-8 pl-0">
                                            <div class="form-group{{ $errors->has('transportations') ? ' has-danger' : '' }}">
                                                <label class="form-control-label" for="input-transportations">{{ __('Phương tiện đi lại') }}</label>
                                                <select class="form-control" id="exampleFormControlSelect1" name="transportations">
                                                    <option value="{{ $data->transportations}}" selected>{{ $data->transportations}}</option>
                                                    <option value="Cá nhân" {{$data->transportations == "Cá nhân"? 'hidden' : ''}}>Cá nhân</option>
                                                    <option value="Máy bay" {{$data->transportations == "Máy bay"? 'hidden' : ''}}>Máy bay</option>
                                                    <option value="Tàu hỏa" {{$data->transportations == "Tàu hỏa"? 'hidden' : ''}}>Tàu hỏa</option>
                                                    <option value="Xe khách" {{$data->transportations == "Xe khách"? 'hidden' : ''}}>Xe khách</option>
                                                    <option value="Tàu thuyền" {{$data->transportations == "Tàu thuyền"? 'hidden' : ''}}>Tàu thuyền</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="transportation-identify col-4 pr-0">
                                            <div class="form-group{{ $errors->has('transportations_identify') ? ' has-danger' : '' }}">
                                                <label class="form-control-label" for="input-transportations-identify">{{ __('Số hiệu phương tiện') }}</label>
                                                <input type="text" name="transportations_identify" id="input-transportations-identify" value="{{ $data->transportations_identify }}" class="form-control form-control-alternative{{ $errors->has('transportations_identify') ? ' is-invalid' : '' }}" placeholder="{{ __('Số hiệu phương tiện') }}" required autofocus>
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
                                        <input type="text" name="departure_place" id="input-departure-place" value="{{ $data->departure_place }}" class="form-control form-control-alternative{{ $errors->has('departure_place') ? ' is-invalid' : '' }}" placeholder="{{ __('Nơi xuất phat') }}" required autofocus>
                                        @if ($errors->has('departure_place'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('departure_place') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group{{ $errors->has('departure_date') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-departure-date">{{ __('Ngày khởi hành') }}</label>
                                        <input type="text" name="departure_date" data-date-format="yyyy-mm-dd" id="input-departure-date" value="{{ date_format(new DateTime($data->departure_date), 'Y-m-d') }}" class="form-control form-control-alternative{{ $errors->has('departure_date') ? ' is-invalid' : '' }} datepicker" placeholder="{{ __('Chọn ngày khởi hành') }}" required>

                                        @if ($errors->has('departure_date'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('departure_date') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group{{ $errors->has('arrival_place') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-arrival-place">{{ __('Nơi đến') }}</label>
                                        <input type="text" name="arrival_place" id="input-arrival-place" value="{{ $data->arrival_place }}" class="form-control form-control-alternative{{ $errors->has('arrival_place') ? ' is-invalid' : '' }}" placeholder="{{ __('Nơi đến') }}" required autofocus>
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
                                                <input type="radio" id="customRadioInline1" name="pass_country" class="custom-control-input" value="0" {{ $data->pass_country == "0" ? 'checked': ''}} onclick="passCountry()">
                                                <label class="custom-control-label" for="customRadioInline1">Không</label>
                                            </div>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" id="customRadioInline2" name="pass_country" class="custom-control-input" value="1" {{ $data->pass_country == "1" ? 'checked': ''}} onclick="passCountry()">
                                                <label class="custom-control-label" for="customRadioInline2">Có</label>
                                            </div>
                                        </div>
                                        <div class="form-group country-note" style="{{$data->pass_country == "1"? '' : 'display:none'}}">
                                            <textarea class="form-control pass_country_note" id="exampleFormControlTextarea1" name="pass_country_note" rows="3">{{ $data->pass_country_note }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="khai-bao-dich-te">
                                    <h6 class="heading-small text-muted mb-4">{{ __('Khai báo di dịch tễ') }}</h6>
                                    <div class="has-signal">
                                        <div class="d-flex flex-row">
                                            <h6 class="heading-small mb-4 mr-3">{{ __('Trong vòng 14 ngày qua, bạn có các biểu hiện: ho, sốt, khó thở, mệt mỏi?') }}</h6>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" id="customRadioInline3" name="has_signal" class="custom-control-input" value="0" {{ $data->has_signal == "0" ? 'checked': ''}} onclick="hasSignal()">
                                                <label class="custom-control-label" for="customRadioInline3">Không</label>
                                            </div>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" id="customRadioInline4" name="has_signal" class="custom-control-input" value="1" {{ $data->has_signal == "1" ? 'checked': ''}} onclick="hasSignal()">
                                                <label class="custom-control-label" for="customRadioInline4">Có</label>
                                            </div>
                                        </div>
                                        <div class="form-group signal-note" style="{{$data->has_signal == "1"? '' : 'display:none'}}">
                                            <textarea class="form-control signal-note" id="exampleFormControlTextarea2" name="signal_note" rows="3">{{ $data->signal_note}}</textarea>
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
                                                    <input type="radio" name="has_patient" value="1" class="ml-3" {{ $data->has_patient == "1" ? 'checked': ''}}>
                                                </td>
                                                <td style="width: 10%">
                                                    <input type="radio" name="has_patient" value="0" class="ml-3" {{ $data->has_patient == "0" ? 'checked': ''}}>
                                                </td>
                                              </tr>
                                              <tr>
                                                <th scope="row">Người từ nước có bệnh COVID-19</th>
                                                <td style="width: 10%">
                                                    <input type="radio" name="has_from_sick_country" value="1" class="ml-3" {{ $data->has_from_sick_country == "1" ? 'checked': ''}}>
                                                </td>
                                                <td style="width: 10%">
                                                    <input type="radio" name="has_from_sick_country" value="0" class="ml-3" {{ $data->has_from_sick_country == "0" ? 'checked': ''}}>
                                                </td>
                                              </tr>
                                              <tr>
                                                <th scope="row">Người có biểu hiện (Sốt, ho, khó thở, viêm phổi)</th>
                                                <td style="width: 10%">
                                                    <input type="radio" name="has_sick" value="1" class="ml-3" {{ $data->has_sick == "1" ? 'checked': ''}}>
                                                </td>
                                                <td style="width: 10%">
                                                    <input type="radio" name="has_sick" value="0" class="ml-3" {{ $data->has_sick == "0" ? 'checked': ''}}>
                                                </td>
                                              </tr>
                                            </tbody>
                                          </table>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <a type="button" class="btn btn-light mt-4" href="javascript:history.back()">{{ __('Back') }}</a>
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

