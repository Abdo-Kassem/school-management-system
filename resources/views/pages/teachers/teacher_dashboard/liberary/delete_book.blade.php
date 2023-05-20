<div class="modal fade" id="delete{{$book->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
       
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">{{trans('book_trans.delete')}}</h5>
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
                            data-dismiss="modal">{{trans('book_trans.close')}}</button>
                    <a href="{{route('teacher.book.destroy',$book->id)}}"
                            class="btn btn-danger">{{trans('book_trans.delete')}}</a>
                </div>
            </div>
        </div>
    </div>
</div>