        <!--=================================
 header start-->
        <nav class="admin-header navbar navbar-default col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
            <!-- logo -->
            <div class="text-left navbar-brand-wrapper">
                @if(Auth::guard('student')->check())
                <a class="navbar-brand brand-logo-mini" href="{{route('student.home')}}" style="display:inline-block">
                    <img src="{{URL::asset('assets/images/logo-dark.png')}}" alt="">
                </a>
                @elseif(Auth::guard('teacher')->check())
                <a class="navbar-brand brand-logo-mini" href="{{route('teacher.home')}}" style="display:inline-block">
                    <img src="{{URL::asset('assets/images/logo-dark.png')}}" alt="">
                </a>
                @elseif(Auth::guard('web')->check())
                <a class="navbar-brand brand-logo-mini" href="{{route('home')}}" style="display:inline-block">
                    <img src="{{URL::asset('assets/images/logo-dark.png')}}" alt="">
                </a>
                @elseif(Auth::guard('parent')->check())
                <a class="navbar-brand brand-logo-mini" href="{{route('parent.home')}}" style="display:inline-block">
                    <img src="{{URL::asset('assets/images/logo-dark.png')}}" alt="">
                </a>
                @endif
            </div>
           
            <!-- top bar right -->
            <ul class="nav navbar-nav ">
                <ul class='nav align-items-center'>
                    @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                        @if(LaravelLocalization::getCurrentLocale() !== $localeCode)
                            <li class='nav-item'>    
                                <a class=' btn btn-primary' rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                    {{ $properties['native'] }}
                                </a>      
                            </li>
                        @endif
                    @endforeach
                </ul>
                <li class="nav-item fullscreen">
                    <a id="btnFullscreen" href="#" class="nav-link"><i class="ti-fullscreen"></i></a>
                </li>
                
                @if(Auth::guard('student')->check())
                <li class="nav-item dropdown ">
                    <a class="nav-link top-nav" data-toggle="dropdown" href="#" role="button" aria-haspopup="true"
                        aria-expanded="true"> <i class=" ti-view-grid"></i> </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-big">
                        <div class="dropdown-header">
                            <strong>Quick Links</strong>
                        </div>
                        <div class="dropdown-divider"></div>
                        
                        <div class="nav-grid">
                            <a href="{{route('student.quizz.index')}}" class="nav-grid-item">
                                <i class="ti-files text-primary"></i>
                                <h5>{{__('main_trans.quizz.list')}}</h5>
                            </a>
                            <a href="{{route('student.subject.index')}}" class="nav-grid-item">
                                <i class="ti-check-box text-success"></i>
                                <h5>{{__('main_trans.subject.list')}}</h5>
                            </a>
                            <a href="{{route('student.books')}}" class="nav-grid-item">
                                <i class="fa fa-book text-warning" aria-hidden="true"></i>
                                <h5>{{__('main_trans.library.list')}}</h5>
                            </a>
                        </div>

                    </div>
                </li>
                @endif
                
                <li class="nav-item dropdown mr-30">
                    <div class="nav-link nav-pill user-avatar" data-toggle="dropdown" href="#" role="button"
                        aria-haspopup="true" aria-expanded="false">
                        @if(Auth::guard('teacher')->check())
                        <img src="{{URL::asset('assets\images\teacher.png')}}" alt="avatar">
                        @elseif(Auth::guard('web')->check())
                        <img src="{{URL::asset('assets\images\admin.png')}}" alt="avatar">
                        @elseif(Auth::guard('student')->check())
                        <img src="{{URL::asset('assets\images\student.png')}}" alt="avatar">
                        @elseif(Auth::guard('parent')->check())
                        <img src="{{URL::asset('assets\images\parent.png')}}" alt="avatar">
                        @endif
                    </div>
                    <div class="dropdown-menu dropdown-menu-right">
                        <div class="dropdown-header">
                            <div class="media">
                                <div class="media-body">
                                    <h5 class="mt-0 mb-0">
                                    @if(Auth::guard('teacher')->check())
                                        {{Auth::guard('teacher')->user()->name}}
                                    @elseif(Auth::guard('web')->check())
                                        {{Auth::guard('web')->user()->name}}
                                    @elseif(Auth::guard('student')->check())
                                        {{Auth::guard('student')->user()->name}}
                                    @elseif(Auth::guard('parent')->check())
                                        {{Auth::guard('parent')->user()->fatherName}}
                                    @endif
                                    </h5>
                                </div>
                            </div>
                        </div>
                        <div class="dropdown-divider"></div>
                        
                        @if(Auth::guard('teacher')->check())
                            <a class="dropdown-item" href="{{route('teacher_profile.show')}}"><i class="text-warning ti-user"></i>Profile</a>
                        @elseif(Auth::guard('parent')->check())
                            <a class="dropdown-item" href="{{route('parent_profile.show')}}"><i class="text-warning ti-user"></i>Profile</a>
                        @elseif(Auth::guard('web')->check())
                            <a class="dropdown-item" href="{{route('admin_profile.show')}}"><i class="text-warning ti-user"></i>Profile</a>
                        @endif
                        
                        @if(Auth::guard('parent')->check())
                        <a href="{{route('son_fees')}}" class="dropdown-item">
                            <i class="fa fa-money text-warning" aria-hidden="true"></i>
                            {{__('fee_trans.study.fees')}}
                            
                        </a>
                        @endif

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                        @if(auth('student')->check())
                            <input type="hidden" name="guard" value="student">
                        @elseif(auth('teacher')->check())
                            <input type="hidden" name="guard" value="teacher">
                        @elseif(auth('parent')->check())
                            <input type="hidden" name="guard" value="parent">
                        @else
                            <input type="hidden" name="guard" value="web">
                        @endif
                            <button type='submit' class="dropdown-item" >
                                <i class="fa fa-sign-out" style="color:brown"></i>{{trans('auth_trans.logout')}}
                            </button>
                        </form>
                        
                    </div>
                </li>
            </ul>
        </nav>

        <!--=================================
 header End-->
