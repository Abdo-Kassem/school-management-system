<div class="modal fade " id="edit_question{{$question->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">{{trans('quizz_trans.edit_question')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                
                <form action="{{ route('teacher.questions.update') }}" method="post" autocomplete="off">
                    @csrf
                    <div class="form-row">

                        <div class="col">
                            <label for="title">{{trans('quizz_trans.question')}}</label>
                            <input type="text" name="title" id="input-name"
                                    class="form-control form-control-alternative" 
                                    value="{{$question->title}}">
                        </div>
                        <input type="hidden" name='questionID' value="{{$question->id}}">
                    </div>
                    <br>

                    <div class="form-row">
                        <div class="col">
                            <label for="title">{{trans('quizz_trans.answers')}}</label>
                            <textarea name="answers" class="form-control" id="exampleFormControlTextarea1"
                                rows="4" value="{{$question->answers}}">{{$question->answers}}</textarea>
                        </div>
                    </div>
                    <br>

                    <div class="form-row">
                        <div class="col">
                            <label for="title">{{trans('quizz_trans.answer')}}</label>
                            <input type="text" name="answer" id="input-name"
                                    class="form-control form-control-alternative" 
                                    value="{{$question->answers}}">
                        </div>
                    </div>
                    <br>

                    <div class="form-row">
                        <div class="col-6">
                            <div class="form-group">
                                <label >{{trans('quizz_trans.score')}} : <span class="text-danger">*</span></label>
                                <input type="number" name='score' min='1'
                                    class="form-control form-control-alternative" 
                                    value="{{$question->score}}">
                            </div>
                        </div>
                    </div>
                    <br>
                    <button class="btn btn-success btn-sm nextBtn btn-lg pull-right" type="submit">
                        {{trans('quizz_trans.update')}}
                    </button>
                </form>

            </div>
        </div>
    </div>
</div>
<!---end edit modal-->