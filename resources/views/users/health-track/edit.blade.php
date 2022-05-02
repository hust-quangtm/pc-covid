@extends('layouts.app', ['title' => __('Chỉnh Sửa Theo Dõi Sức Khỏe')])

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
                            <h3 class="mb-0">{{ __('Chỉnh Sửa Theo Dõi Sức Khỏe') }}</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('health-track.update', $data->id) }}" autocomplete="off">
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
                                <h6 class="heading-small text-muted mb-4">{{ __('Thông Tin Khai Báo Sức Khỏe') }}</h6>
                                <div class="edit-information">
                                    <div class="col-12 d-flex flex-row px-0">
                                        <div class="col-8 pl-0">
                                            <div class="form-group{{ $errors->has('declaration_date') ? ' has-danger' : '' }}">
                                                <label class="form-control-label" for="input-declaration_date">{{ __('Ngày Khai Báo') }}</label>
                                                <input type="text" name="declaration_date" value="{{ date_format(new DateTime($data->declaration_date), 'Y-m-d') }}" data-date-format="yyyy-mm-dd" class="form-control form-control-alternative{{ $errors->has('dateOfInjectionRegister') ? ' is-invalid' : '' }} datepicker" required readonly>
                                                @if ($errors->has('declaration_date'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('declaration_date') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-4 pl-0">
                                            <div class="form-group{{ $errors->has('session_of_day') ? ' has-danger' : '' }}">
                                                <label class="form-control-label" for="input-session_of_day">{{ __('Buổi Khai Báo (Sáng / Chiều)') }}</label>
                                                <select class="form-control" name="session_of_day" required>
                                                    <option value="">Chọn buổi khai báo</option>p
                                                    <option value="Buổi Sáng" {{ $data->session_of_day == "Buổi Sáng" ? 'selected' : ''}}>Buổi Sáng</option>
                                                    <option value="Buổi Chiều" {{ $data->session_of_day == "Buổi Chiều" ? 'selected' : ''}}>Buổi Chiều</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-pulse">{{ __('Mạch (Lần/phút)') }}</label>
                                        <input type="text" name="pulse" class="form-control" value="{{ $data->pulse }}">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-daily_temperature">{{ __('Nhiệt độ hằng ngày (độ C)') }}</label>
                                        <input type="text" class="form-control" name="daily_temperature" value="{{ $data->daily_temperature }}">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-breathing_rate">{{ __('Nhịp thở') }}</label>
                                        <input class="form-control" type="text" name="breathing_rate" value="{{ $data->breathing_rate }}">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-spo2">{{ __('SpO2') }}</label>
                                        <input type="text" class="form-control" name="spo2" value="{{ $data->spo2 }}">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-maximum_blood_pressure">{{ __('Huyết áp tối đa (mmhg)') }}</label>
                                        <input type="text" class="form-control" name="maximum_blood_pressure" value="{{ $data->maximum_blood_pressure }}">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-minimum_blood_pressure">{{ __('Huyết áp tối thiểu (mmhg)') }}</label>
                                        <input type="text" class="form-control" name="minimum_blood_pressure" value="{{ $data->minimum_blood_pressure }}">
                                    </div>
                                    <div class="form-group">
                                        <div class="d-flex flex-row">
                                            <h6 class="heading-small mb-4 mr-3">{{ __('Không Triệu Chứng Khác') }}</h6>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" id="no-symptom" name="no_symptoms" class="custom-control-input" value="0" {{ $data->no_symptoms == "0" ? 'checked': ''}} onclick="symptomCheck ()">
                                                <label class="custom-control-label" for="no-symptom">Không Triệu Chứng</label>
                                            </div>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" id="has-symptom" name="no_symptoms" class="custom-control-input" value="1" {{ $data->no_symptoms == "1" ? 'checked': ''}} onclick="symptomCheck ()">
                                                <label class="custom-control-label" for="has-symptom">Có Triệu Chứng Khác</label>
                                            </div>
                                        </div>
                                        <div class="form-group" id="symptoms" style="{{$data->no_symptoms == "0"? 'display:none' : ''}}">
                                            <div>
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
                                                        <th scope="row">Mệt Mỏi</th>
                                                        <td style="width: 10%">
                                                            <input type="radio" name="tired" value="1" class="ml-3" {{ $data->tired == "1" ? 'checked': ''}}>
                                                        </td>
                                                        <td style="width: 10%">
                                                            <input type="radio" name="tired" value="0" class="ml-3" {{ $data->tired == "0" ? 'checked': ''}}>
                                                        </td>
                                                      </tr>
                                                      <tr>
                                                        <th scope="row">Ho</th>
                                                        <td style="width: 10%">
                                                            <input type="radio" name="cough" value="1" class="ml-3" {{ $data->cough == "1" ? 'checked': ''}}>
                                                        </td>
                                                        <td style="width: 10%">
                                                            <input type="radio" name="cough" value="0" class="ml-3" {{ $data->cough == "0" ? 'checked': ''}}>
                                                        </td>
                                                      </tr>
                                                      <tr>
                                                        <th scope="row">Ho ra đờm</th>
                                                        <td style="width: 10%">
                                                            <input type="radio" name="productive_cough" value="1" class="ml-3" {{ $data->productive_cough == "1" ? 'checked': ''}}>
                                                        </td>
                                                        <td style="width: 10%">
                                                            <input type="radio" name="productive_cough" value="0" class="ml-3" {{ $data->productive_cough == "0" ? 'checked': ''}}>
                                                        </td>
                                                      </tr>
                                                      <tr>
                                                        <th scope="row">Ớn lạnh/gai rét</th>
                                                        <td style="width: 10%">
                                                            <input type="radio" name="chills" value="1" class="ml-3" {{ $data->chills == "1" ? 'checked': ''}}>
                                                        </td>
                                                        <td style="width: 10%">
                                                            <input type="radio" name="chills" value="0" class="ml-3" {{ $data->chills == "0" ? 'checked': ''}}>
                                                        </td>
                                                      </tr>
                                                      <tr>
                                                        <th scope="row">Viêm kết mạc (mắt đỏ)</th>
                                                        <td style="width: 10%">
                                                            <input type="radio" name="conjuntivitis" value="1" class="ml-3" {{ $data->conjuntivitis == "1" ? 'checked': ''}}>
                                                        </td>
                                                        <td style="width: 10%">
                                                            <input type="radio" name="conjuntivitis" value="0" class="ml-3" {{ $data->conjuntivitis == "0" ? 'checked': ''}}>
                                                        </td>
                                                      </tr>
                                                      <tr>
                                                        <th scope="row">Mất vị giác hoặc khứu giác</th>
                                                        <td style="width: 10%">
                                                            <input type="radio" name="loss_of_taste_or_smell" value="1" class="ml-3" {{ $data->loss_of_taste_or_smell == "1" ? 'checked': ''}}>
                                                        </td>
                                                        <td style="width: 10%">
                                                            <input type="radio" name="loss_of_taste_or_smell" value="0" class="ml-3" {{ $data->loss_of_taste_or_smell == "0" ? 'checked': ''}}>
                                                        </td>
                                                      </tr>
                                                      <tr>
                                                        <th scope="row">Tiêu chảy (phân lỏng / đi ngoài)</th>
                                                        <td style="width: 10%">
                                                            <input type="radio" name="diarrhea" value="1" class="ml-3" {{ $data->diarrhea == "1" ? 'checked': ''}}>
                                                        </td>
                                                        <td style="width: 10%">
                                                            <input type="radio" name="diarrhea" value="0" class="ml-3" {{ $data->diarrhea == "0" ? 'checked': ''}}>
                                                        </td>
                                                      </tr>
                                                      <tr>
                                                        <th scope="row">Ho ra máu</th>
                                                        <td style="width: 10%">
                                                            <input type="radio" name="hemoptisi" value="1" class="ml-3" {{ $data->hemoptisi == "1" ? 'checked': ''}}>
                                                        </td>
                                                        <td style="width: 10%">
                                                            <input type="radio" name="hemoptisi" value="0" class="ml-3" {{ $data->hemoptisi == "0" ? 'checked': ''}}>
                                                        </td>
                                                      </tr>
                                                      <tr>
                                                        <th scope="row">Thở dốc hoặc khó thở</th>
                                                        <td style="width: 10%">
                                                            <input type="radio" name="difficulty_breathing" value="1" class="ml-3" {{ $data->difficulty_breathing == "1" ? 'checked': ''}}>
                                                        </td>
                                                        <td style="width: 10%">
                                                            <input type="radio" name="difficulty_breathing" value="0" class="ml-3" {{ $data->difficulty_breathing == "0" ? 'checked': ''}}>
                                                        </td>
                                                      </tr>
                                                      <tr>
                                                        <th scope="row">Đau tức ngực kéo dài</th>
                                                        <td style="width: 10%">
                                                            <input type="radio" name="chest_tightness" value="1" class="ml-3" {{ $data->chest_tightness == "1" ? 'checked': ''}}>
                                                        </td>
                                                        <td style="width: 10%">
                                                            <input type="radio" name="chest_tightness" value="0" class="ml-3" {{ $data->chest_tightness == "0" ? 'checked': ''}}>
                                                        </td>
                                                      </tr>
                                                      <tr>
                                                        <th scope="row">Lơ mơ, không tỉnh táo</th>
                                                        <td style="width: 10%">
                                                            <input type="radio" name="not_awake" value="1" class="ml-3" {{ $data->not_awake == "1" ? 'checked': ''}}>
                                                        </td>
                                                        <td style="width: 10%">
                                                            <input type="radio" name="not_awake" value="0" class="ml-3" {{ $data->not_awake == "0" ? 'checked': ''}}>
                                                        </td>
                                                      </tr>
                                                    </tbody>
                                                  </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-note">{{ __('Ghi chú:') }}</label>
                                        <input type="text" class="form-control" name="note" value="{{ $data->note }}" placeholder="Các triệu chứng khác...">
                                    </div>
                                    @if(auth()->user()->hasRole('admin') || auth()->user()->hasRole('ward') || auth()->user()->hasRole('district') || auth()->user()->hasRole('province'))
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-doctor_note">{{ __('Ghi chú của nhân viên y tế:') }}</label>
                                            <input type="text" class="form-control" name="doctor_note" value="{{ $data->doctor_note }}" placeholder="Các triệu chứng khác...">
                                        </div>
                                    @endif
                                    <div>
                                        <h4 class="text-danger"><strong>Lưu ý:</strong><br></h4>
                                        <h5 class="text-danger ml-3"><strong>・ Việc khai báo thông tin hoàn toàn bảo mật và phục vụ cho việc theo dõi tình trạng COVID - 19</strong><br></h5>
                                        <h5 class="text-danger ml-3"><strong>・ Bằng việc nhấn nút "Cập Nhật", bạn hoàn toàn hiểu và đồng ý chịu trách nhiệm với các thông tin đã cung cấp.</strong></h5>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-success mt-4">{{ __('Cập Nhật') }}</button>
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
@section('script')
    <script type="text/javascript">
        function symptomCheck () {
            var has_symptom = $('#has-symptom').is(':checked');
            var no_symptom = $('#no-symptom').is(':checked');
            if (has_symptom) {
                $('#symptoms').show();
            } else if (no_symptom) {
                $('#symptoms').hide();
            }
        }
    </script>
@endsection
