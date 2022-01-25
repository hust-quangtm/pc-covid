@extends('layouts.app', ['title' => __('Quản Lý Người Dùng')])

@section('content')
    @include('users.partials.header', [
        'title' => __('Xin chào') . ' '. auth()->user()->name,
        'description' => __('Hãy cùng chung tay đẩy lùi Covid'),
        'class' => 'col-lg-12'
    ])

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                @include('layouts.messages.flash-message')
                <div class="card bg-secondary shadow">
                    <div class="card-header col-12 bg-white border-0 d-flex flex-row">
                        <div class="row align-items-center col-8">
                            <h3 class="mb-0">{{ __('Quản Lý Người Dùng') }}</h3>
                        </div>
                        {{-- <div class="col-4 px-0 mt-md-0 mt-2 pr-3 d-flex justify-content-end">
                            <a href="{{ route('create.khai-bao') }}" class="btn btn-sm btn-success">Khai Báo</a>
                        </div> --}}
                    </div>
                    <div class="card-body">
                        <div class="table-responsive pb-4" >
                            <table class="table align-items-center table-flush">
                                <thead class="thead-light">
                                <tr>
                                    <th scope="col" class="sort" data-sort="ID">ID</th>
                                    <th scope="col" class="sort" data-sort="title">Họ Tên</th>
                                    <th scope="col" class="sort" data-sort="description">CMND/CCCD</th>
                                    <th scope="col" class="sort" data-sort="started_at">Nơi Ở Hiện Tại</th>
                                    <th scope="col" class="sort" data-sort="description">Quê Quán</th>
                                    <th scope="col" class="sort" data-sort="started_at">Địa Chỉ Thường Chú</th>
                                    <th scope="col" class="sort" data-sort="started_at">Tình Trạng Tiêm Chủng</th>
                                    <th scope="col"></th>
                                </tr>
                                </thead>
                                <tbody class="list">
                                    @foreach($users as $key=>$user)
                                        @if(auth()->user()->hasRole('admin'))
                                            @if($user->id != 1 && !$user->hasRole('ward') && !$user->hasRole('district') && !$user->hasRole('province')  )
                                            <tr id="list-khai-bao-{{ $user->id }}">
                                                <th>
                                                {{ $key }}
                                                </th>
                                                <th scope="row">
                                                    <div class="media align-items-center">
                                                        <div class="media-body">
                                                            <span class="name mb-0 text-sm">{{ $user->full_name }}</span>
                                                        </div>
                                                    </div>
                                                </th>
                                                <th scope="row">
                                                    <div class="media align-items-center">
                                                        <div class="media-body">
                                                            <span class="name mb-0 text-sm">{{ $user->identify_number }}</span>
                                                        </div>
                                                    </div>
                                                </th>
                                                <th scope="row">
                                                    <div class="media align-items-center">
                                                        <div class="media-body">
                                                            <span class="name mb-0 text-sm">{{ $user->home_town }}</span>
                                                        </div>
                                                    </div>
                                                </th>
                                                <th scope="row">
                                                    <div class="media align-items-center">
                                                        <div class="media-body">
                                                            <span class="name mb-0 text-sm">{{ $user->residence }}</span>
                                                        </div>
                                                    </div>
                                                </th>
                                                <th scope="row">
                                                    <div class="media align-items-center">
                                                        <div class="media-body">
                                                            <span class="name mb-0 text-sm">{{ $user->address }}</span>
                                                        </div>
                                                    </div>
                                                </th>
                                                <th scope="row">
                                                    <div class="media align-items-center">
                                                        <div class="media-body">
                                                            @foreach($vaccined as $key => $data)
                                                                @if($data->user_id == $user->id)
                                                                    <span class="name mb-0 text-sm">
                                                                        @if($data->ordinal_of_injection == 1)
                                                                            Đã tiêm mũi 1
                                                                        @elseif($data->ordinal_of_injection == 2)
                                                                            Đã tiêm mũi 2
                                                                        @endif
                                                                    </span>
                                                                @else
                                                                    Chưa tiêm
                                                                @endif
                                                            @endforeach
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
                                                            <a class="dropdown-item" href="{{ route('edit.to-khai', $user->id)}}">Chỉnh sửa</a>
                                                            <a class="dropdown-item period-delete" href="{{ route('admin.delete.user',  $user->id) }}">Xóa</a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endif
                                        @endif
                                        @if(auth()->user()->hasRole('ward'))
                                            @if(auth()->user()->ward == $user->ward)
                                                @if($user->id != auth()->user()->id)
                                                    <tr id="list-khai-bao-{{ $user->id }}">
                                                        <th>
                                                        {{ $key }}
                                                        </th>
                                                        <th scope="row">
                                                            <div class="media align-items-center">
                                                                <div class="media-body">
                                                                    <span class="name mb-0 text-sm">{{ $user->full_name }}</span>
                                                                </div>
                                                            </div>
                                                        </th>
                                                        <th scope="row">
                                                            <div class="media align-items-center">
                                                                <div class="media-body">
                                                                    <span class="name mb-0 text-sm">{{ $user->identify_number }}</span>
                                                                </div>
                                                            </div>
                                                        </th>
                                                        <th scope="row">
                                                            <div class="media align-items-center">
                                                                <div class="media-body">
                                                                    <span class="name mb-0 text-sm">{{ $user->home_town }}</span>
                                                                </div>
                                                            </div>
                                                        </th>
                                                        <th scope="row">
                                                            <div class="media align-items-center">
                                                                <div class="media-body">
                                                                    <span class="name mb-0 text-sm">{{ $user->residence }}</span>
                                                                </div>
                                                            </div>
                                                        </th>
                                                        <th scope="row">
                                                            <div class="media align-items-center">
                                                                <div class="media-body">
                                                                    <span class="name mb-0 text-sm">{{ $user->address }}</span>
                                                                </div>
                                                            </div>
                                                        </th>
                                                        <th scope="row">
                                                            <div class="media align-items-center">
                                                                <div class="media-body">
                                                                    @foreach($vaccined as $key => $data)
                                                                        @if($data->user_id == $user->id)
                                                                            <span class="name mb-0 text-sm">
                                                                                @if($data->ordinal_of_injection == 1)
                                                                                    Đã tiêm mũi 1
                                                                                @elseif($data->ordinal_of_injection == 2)
                                                                                    Đã tiêm mũi 2
                                                                                @endif
                                                                            </span>
                                                                        @else
                                                                            Chưa tiêm
                                                                        @endif
                                                                    @endforeach
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
                                                                    <a class="dropdown-item" href="{{ route('edit.to-khai', $user->id)}}">Chỉnh sửa</a>
                                                                    <a class="dropdown-item period-delete" href="{{ route('admin.delete.user',  $user->id) }}">Xóa</a>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endif
                                            @endif
                                        @endif
                                        @if(auth()->user()->hasRole('district') && !$user->hasRole('ward'))
                                            @if(auth()->user()->district == $user->district)
                                                @if($user->id != auth()->user()->id)
                                                    <tr id="list-khai-bao-{{ $user->id }}">
                                                        <th>
                                                        {{ $key }}
                                                        </th>
                                                        <th scope="row">
                                                            <div class="media align-items-center">
                                                                <div class="media-body">
                                                                    <span class="name mb-0 text-sm">{{ $user->full_name }}</span>
                                                                </div>
                                                            </div>
                                                        </th>
                                                        <th scope="row">
                                                            <div class="media align-items-center">
                                                                <div class="media-body">
                                                                    <span class="name mb-0 text-sm">{{ $user->identify_number }}</span>
                                                                </div>
                                                            </div>
                                                        </th>
                                                        <th scope="row">
                                                            <div class="media align-items-center">
                                                                <div class="media-body">
                                                                    <span class="name mb-0 text-sm">{{ $user->home_town }}</span>
                                                                </div>
                                                            </div>
                                                        </th>
                                                        <th scope="row">
                                                            <div class="media align-items-center">
                                                                <div class="media-body">
                                                                    <span class="name mb-0 text-sm">{{ $user->residence }}</span>
                                                                </div>
                                                            </div>
                                                        </th>
                                                        <th scope="row">
                                                            <div class="media align-items-center">
                                                                <div class="media-body">
                                                                    <span class="name mb-0 text-sm">{{ $user->address }}</span>
                                                                </div>
                                                            </div>
                                                        </th>
                                                        <th scope="row">
                                                            <div class="media align-items-center">
                                                                <div class="media-body">
                                                                    @foreach($vaccined as $key => $data)
                                                                        @if($data->user_id == $user->id)
                                                                            <span class="name mb-0 text-sm">
                                                                                @if($data->ordinal_of_injection == 1)
                                                                                    Đã tiêm mũi 1
                                                                                @elseif($data->ordinal_of_injection == 2)
                                                                                    Đã tiêm mũi 2
                                                                                @endif
                                                                            </span>
                                                                        @else
                                                                            Chưa tiêm
                                                                        @endif
                                                                    @endforeach
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
                                                                    <a class="dropdown-item" href="{{ route('edit.to-khai', $user->id)}}">Chỉnh sửa</a>
                                                                    <a class="dropdown-item period-delete" href="{{ route('admin.delete.user',  $user->id) }}">Xóa</a>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endif
                                            @endif
                                        @endif
                                        @if(auth()->user()->hasRole('province'))
                                            @if(auth()->user()->province == $user->province && !$user->hasRole('district') && !$user->hasRole('ward'))
                                                @if($user->id != auth()->user()->id)
                                                    <tr id="list-khai-bao-{{ $user->id }}">
                                                        <th>
                                                        {{ $key }}
                                                        </th>
                                                        <th scope="row">
                                                            <div class="media align-items-center">
                                                                <div class="media-body">
                                                                    <span class="name mb-0 text-sm">{{ $user->full_name }}</span>
                                                                </div>
                                                            </div>
                                                        </th>
                                                        <th scope="row">
                                                            <div class="media align-items-center">
                                                                <div class="media-body">
                                                                    <span class="name mb-0 text-sm">{{ $user->identify_number }}</span>
                                                                </div>
                                                            </div>
                                                        </th>
                                                        <th scope="row">
                                                            <div class="media align-items-center">
                                                                <div class="media-body">
                                                                    <span class="name mb-0 text-sm">
                                                                        {{$user->address}} -
                                                                        @foreach($wards as $key => $ward)
                                                                            {{ $ward->id == $user->ward ? $ward->name : '' }}
                                                                        @endforeach -
                                                                        @foreach($districts as $key => $district)
                                                                            {{ $district->id == $user->district ? $district->name : '' }}
                                                                        @endforeach -
                                                                        @foreach($citys as $key => $city)
                                                                            {{ $city->id == $user->province ? $city->name : '' }}
                                                                        @endforeach
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </th>
                                                        <th scope="row">
                                                            <div class="media align-items-center">
                                                                <div class="media-body">
                                                                    <span class="name mb-0 text-sm">{{ $user->home_town }}</span>
                                                                </div>
                                                            </div>
                                                        </th>
                                                        <th scope="row">
                                                            <div class="media align-items-center">
                                                                <div class="media-body">
                                                                    <span class="name mb-0 text-sm">{{ $user->residence }}</span>
                                                                </div>
                                                            </div>
                                                        </th>
                                                        <th scope="row">
                                                            <div class="media align-items-center">
                                                                <div class="media-body">
                                                                    @foreach($vaccined as $key => $data)
                                                                        @if($data->user_id == $user->id)
                                                                            <span class="name mb-0 text-sm">
                                                                                @if($data->ordinal_of_injection == 1)
                                                                                    Đã tiêm mũi 1
                                                                                @elseif($data->ordinal_of_injection == 2)
                                                                                    Đã tiêm mũi 2
                                                                                @endif
                                                                            </span>
                                                                        @else
                                                                            Chưa tiêm
                                                                        @endif
                                                                    @endforeach
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
                                                                    <a class="dropdown-item" href="{{ route('edit.to-khai', $user->id)}}">Chỉnh sửa</a>
                                                                    <a class="dropdown-item period-delete" href="{{ route('admin.delete.user',  $user->id) }}">Xóa</a>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endif
                                            @endif
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
