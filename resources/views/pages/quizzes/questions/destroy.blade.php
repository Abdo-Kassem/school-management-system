<div class="modal fade" id="delete_question{{$question->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="{{route('questions.destroy',$question->id)}}" method="post">
            {{method_field('delete')}}
            {{csrf_field()}}
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">{{trans('quizz_trans.delete_question')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p> {{trans('subject_trans.warning.delete')}}</p>
            </div>
            <div class="modal-footer">
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                            data-dismiss="modal">{{trans('quizz_trans.close')}}</button>
                    <button type="submit"
                            class="btn btn-danger">{{trans('quizz_trans.delete_question')}}</button>
                </div>
            </div>
        </div>
        </form>
    </div>
</div>