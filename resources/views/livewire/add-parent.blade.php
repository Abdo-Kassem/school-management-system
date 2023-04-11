<div>

    @if(!empty($success_message))
        <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert">x</button>
            {{$success_message}}
        </div>
    @elseif(!empty($fail_message))
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert">x</button>
            {{$fail_message}}
        </div>
    @endif

    @if(!empty($exception_message))
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert">x</button>
            {{$exception_message}}
        </div>
    @endif
    
    @if($showTable === true)
        @include('livewire.show_parents')
    @else
    <div class="stepwizard">
        <div class="stepwizard-row setup-panel">
            <div class="stepwizard-step">
                <a href="#step-1" type="button"
                    class="btn btn-circle {{ $currentStep != 1 ? 'btn-default' : 'btn-success' }}">1</a>
                <p>{{ trans('parent_trans.Step1') }}</p>
            </div>
            <div class="stepwizard-step">
                <a href="#step-2" type="button"
                    class="btn btn-circle {{ $currentStep != 2 ? 'btn-default' : 'btn-success' }}">2</a>
                <p>{{ trans('parent_trans.Step2') }}</p>
            </div>
            <div class="stepwizard-step">
                <a href="#step-3" type="button"
                    class="btn btn-circle {{ $currentStep != 3 ? 'btn-default' : 'btn-success' }}"
                    disabled="disabled">3</a>
                <p>{{ trans('parent_trans.Step3') }}</p>
            </div>
        </div>
    </div>

    @include('livewire.form_father')
    @include('livewire.form_mother')

    <div class="row setup-content {{ $currentStep != 3 ? 'displayNone' : '' }}" id="step-3">
                 @if ($currentStep === 3)
                <div id="step-3">

                    <div class="col-xs-12">
                        <div class="col-md-12"><br>
                            <label style="color: red">{{trans('Parent_trans.Attachments')}}</label>
                            <div class="form-group">
                                <input type="file" wire:model="photos" accept="image/*" multiple>
                            </div>
                            <br>

                            <input type="hidden" wire:model="parentID">

                            <button class="btn btn-danger btn-sm nextBtn btn-lg pull-right" type="button"
                                    wire:click="back(2)">{{ trans('Parent_trans.Back') }}</button>

                            @if($updateMode)
                                <button class="btn btn-success btn-sm nextBtn btn-lg pull-right" wire:click="updateParent"
                                        type="button">{{trans('parent_trans.Finish')}}
                                </button>
                            @else
                                <button class="btn btn-success btn-sm btn-lg pull-right" wire:click="addParent"
                                        type="button">{{ trans('parent_trans.Finish') }}</button>
                            @endif

                        </div>
                    </div>
                </div>
                @endif
        </div>
    @endif
</div>
