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
                            <h3 class="mb-0">{{ __('Yêu Cầu Xác Nhận Dương Tính Với CoVid19') }}</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('check-patient.store') }}" autocomplete="off" enctype="multipart/form-data">
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
                                <h6 class="heading-small text-muted mb-4">{{ __('Thông Tin Khai Báo') }}</h6>
                                <div class="edit-information">
                                    <div class="col-12 pl-0">
                                        <div class="form-group{{ $errors->has('declaration_date') ? ' has-danger' : '' }}">
                                            <label class="form-control-label" for="input-declaration_date">{{ __('Ngày Khai Báo') }}</label>
                                            <input type="text" name="declaration_date" data-date-format="yyyy-mm-dd" class="form-control form-control-alternative{{ $errors->has('dateOfInjectionRegister') ? ' is-invalid' : '' }} datepicker" required>
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
                                            <input type="file" name="proof_of_image" class="form-control" required>
                                            @if ($errors->has('proof_of_image'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('proof_of_image') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-note">{{ __('Ghi chú:') }}</label>
                                        <input type="text" class="form-control" name="note" placeholder="Ghi chú khác của người bệnh">
                                    </div>
                                    <div>
                                        <h4 class="text-danger"><strong>Lưu ý:</strong><br></h4>
                                        <h5 class="text-danger ml-3"><strong>・ Việc khai báo thông tin hoàn toàn bảo mật và phục vụ cho việc theo dõi tình trạng COVID - 19</strong><br></h5>
                                        <h5 class="text-danger ml-3"><strong>・ Bằng việc nhấn nút "Lưu", bạn hoàn toàn hiểu và đồng ý chịu trách nhiệm với các thông tin đã cung cấp.</strong></h5>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <a class="btn btn-success mt-4" href="{{ route('check-patient.index') }}">{{ __('Trở Lại') }}</a>
                                    <button type="submit" class="btn btn-success mt-4">{{ __('Lưu') }}</button>
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
    </script>
@endsection
