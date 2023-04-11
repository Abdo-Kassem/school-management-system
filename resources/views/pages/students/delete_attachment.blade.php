<div class="modal fade" id="Delete_img{{$attachment->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">{{trans('student_trans.delete_attachment')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('delete.attachment')}}" method="post">
                    {{method_field('delete')}}
                    @csrf
                    <input type="hidden" name="id" value="{{$attachment->id}}">

                    <input type="hidden" name="studentName" value="{{$student->name}}">
                    <input type="hidden" name="studentID" value="{{$student->id}}">

                    <h5 style="font-family: 'Cairo', sans-serif;">{{trans('student_trans.warning.delete')}}</h5>
                    <input type="text" name="filename" readonly value="{{$attachment->fileName}}" class="form-control">

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('student_trans.close')}}</button>
                        <button  class="btn btn-danger">{{trans('student_trans.delete.attachment')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>