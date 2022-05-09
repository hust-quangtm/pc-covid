<div class="header bg-gradient-primary pb-8 pt-5 pt-md-8 card-header">
    <div class="container-fluid">
        <div class="header-body">
            <!-- Card stats -->
            @if(auth()->user()->getCheckPatientInforByUserID(auth()->user()->id)[0]->confirm_status == "infected")
                <div class="flex-column d-flex align-items-center justify-content-around">
                    <div class="col-xl-6 col-lg-6 pb-5">
                        <div class="card card-stats mb-4 mb-xl-0">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <a href="{{ route('profile.edit')}}">
                                            <h5 class="card-title text-uppercase text-muted mb-0 text-center">Cập Nhật Thông Tin</h5>
                                        </a>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 pb-5">
                        <div class="card card-stats mb-4 mb-xl-0">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <a href="{{ route('index.khai-bao')}}">
                                            <h5 class="card-title text-uppercase text-muted mb-0 text-center">Khai báo y tế</h5>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 pb-5">
                        <div class="card card-stats mb-4 mb-xl-0">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <a href="{{ route('index.tiem-chung') }}">
                                            <h5 class="card-title text-uppercase text-muted mb-0 text-center">Thông tin tiêm chủng</h5>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 pb-5">
                        <div class="card card-stats mb-4 mb-xl-0">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        @if(!auth()->user()->hasRole('province') && !auth()->user()->hasRole('ward') && !auth()->user()->hasRole('district') && !auth()->user()->hasRole('admin'))
                                            <a href="{{ route('check-patient.index') }}">
                                                <h5 class="card-title text-uppercase text-muted mb-0 text-center">Yêu Cầu Xác Nhận F0</h5>
                                            </a>
                                        @else
                                            <a href="{{ route('admin.check-patient.index') }}">
                                                <h5 class="card-title text-uppercase text-muted mb-0 text-center">Yêu Cầu Xác Nhận F0</h5>
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if(auth()->user()->getCheckPatientInforByUserID(auth()->user()->id)[0]->confirm_status == "infected")
                        <div class="col-xl-6 col-lg-6 pb-5">
                            <div class="card card-stats mb-4 mb-xl-0">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <a href="{{ route('health-track.index') }}">
                                                <h5 class="card-title text-uppercase text-muted mb-0 text-center">Theo Dõi Sức Khỏe</h5>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            @else
                <div class="row">
                    <div class="col-xl-3 col-lg-6">
                        <div class="card card-stats mb-4 mb-xl-0">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <a href="{{ route('profile.edit')}}">
                                            <h5 class="card-title text-uppercase text-muted mb-0 text-center">Cập Nhật Thông Tin</h5>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6">
                        <div class="card card-stats mb-4 mb-xl-0">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <a href="{{ route('index.khai-bao')}}">
                                            <h5 class="card-title text-uppercase text-muted mb-0 text-center">Khai báo y tế</h5>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6">
                        <div class="card card-stats mb-4 mb-xl-0">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <a href="{{ route('index.tiem-chung') }}">
                                            <h5 class="card-title text-uppercase text-muted mb-0 text-center">Thông tin tiêm chủng</h5>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6">
                        <div class="card card-stats mb-4 mb-xl-0">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        @if(!auth()->user()->hasRole('province') && !auth()->user()->hasRole('ward') && !auth()->user()->hasRole('district') && !auth()->user()->hasRole('admin'))
                                            <a href="{{ route('check-patient.index') }}">
                                                <h5 class="card-title text-uppercase text-muted mb-0 text-center">Yêu Cầu Xác Nhận F0</h5>
                                            </a>
                                        @else
                                            <a href="{{ route('admin.check-patient.index') }}">
                                                <h5 class="card-title text-uppercase text-muted mb-0 text-center">Yêu Cầu Xác Nhận F0</h5>
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if(auth()->user()->getCheckPatientInforByUserID(auth()->user()->id)[0]->confirm_status == "infected")
                        <div class="col-xl-3 col-lg-6">
                            <div class="card card-stats mb-4 mb-xl-0">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <a href="{{ route('health-track.index') }}">
                                                <h5 class="card-title text-uppercase text-muted mb-0 text-center">Theo Dõi Sức Khỏe</h5>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            @endif
        </div>
    </div>
</div>
