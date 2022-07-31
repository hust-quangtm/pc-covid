@extends('layouts.app', ['title' => __('Khai báo F0')])

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
                <div class="card bg-secondary shadow lich-su-tiem">
                    <div class="card-header col-12 bg-white border-0 d-flex flex-row">
                        <div class="row align-items-center col-8">
                            <h3 class="mb-0">{{ __('Khai báo F0') }}</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive pb-4" >
                            <table class="table align-items-center table-flush">
                                <thead class="thead-light">
                                <tr>
                                    <th scope="col" class="sort">STT</th>
                                    <th scope="col" class="sort">Họ Tên</th>
                                    <th scope="col" class="sort">CMND/CCCD</th>
                                    <th scope="col" class="sort">Địa Chỉ</th>
                                    <th scope="col" class="sort">Ngày Khai Báo</th>
                                    <th scope="col" class="sort">Xác Nhận Của Cơ Sở Y Tế</th>
                                    <th scope="col" class="sort">Ngày Nhiễm Bệnh</th>
                                    <th scope="col" class="sort">Ngày Khỏi Bệnh</th>
                                    <th scope="col"></th>
                                </tr>
                                </thead>
                                <tbody class="list">
                                    @foreach($datas as $key=>$data)
                                    <tr id="list-health-track-{{ $key }}">
                                        <th>
                                          {{ $key+1 }}
                                        </th>
                                        <th>
                                            <div class="media align-items-center">
                                                <div class="media-body">
                                                    <span class="name mb-0 text-sm">{{ $data->user->full_name }}</span>
                                                </div>
                                            </div>
                                        </th>
                                        <th>
                                            <div class="media align-items-center">
                                                <div class="media-body">
                                                    <span class="name mb-0 text-sm">{{ $data->user->identify_number }}</span>
                                                </div>
                                            </div>
                                        </th>
                                        <th>
                                            <div class="media align-items-center">
                                                <div class="media-body">
                                                    <span class="name mb-0 text-sm">{{ $data->user->address }}</span>
                                                </div>
                                            </div>
                                        </th>
                                        <th scope="row">
                                            <div class="media align-items-center">
                                                <div class="media-body">
                                                    <span class="name mb-0 text-sm" data-date-format="yyyy-mm-dd">{{ date_format(new DateTime($data->declaration_date), 'Y-m-d') }}</span>
                                                </div>
                                            </div>
                                        </th>
                                        <th scope="row">
                                            <div class="media align-items-center">
                                                <div class="media-body">
                                                    @if($data->confirm_status == 'infected')
                                                        <span class="name mb-0 text-sm">Dương Tính SARS-CoV-2</span>
                                                    @endif
                                                    @if($data->confirm_status == 'not_infected')
                                                        <span class="name mb-0 text-sm">Âm Tính SARS-CoV-2</span>
                                                    @endif
                                                    @if($data->confirm_status == 'cannot_proof')
                                                        <span class="name mb-0 text-sm">Chưa Đủ Điều Kiện Xác Minh</span>
                                                    @endif
                                                    @if($data->confirm_status == 'not_checked')
                                                        <span class="name mb-0 text-sm">Chờ Duyệt</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </th>
                                        <th scope="row">
                                            <div class="media align-items-center">
                                                <div class="media-body">
                                                    <span class="name mb-0 text-sm" data-date-format="yyyy-mm-dd">{{$data->infected_day ? date_format(new DateTime($data->infected_day), 'Y-m-d') : ''}}</span>
                                                </div>
                                            </div>
                                        </th>
                                        <th scope="row">
                                            <div class="media align-items-center">
                                                <div class="media-body">
                                                    <span class="name mb-0 text-sm" data-date-format="yyyy-mm-dd">{{$data->recovery_day ? date_format(new DateTime($data->recovery_day), 'Y-m-d') : ''}}</span>
                                                </div>
                                            </div>
                                        </th>
                                        <td class="text-right">
                                            <div class="dropdown">
                                                <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                    <a class="dropdown-item" href="{{ route('admin.check-patient.show', $data->id)}}">Chi tiết</a>
                                                    <a class="dropdown-item" href="{{ route('admin.check-patient.edit', $data->id)}}">Chỉnh sửa</a>
                                                    <a class="dropdown-item period-delete" href="{{ route('admin.check-patient.delete', $data->id) }}">Xóa</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.footers.auth')
    </div>
@endsection
