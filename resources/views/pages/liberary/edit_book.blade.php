<div class="modal fade " id="edit{{$book->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">{{trans('book_trans.edit')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                
                <form action="{{route('book.update')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-row">

                        <div class="col">
                            <label for="title">{{trans('book_trans.title_ar')}}</label>
                            <input type="text" name="title_ar" class="form-control"
                                value="{{$book->getTranslation('title','ar')}}">
                        </div>

                        <div class="col">
                            <label for="title">{{trans('book_trans.title_en')}}</label>
                            <input type="text" name="title_en" class="form-control"
                                value="{{$book->getTranslation('title','en')}}">
                        </div>

                        <input type="hidden" name='id' value="{{$book->id}}">

                    </div>
                    <br>

                    <div class="form-row">
                        <div class="col">
                            <div class="form-group">
                                <label for="grade">{{trans('book_trans.choose.grade')}} : <span class="text-danger">*</span></label>
                                <select id='grade' class="custom-select mr-sm-2" name="gradeID">
                                    <option selected disabled>{{trans('book_trans.choose.grade')}}...</option>
                                    @foreach($grades as $grade)
                                        <option  value="{{ $grade->id }}" {{$book->gradeID==$grade->id?'selected':''}}>
                                            {{ $grade->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-group">
                                <label for="class">{{trans('book_trans.choose.class')}} : <span class="text-danger">*</span></label>
                                <select id='class' class="custom-select mr-sm-2 classesID" name="classID">
                                    <option  value="{{ $book->class->id }}" >
                                            {{ $book->class->name }}
                                    </option>
                                </select>
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-group">
                                <label for="teacher">{{trans('book_trans.choose.teacher')}} : <span class="text-danger">*</span></label>
                                <select id='teacher' class="custom-select mr-sm-2 teacherID" name="teacherID">
                                    <option  value="{{ $book->teacher->id }}" >
                                            {{ $book->teacher->name }}
                                    </option>
                                </select>
                            </div>
                        </div>


                    </div><br>

                    <button class="btn btn-success btn-sm nextBtn btn-lg pull-right" type="submit"> {{trans('book_trans.update')}}</button>
                </form>

            </div>
        </div>
    </div>
</div>
<!---end edit modal-->