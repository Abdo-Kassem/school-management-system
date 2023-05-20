<div class="modal fade show" tabindex="-1" id='deleteAll'>
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">{{trans('promotion_trans.delete.all')}}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>{{trans('promotion_trans.warning.delete')}}</p>
      </div>
      <form action="{{route('promotion.destroy.all')}}" method='post'>
          {{method_field('delete')}}
          @csrf
          <input type='hidden' value='' name='promotionIDs'>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('promotion_trans.close')}}</button>
            <button type="submit" class="btn btn-primary">{{trans('promotion_trans.delete.all')}}</button>
          </div>
      </form>
      
    </div>
  </div>
</div>