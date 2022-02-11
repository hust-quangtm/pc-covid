@extends('layouts.app', ['title' => __('Chỉnh Sửa Đăng Ký Tiêm Chủng')])

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
                            <h3 class="mb-0">{{ __('Chỉnh Sửa Đăng Ký Tiêm Chủng') }}</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('admin.tiemchung.update', $data->id) }}" autocomplete="off">
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
                                <h6 class="heading-small text-muted mb-4">{{ __('Thông Tin Đăng Ký Tiêm Chủng') }}</h6>
                                <div>
                                    <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-name">{{ __('Họ Và Tên') }}</label>
                                        <input type="text" name="name" id="input-name" class="form-control" placeholder="{{ __('Full Name') }}" value="{{ $data->user->full_name }}" readonly>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label" for="input-identify">{{ __('Số CMND/CCCD') }}</label>
                                    <input type="text" name="identify_number" id="input-identify" class="form-control" placeholder="{{ __('Số CMND/CCCD') }}" value="{{ $data->user->identify_number }}" readonly>
                                </div>
                                <label class="form-control-label" for="input-address">{{ __('Địa Chỉ Hiện Tại') }}</label>
                                <div class="col-12 d-flex flex-row">
                                    <div class="form-group col-3">
                                        <label for="city">Tỉnh / Thành</label>
                                        <select class="form-control js_location" id="city" data-type="city" name="province" disabled>
                                            <option value="">Chọn Tỉnh-Thành</option>
                                            @foreach($citys as $key => $city)
                                                <?php $is_check = true;?>
                                                @if($data->user->province == $city->id)
                                                    <?php $is_check = false;?>
                                                    <option value="{{ $city->id }}" selected>{{ $city->name }}</option>
                                                @endif
                                                @if($is_check)
                                                    <option value="{{ $city->id }}">{{ $city->name}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-3">
                                        <label for="district">Quận / Huyện</label>
                                        <select class="form-control js_location" data-type="district" id="district" name="district" disabled>
                                            <option>Chọn Quận-Huyện</option>
                                            @foreach($districts as $key => $district)
                                                @if($data->user->district == $district->id)
                                                    <option value="{{ $district->id }}" selected>{{ $district->name }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-3">
                                        <label for="wards">Xã / Phường</label>
                                        <select class="form-control" id="wards" name="ward" disabled>
                                            <option>Chọn Xã-Phường</option>
                                            @foreach($wards as $key => $ward)
                                                @if($data->user->ward == $ward->id)
                                                    <option value="{{ $ward->id }}" selected>{{ $ward->name }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-3">
                                        <label for="exampleFormControlSelect1">Địa Chỉ</label>
                                        <input type="text" name="address" id="input-address" class="form-control" placeholder="{{ __('Thôn - Xóm, Đường, Số Nhà...') }}" value="{{ $data->user->address }}" readonly>
                                    </div>
                                </div>
                                <div class="dang-ky-thong-tin">
                                    <div class="col-12 d-flex flex-row px-0">
                                        <div class="col-12 pl-0">
                                            <div class="form-group{{ $errors->has('ordinalOfInjection') ? ' has-danger' : '' }}">
                                                <label class="form-control-label" for="input-ordinalOfInjection">{{ __('Đăng ký mũi tiêm thứ') }}</label>
                                                <select class="form-control" id="exampleFormControlSelect1" name="ordinalOfInjection">
                                                    <option value="">Chọn mũi tiêm đăng ký</option>
                                                    <option value="1" {{ $data->ordinal_of_injection == 1 ? 'selected' : ''}}>Mũi Tiêm Thứ 1</option>
                                                    <option value="2" {{ $data->ordinal_of_injection == 2 ? 'selected' : ''}}>Mũi Tiêm Tiếp Theo </option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 d-flex flex-row px-0">
                                        <div class="col-8 pl-0">
                                            <div class="form-group{{ $errors->has('dateOfInjectionRegister') ? ' has-danger' : '' }}">
                                                <label class="form-control-label" for="input-departure-date">{{ __('Ngày Tiêm Dự Kiến') }}</label>
                                                <input type="text" name="dateOfInjectionRegister" value="{{ date_format(new DateTime($data->date_of_injection_register), 'Y-m-d') }}" data-date-format="yyyy-mm-dd" class="form-control form-control-alternative{{ $errors->has('dateOfInjectionRegister') ? ' is-invalid' : '' }} datepicker" placeholder="{{ __('Chọn ngày mong muốn để tiêm') }}" readonly>
                                                @if ($errors->has('dateOfInjectionRegister'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('dateOfInjectionRegister') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-4 pl-0">
                                            <div class="form-group{{ $errors->has('partOfInjectionDay') ? ' has-danger' : '' }}">
                                                <label class="form-control-label" for="input-partOfInjectionDay">{{ __('Buổi Tiêm Mong Muốn') }}</label>
                                                <select class="form-control" id="" name="partOfInjectionDay">
                                                    <option value="">Chọn buổi tiêm mong muốn</option>
                                                    <option value="Buổi Sáng" {{ $data->part_of_injection_day == "Buổi Sáng" ? 'selected' : ''}}>Buổi Sáng</option>
                                                    <option value="Buổi Chiều" {{ $data->part_of_injection_day == "Buổi Chiều" ? 'selected' : ''}}>Buổi Chiều</option>
                                                    <option value="Cả Ngày" {{ $data->part_of_injection_day == "Cả Ngày" ? 'selected' : ''}}>Cả Ngày</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 d-flex flex-row px-0">
                                        <div class="col-4 pl-0">
                                            <div class="form-group{{ $errors->has('dateOfInjection') ? ' has-danger' : '' }}">
                                                <label class="form-control-label" for="input-departure-date">{{ __('Ngày Tiêm') }}</label>
                                                <input type="text" name="dateOfInjection" value="{{ date_format(new DateTime($data->date_of_injection), 'Y-m-d') }}" data-date-format="yyyy-mm-dd" class="form-control form-control-alternative{{ $errors->has('dateOfInjectionRegister') ? ' is-invalid' : '' }} datepicker" placeholder="{{ __('Chọn ngày mong muốn để tiêm') }}" required>
                                                @if ($errors->has('dateOfInjection'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('dateOfInjection') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-8 pl-0">
                                            <div class="form-group{{ $errors->has('partOfInjectionDay') ? ' has-danger' : '' }}">
                                                <label class="form-control-label" for="input-partOfInjectionDay">{{ __('Địa Điểm Tiêm Chủng') }}</label>
                                                <input type="text" name="injection_address" id="input-address" class="form-control" placeholder="{{ __('Địa chỉ được sắp xếp tiêm chủng') }}" value="{{ $data->injection_address }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group{{ $errors->has('priorityGroup') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-ordinalOfInjection">{{ __('Nhóm Ưu Tiên') }}</label>
                                        <select class="form-control" id="exampleFormControlSelect1" name="priorityGroup" required>
                                            <option value="">Lựa chọn nhóm đối tượng phù hợp với bạn</option>
                                            <option value="1" {{ $data->priority_group == 1 ? 'selected' : ''}}>1. Người làm việc trong các cơ sở y tế, ngành y tế (công lập và tư nhân)</option>
                                            <option value="2" {{ $data->priority_group == 2 ? 'selected' : ''}}>2. Người tham gia phòng chống dịch</option>
                                            <option value="3" {{ $data->priority_group == 3 ? 'selected' : ''}}>3. Lực lượng Quân đội</option>
                                            <option value="4" {{ $data->priority_group == 4 ? 'selected' : ''}}>4. Lực lượng Công an</option>
                                            <option value="5" {{ $data->priority_group == 5 ? 'selected' : ''}}>5. Nhân viên, cán bộ ngoại giao của Việt Nam. Lãnh sự, các tổ chức quốc tế hoạt động tại Việt Nam</option>
                                            <option value="6" {{ $data->priority_group == 6 ? 'selected' : ''}}>6. Hải quan, cán bộ công tác xuất nhập cảnh</option>
                                            <option value="7" {{ $data->priority_group == 7 ? 'selected' : ''}}>7. Người cung cấp dịch vụ thiết yếu: hàng không, vận tải, du lịch; Cung cấp dịch vụ điện, nước</option>
                                            <option value="8" {{ $data->priority_group == 8 ? 'selected' : ''}}>8. Giáo viên, học sinh, sinh viên, nhân viên, người lao động,... thường xuyên tiếp xúc với nhiều người</option>
                                            <option value="9" {{ $data->priority_group == 9 ? 'selected' : ''}}>9. Người mắc bệnh mãn tính; Người trên 65 tuổi</option>
                                            <option value="10" {{ $data->priority_group == 10 ? 'selected' : ''}}>10. Người sinh sống tại vùng có dịch</option>
                                            <option value="11" {{ $data->priority_group == 11 ? 'selected' : ''}}>11. Người nghèo, các đối tượng chính sách xã hội</option>
                                            <option value="12" {{ $data->priority_group == 12 ? 'selected' : ''}}>12. Người được nhà nước cử đi hoặc có nhu cầu đi công tác, học tập, lao động tại nước ngoài; Chuyên gia nước ngoài làm việc tại Việt Nam</option>
                                            <option value="13" {{ $data->priority_group == 13 ? 'selected' : ''}}>13. Người lao động, thân nhân người lao động làm việc tại các doanh nghiệp, cơ sở kinh doanh dịch vụ thiết yếu, khu du lịch</option>
                                            <option value="14" {{ $data->priority_group == 14 ? 'selected' : ''}}>14. Các chức sắc, chức việc tôn giáo</option>
                                            <option value="15" {{ $data->priority_group == 15 ? 'selected' : ''}}>15. Người lao động tự do</option>
                                            <option value="16" {{ $data->priority_group == 16 ? 'selected' : ''}}>16. Đối tượng khác theo Quyết định của Bộ trưởng Bộ Y tế hoặc chủ tịch UBND tỉnh, thành phố và đề xuất của các đơn vị viện trợ tiêm vac-xin </option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-ordinalOfInjection">{{ __('Ghi chú') }}</label>
                                        <textarea class="form-control" id="" name="note" rows="3" placeholder="Ghi chú: phản ứng sau tiêm (nếu có), lịch sử dịch tễ, tiền sử bệnh lý">{{ $data->note }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-control-label">{{ __('Trạng Thái') }}</label>
                                        <select class="form-control" name="status" required>
                                            <option value="Đang Xử Lý" {{ $data->status == "Đang Xử Lý" ? 'selected' : ''}}>Đang Xử Lý</option>
                                            <option value="Chờ Tiêm" {{ $data->status == "Chờ Tiêm" ? 'selected' : ''}}>Chờ Tiêm</option>
                                            <option value="Đã Tiêm Xong" {{ $data->status == "Đã Tiêm Xong" ? 'selected' : ''}}>Đã Tiêm Xong</option>
                                            <option value="Hủy" {{ $data->status == "Hủy" ? 'selected' : ''}}>Hủy</option>
                                        </select>
                                    </div>
                                    <div>
                                        <h4 class="text-danger"><strong>Lưu ý:</strong><br></h4>
                                        <h5 class="text-danger ml-3"><strong>・ Việc đăng ký thông tin hoàn toàn bảo mật và phục vụ cho chiến dịch tiêm chủng Vắc xin COVID - 19</strong><br></h5>
                                        <h5 class="text-danger ml-3"><strong>・ Bằng việc nhấn nút "Đăng Ký", bạn hoàn toàn hiểu và đồng ý chịu trách nhiệm với các thông tin đã cung cấp.</strong></h5>
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
