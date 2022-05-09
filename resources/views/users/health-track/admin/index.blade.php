@extends('layouts.app', ['title' => __('Theo Dõi Sức Khỏe Bệnh Nhân')])

@section('content')
    @include('users.partials.header', [
        'title' => __('Xin chào') . ' '. auth()->user()->name,
        'description' => __('Hãy cùng chung tay đẩy lùi Covid'),
        'class' => 'col-lg-12'
    ])
    {{-- <div>
        @if($data_user[0]->hasRole('ward'))
            {{dd(1)}}
        @endif
    </div> --}}
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                @include('layouts.messages.flash-message');
                <div class="card bg-secondary shadow lich-su-tiem">
                    <div class="card-header col-12 bg-white border-0 d-flex flex-row">
                        <div class="row align-items-center col-8">
                            <h3 class="mb-0">{{ __('Lịch Sử Khai Báo') }}</h3>
                        </div>
                        <div class="col-4 px-0 mt-md-0 mt-2 pr-3 d-flex justify-content-end">
                            <a href="{{ route('health-track.create') }}" class="btn btn-sm btn-success">Theo Dõi Sức Khỏe Bệnh Nhân</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive pb-4" >
                            <table class="table align-items-center table-flush">
                                <thead class="thead-light">
                                <tr>
                                    <th scope="col" class="sort" data-sort="ID">STT</th>
                                    <th scope="col" class="sort" data-sort="title">Tên</th>
                                    <th scope="col" class="sort" data-sort="title">CCCD/CMND</th>
                                    <th scope="col" class="sort" data-sort="title">Địa Chỉ</th>
                                    <th scope="col"></th>
                                </tr>
                                </thead>
                                <tbody class="list">
                                    @foreach($data_user as $key=>$data)
                                        @if(!$data->hasRole('province') && !$data->hasRole('ward') && !$data->hasRole('district') && !$data->hasRole('admin'))
                                            <tr id="list-health-track-{{ $key }}">
                                                <th>
                                                {{ $key+1 }}
                                                </th>
                                                <th scope="row">
                                                    <div class="media align-items-center">
                                                        <div class="media-body">
                                                            @if($data->full_name)
                                                                <span class="name mb-0 text-sm">{{ $data->full_name }}</span>
                                                            @else
                                                                <span class="name mb-0 text-sm">{{ $data->name }}</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </th>
                                                <th scope="row">
                                                    <div class="media align-items-center">
                                                        <div class="media-body">
                                                            <span class="name mb-0 text-sm">{{ $data->identify_number }}</span>
                                                        </div>
                                                    </div>
                                                </th>
                                                <th scope="row">
                                                    <div class="media align-items-center">
                                                        <div class="media-body">
                                                            <span class="name mb-0 text-sm">{{ $data->address }}</span>
                                                        </div>
                                                    </div>
                                                </th>
                                                <td class="text-right">
                                                    <div class="dropdown">
                                                        <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <i class="fas fa-ellipsis-v"></i>
                                                        </a>
                                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                            <a class="dropdown-item" href="{{ route('admin.health-track.detail', $data->id)}}">Chi Tiết</a>
                                                            <a class="dropdown-item period-delete" href="{{ route('health-track.delete', $data->id) }}">Xóa</a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endif
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
