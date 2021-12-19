@extends('layouts.app', ['title' => __('Lịch Sử Khai Báo')])

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
                    <div class="card-header col-12 bg-white border-0 d-flex flex-row">
                        <div class="row align-items-center col-8">
                            <h3 class="mb-0">{{ __('Khai Báo Y Tế') }}</h3>
                        </div>
                        <div class="col-4 px-0 mt-md-0 mt-2 pr-3 d-flex justify-content-end">
                            <a href="{{ route('create.khai-bao') }}" class="btn btn-sm btn-success">Khai Báo</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive pb-4" >
                            <table class="table align-items-center table-flush">
                                <thead class="thead-light">
                                <tr>
                                    <th scope="col" class="sort" data-sort="ID">ID</th>
                                    <th scope="col" class="sort" data-sort="title">Nơi Đi</th>
                                    <th scope="col" class="sort" data-sort="description">Nơi Đến</th>
                                    <th scope="col" class="sort" data-sort="description">Ngày Xuất Phát</th>
                                    <th scope="col" class="sort" data-sort="started_at">Ngày Khai Báo</th>
                                    <th scope="col"></th>
                                </tr>
                                </thead>
                                <tbody class="list">
                                    @foreach($datas as $key=>$data)
                                    <tr id="list-khai-bao-{{ $data->id }}">
                                        <th>
                                          {{ $key+1 }}
                                        </th>
                                        <th scope="row">
                                            <div class="media align-items-center">
                                                <div class="media-body">
                                                    <span class="name mb-0 text-sm">{{ $data->departure_place }}</span>
                                                </div>
                                            </div>
                                        </th>
                                        <th scope="row">
                                            <div class="media align-items-center">
                                                <div class="media-body">
                                                    <span class="name mb-0 text-sm">{{ $data->arrival_place }}</span>
                                                </div>
                                            </div>
                                        </th>
                                        <th scope="row">
                                            <div class="media align-items-center">
                                                <div class="media-body">
                                                    <span class="name mb-0 text-sm" data-date-format="yyyy-mm-dd">{{ date_format(new DateTime($data->departure_date), 'Y-m-d') }}</span>
                                                </div>
                                            </div>
                                        </th>
                                        <th scope="row">
                                            <div class="media align-items-center">
                                                <div class="media-body">
                                                    <span class="name mb-0 text-sm" data-date-format="yyyy-mm-dd">{{ date_format(new DateTime($data->created_at), 'Y-m-d') }}</span>
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
                                                    <a class="dropdown-item" href="{{ route('edit.to-khai', $data->id)}}">Chỉnh sửa</a>
                                                    <a class="dropdown-item period-delete" href="{{ route('delete.to-khai', $data->id) }}">Xóa</a>
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
@push('js')
    <script type="text/javascript">
        passCountry();
        hasSignal();
    </script>
@endpush

