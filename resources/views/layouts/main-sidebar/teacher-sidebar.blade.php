<div class="container-fluid">
    <div class="row">
        <!-- Left Sidebar start-->
        <div class="side-menu-fixed">
            <div class="scrollbar side-menu-bg">
                <ul class="nav navbar-nav side-menu" id="sidebarnav">
                    <!-- menu item Dashboard-->
                    <li>
                        <a href="{{route('teacher.home')}}"  id='main'>
                            <div class="pull-left">
                                <i class="ti-home"></i>
                                <span class="right-nav-text">{{__('main_trans.Dashboard')}}</span>
                            </div>
                            <div class="clearfix"></div>
                        </a>
                        
                    </li>
                  
                    <!-- class-->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#classes" 
                                onclick="addIDToActive(this)" id='class'>

                            <div class="pull-left"><i class="fa fa-university" aria-hidden="true"></i><span
                                    class="right-nav-text">{{__('main_trans.classes')}}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>

                        </a>
                        <ul id="classes" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="{{route('teacher.class')}}">{{__('main_trans.classes_list')}} </a> </li>
                        </ul>
                    </li>
                    <!-- classroom-->
                    <li>
                        <a data-toggle="collapse" href="#classe_rooms"  id='classroom'>
                            <div class="pull-left"><i class="ti-home"></i><span
                                    class="right-nav-text">{{__('main_trans.classe_room')}}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="classe_rooms" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="{{route('classeroom')}}">{{__('main_trans.classe_room_list')}} </a> </li>
                        </ul>
                    </li>
                   
                    <!-- students-->
                    <li>
                        <a href="#students" data-toggle="collapse"  id='student'>
                            <div class="pull-left"><i class="fa fa-users" aria-hidden="true"></i>
                                <span class="right-nav-text">{{trans('main_trans.students')}}</span>
                            </div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="students" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="{{route('teacher.student.index')}}">{{trans('main_trans.student.show')}}</a> </li>
                        </ul>
                    </li>
                   
                    <li>
                        <a data-toggle="collapse" data-target="#attendances"  id='attendance'>
                            <div class="pull-left">
                                <img src="{{URL::asset('assets\images\attendanceIcon.png')}}" alt="" 
                                    style="width:20px;height:20px; display:inline-block;border-radius:50%">
                                <span class="right-nav-text" style="padding:0 12px">{{ trans('main_trans.attendance') }}</span>
                            </div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="attendances" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="{{route('teacher_student_attendance')}}">{{__('main_trans.attendance.list')}}</a> </li>
                        </ul>
                    </li>

                    <li>
                        <a data-toggle="collapse" data-target="#reports"  id='report'>
                            <div class="pull-left">
                                <i class="fa fa-file" aria-hidden="true"></i>
                                <span class="right-nav-text">{{ trans('main_trans.report') }}</span>
                            </div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="reports" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="{{route('teacher_attendance_report')}}">{{__('main_trans.attendance_report')}}</a> </li>
                            <li> <a href="{{route('teacher_marks_report')}}">{{__('main_trans.marks_report')}}</a> </li>
                        </ul>
                    </li>
                    
                    <li>
                        <a data-toggle="collapse" data-target="#subjects"  id='subject'>
                            <div class="pull-left">
                                <i class="fa fa-address-book-o" aria-hidden="true"></i>
                                <span class="right-nav-text">{{ trans('main_trans.subject') }}</span>
                            </div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="subjects" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="{{route('teacher.subject.index')}}">{{__('main_trans.subject.list')}}</a> </li>
                        </ul>
                    </li>

                    <li>
                        <a data-toggle="collapse" data-target="#quizzes"  id='quizz'>
                            <div class="pull-left">
                                <i class="fa fa-question" aria-hidden="true"></i>
                                <span class="right-nav-text">{{ trans('main_trans.quizz') }}</span>
                            </div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="quizzes" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="{{route('teacher.quizz.index')}}">{{__('main_trans.quizz.list')}}</a> </li>
                        </ul>
                    </li>

                    <li>
                        <a data-toggle="collapse" data-target="#library"  id='book'>
                            <div class="pull-left">
                                <i class="fa fa-book" aria-hidden="true"></i>
                                <span class="right-nav-text">{{ trans('main_trans.library') }}</span>
                            </div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="library" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="{{route('teacher.books')}}">{{__('main_trans.library.list')}}</a> </li>
                        </ul>
                    </li>
                    

                   
                </ul>
            </div>
        </div>

        <!-- Left Sidebar End-->

        <!--=================================
