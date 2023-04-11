@if($currentStep === 2)
    <div  id="step-2">

        <div class="col-xs-12">
            <div class="col-md-12">
                <br>

                <div class="form-row">
                    <div class="col">
                        <label for="title">{{trans('parent_trans.Name_Mother')}}</label>
                        <input type="text" wire:model="mother_name_ar" class="form-control">
                        @error('mother_name_ar')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col">
                        <label for="title">{{trans('parent_trans.Name_Mother_en')}}</label>
                        <input type="text" wire:model="mother_name_en" class="form-control">
                        @error('mother_name_en')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="col-md-3">
                        <label for="title">{{trans('parent_trans.Job_Mother')}}</label>
                        <input type="text" wire:model="mother_job_ar" class="form-control">
                        @error('mother_job_ar')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-3">
                        <label for="title">{{trans('parent_trans.Job_Mother_en')}}</label>
                        <input type="text" wire:model="mother_job_en" class="form-control">
                        @error('mother_job_en')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col">
                        <label for="title">{{trans('parent_trans.National_ID_Mother')}}</label>
                        <input type="text" wire:model="mother_national_id" class="form-control">
                        @error('mother_national_id')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="col">
                        <label for="title">{{trans('parent_trans.Phone_Mother')}}</label>
                        <input type="text" wire:model="mother_phone" class="form-control">
                        @error('mother_phone')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                </div>


                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputCity">{{trans('parent_trans.Nationality_Father_id')}}</label>
                        <select class="custom-select my-1 mr-sm-2" wire:model="mother_nationality_id">
                            <option selected>{{trans('parent_trans.Choose')}}...</option>
                            @foreach($nationalities as $nationality)
                                <option value="{{$nationality->id}}">{{$nationality->name}}</option>
                            @endforeach
                        </select>
                        @error('mother_nationality_id')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col">
                        <label for="inputState">{{trans('parent_trans.Blood_Type_Father_id')}}</label>
                        <select class="custom-select my-1 mr-sm-2" wire:model="mother_bloode_type_id">
                            <option selected>{{trans('parent_trans.Choose')}}...</option>
                            @foreach($bloodes as $blood)
                                <option value="{{$blood->id}}">{{$blood->name}}</option>
                           @endforeach
                        </select>
                        @error('mother_bloode_type_id')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col">
                        <label for="inputZip">{{trans('parent_trans.Religion_Father_id')}}</label>
                        <select class="custom-select my-1 mr-sm-2" wire:model="mother_religion_id">
                            <option selected>{{trans('parent_trans.Choose')}}...</option>
                           @foreach($religions as $religion)
                                <option value="{{$religion->id}}">{{$religion->name}}</option>
                           @endforeach
                        </select>
                        @error('mother_religion_id')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label for="exampleFormControlTextarea1">{{trans('parent_trans.Address_Mother')}}</label>
                    <textarea class="form-control" wire:model="mother_address" id="exampleFormControlTextarea1"
                              rows="4"></textarea>
                    @error('mother_address')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <button class="btn btn-danger btn-sm nextBtn btn-lg pull-right" type="button" wire:click="back(1)">
                    {{trans('parent_trans.Back')}}
                </button>

                <button class="btn btn-success btn-sm nextBtn btn-lg pull-right" type="button"
                        wire:click="increaseStepSubmit">{{trans('parent_trans.Next')}}</button>
                
            </div>
        </div>
    </div>
@endif