@extends('layouts.app', ['title' => __('Đăng Ký Tiêm Chủng')])

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
                            <h3 class="mb-0">{{ __('Đăng Ký Tiêm Chủng') }}</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('store.tiem-chung') }}" autocomplete="off">
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
                                <div class="dang-ky-thong-tin">
                                    <div class="col-12 d-flex flex-row px-0">
                                        <div class="col-12 pl-0">
                                            <div class="form-group{{ $errors->has('ordinalOfInjection') ? ' has-danger' : '' }}">
                                                <label class="form-control-label" for="input-ordinalOfInjection">{{ __('Đăng ký mũi tiêm thứ') }}</label>
                                                <select class="form-control" id="exampleFormControlSelect1" name="ordinalOfInjection" required>
                                                    <option value="">Chọn mũi tiêm đăng ký</option>
                                                    <option value="1">Mũi Tiêm Thứ 1</option>
                                                    <option value="2">Mũi Tiêm Tiếp Theo </option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 d-flex flex-row px-0">
                                        <div class="col-8 pl-0">
                                            <div class="form-group{{ $errors->has('dateOfInjectionRegister') ? ' has-danger' : '' }}">
                                                <label class="form-control-label" for="input-departure-date">{{ __('Ngày Tiêm Dự Kiến') }}</label>
                                                <input type="text" name="dateOfInjectionRegister" data-date-format="yyyy-mm-dd" class="form-control form-control-alternative{{ $errors->has('dateOfInjectionRegister') ? ' is-invalid' : '' }} datepicker" placeholder="{{ __('Chọn ngày mong muốn để tiêm') }}" required>
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
                                                <select class="form-control" id="" name="partOfInjectionDay" required>
                                                    <option value="">Chọn buổi tiêm mong muốn</option>p
                                                    <option value="Buổi Sáng">Buổi Sáng</option>
                                                    <option value="Buổi Chiều">Buổi Chiều</option>
                                                    <option value="Cả Ngày">Cả Ngày</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group{{ $errors->has('priorityGroup') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-ordinalOfInjection">{{ __('Nhóm Ưu Tiên') }}</label>
                                        <select class="form-control" id="exampleFormControlSelect1" name="priorityGroup" required>
                                            <option value="">Lựa chọn nhóm đối tượng phù hợp với bạn</option>
                                            <option value="1">1. Người làm việc trong các cơ sở y tế, ngành y tế (công lập và tư nhân)</option>
                                            <option value="2">2. Người tham gia phòng chống dịch</option>
                                            <option value="3">3. Lực lượng Quân đội</option>
                                            <option value="4">4. Lực lượng Công an</option>
                                            <option value="5">5. Nhân viên, cán bộ ngoại giao của Việt Nam. Lãnh sự, các tổ chức quốc tế hoạt động tại Việt Nam</option>
                                            <option value="6">6. Hải quan, cán bộ công tác xuất nhập cảnh</option>
                                            <option value="7">7. Người cung cấp dịch vụ thiết yếu: hàng không, vận tải, du lịch; Cung cấp dịch vụ điện, nước</option>
                                            <option value="8">8. Giáo viên, học sinh, sinh viên, nhân viên, người lao động,... thường xuyên tiếp xúc với nhiều người</option>
                                            <option value="9">9. Người mắc bệnh mãn tính; Người trên 65 tuổi</option>
                                            <option value="10">10. Người sinh sống tại vùng có dịch</option>
                                            <option value="11">11. Người nghèo, các đối tượng chính sách xã hội</option>
                                            <option value="12">12. Người được nhà nước cử đi hoặc có nhu cầu đi công tác, học tập, lao động tại nước ngoài; Chuyên gia nước ngoài làm việc tại Việt Nam</option>
                                            <option value="13">13. Người lao động, thân nhân người lao động làm việc tại các doanh nghiệp, cơ sở kinh doanh dịch vụ thiết yếu, khu du lịch</option>
                                            <option value="14">14. Các chức sắc, chức việc tôn giáo</option>
                                            <option value="15">15. Người lao động tự do</option>
                                            <option value="16">16. Đối tượng khác theo Quyết định của Bộ trưởng Bộ Y tế hoặc chủ tịch UBND tỉnh, thành phố và đề xuất của các đơn vị viện trợ tiêm vac-xin </option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-ordinalOfInjection">{{ __('Ghi chú') }}</label>
                                        <textarea class="form-control" id="" name="note" rows="3" placeholder="Ghi chú: phản ứng sau tiêm (nếu có), lịch sử dịch tễ, tiền sử bệnh lý"></textarea>
                                    </div>
                                    <div>
                                        <h4 class="text-danger"><strong>Lưu ý:</strong><br></h4>
                                        <h5 class="text-danger ml-3"><strong>・ Việc đăng ký thông tin hoàn toàn bảo mật và phục vụ cho chiến dịch tiêm chủng Vắc xin COVID - 19</strong><br></h5>
                                        <h5 class="text-danger ml-3"><strong>・ Bằng việc nhấn nút "Đăng Ký", bạn hoàn toàn hiểu và đồng ý chịu trách nhiệm với các thông tin đã cung cấp.</strong></h5>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-success mt-4">{{ __('Đăng Ký') }}</button>
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
