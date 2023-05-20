<div class="container-fluid">
    <div class="row">
        <!-- Left Sidebar start-->
        <div class="side-menu-fixed">
            <div class="scrollbar side-menu-bg">
                <ul class="nav navbar-nav side-menu" id="sidebarnav">
                    <!-- menu item Dashboard-->
                    
                    <li>
                        <a href="{{route('home')}}"  id='main'>
                            <div class="pull-left">
                                <i class="ti-home"></i>
                                <span class="right-nav-text">{{__('main_trans.Dashboard')}}</span>
                            </div>
                            <div class="clearfix"></div>
                        </a>
                        
                    </li>
                   
                    <li>
                        <a href="#grades" data-toggle="collapse" id='grade'>
                            <div class="pull-left"><i class="ti-palette"></i><span
                                    class="right-nav-text">{{__('main_trans.grade')}}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="grades" class="collapse" data-parent="#sidebarnav">
                            <li><a href="{{route('grades')}}">{{__('main_trans.grade_list')}}</a></li>
                        </ul>
                    </li>
                    <!-- classes-->
                    <li>
                        <a href="#classes" data-toggle="collapse" id='class'>
                            <div class="pull-left">
                                <i class="fa fa-university" aria-hidden="true"></i>
                                <span class="right-nav-text">{{__('main_trans.classes')}}</span>
                            </div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="classes" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="{{route('classes')}}">{{__('main_trans.classes_list')}} </a> </li>
                        </ul>
                    </li>
                    <!-- classroom-->
                    <li>
                        <a data-toggle="collapse" href="#classe_rooms" id='classroom'>
                            <div class="pull-left">
                                <i class="ti-home"></i>
                                <span class="right-nav-text">{{__('main_trans.classe_room')}}</span>
                            </div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="classe_rooms" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="{{route('classe.rooms')}}">{{__('main_trans.classe_room_list')}} </a> </li>
                        </ul>
                    </li>
                    <!-- students-->
                    <li>
                        <a href="#students" data-toggle="collapse" id='student'>
                            <div class="pull-left">
                                <i class="fa fa-users" aria-hidden="true"></i>
                                <span class="right-nav-text">{{trans('main_trans.students')}}</span>
                            </div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="students" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="{{route('student.index')}}">{{trans('main_trans.student.show')}}</a> </li>
                            <li> <a href="{{route('promotion.index')}}">{{trans('main_trans.promotion.show')}}</a> </li>
                            <li> <a href="{{route('graduate.index')}}">{{trans('main_trans.graduate.show')}}</a> </li>
                        </ul>
                    </li>

                    <!-- teachers-->
                    <li>
                        <a href="#teachers" data-toggle="collapse" id='teacher'>
                            <div class="pull-left">
                                <img src="{{URL::asset('assets\images\teacher.png')}}" alt="" style="width:20px;height:20px; display:inline-block">
                                <span class="right-nav-text" style="padding:0 12px">{{trans('main_trans.teachers')}}</span>
                            </div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="teachers" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="{{route('teacher.index')}}">{{trans('main_trans.teacher.list')}}</a> </li>
                        </ul>
                    </li>
                    <!-- parents-->
                    <li>
                        <a href="#parents" data-toggle="collapse" id='parent'>
                            <div class="pull-left">
                                <i class="fa fa-male" aria-hidden="true"></i>
                                <span class="right-nav-text">{{trans('main_trans.parents')}}</span>
                            </div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="parents" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="{{url('parent/add')}}">{{trans('main_trans.parents_list')}}</a> </li>
                        </ul>
                    </li>

                    {{--study fees--}}
                    <li>
                        <a  data-toggle="collapse" data-target="#study_fees" id='study_fee'>
                            <div class="pull-left">
                                <i class="fa fa-credit-card" aria-hidden="true"></i>
                                <span class="right-nav-text">{{ trans('main_trans.study.fees') }}</span>
                            </div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="study_fees" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="{{route('fees.index')}}">{{__('main_trans.study.fees.list')}}</a> </li>
                            <li> <a href="{{route('student_fees.index')}}">{{__('main_trans.student_fees.list')}}</a> </li>
                        </ul>
                    </li>
                   
                    {{--attendance--}}
                    <li>
                        <a data-toggle="collapse" data-target="#attendances" id='attendance'>
                            <div class="pull-left">
                                <img src="{{URL::asset('assets\images\attendanceIcon.png')}}" alt="" 
                                    style="width:20px;height:20px; display:inline-block;border-radius:50%">
                                <span class="right-nav-text" style="padding:0 12px">{{ trans('main_trans.attendance') }}</span>
                            </div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="attendances" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="{{route('student-attendance.index')}}">{{__('main_trans.attendance.list')}}</a> </li>
                        </ul>
                    </li>
                    
                    {{--subjects--}}
                    <li>
                        <a data-toggle="collapse" data-target="#subjects" id='subject'>
                            <div class="pull-left">
                                <i class="fa fa-address-book-o" aria-hidden="true"></i>
                                <span class="right-nav-text">{{ trans('main_trans.subject') }}</span>
                            </div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="subjects" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="{{route('subject.index')}}">{{__('main_trans.subject.list')}}</a> </li>
                        </ul>
                    </li>
                    
                    {{--quizzes--}}
                    <li>
                        <a data-toggle="collapse" data-target="#quizzes" id='quizz'>
                            <div class="pull-left">
                                <i class="fa fa-question" aria-hidden="true" ></i>
                                <span class="right-nav-text">{{ trans('main_trans.quizz') }}</span>
                            </div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="quizzes" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="{{route('quizz.index')}}">{{__('main_trans.quizz.list')}}</a> </li>
                        </ul>
                    </li>

                    {{--library--}}
                    <li>
                        <a data-toggle="collapse" data-target="#library" id='book'>
                            <div class="pull-left">
                                <i class="fa fa-book " aria-hidden="true" ></i>
                                <span class="right-nav-text">{{ trans('main_trans.library') }}</span>
                            </div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="library" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="{{route('book.index')}}">{{__('main_trans.library.list')}}</a> </li>
                        </ul>
                    </li>
                   
                    
                </ul>
            </div>
        </div>

        <!-- Left Sidebar End-->

        <!--=================================
