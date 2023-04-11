@if($currentStep === 1)
    <div   id="step-1">
        <div class="col-xs-12">
            <div class="col-md-12">
                <br>
                <div class="form-row">
                    <div class="col">
                        <label for="title">{{trans('parent_trans.Email')}}</label>
                        <input type="email" wire:model="email"  class="form-control">
                        @error('email')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    @if(!$updateMode)
                    <div class="col">
                        <label for="title">{{trans('parent_trans.Password')}}</label>
                        <input type="password" wire:model="password" class="form-control" >
                        @error('password')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    @endif
                </div>

                <div class="form-row">
                    <div class="col">
                        <label for="title">{{trans('parent_trans.Name_Father')}}</label>
                        <input type="text" wire:model="name_father_ar" class="form-control" >
                        @error('name_father_ar')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col">
                        <label for="title">{{trans('parent_trans.Name_Father_en')}}</label>
                        <input type="text" wire:model="name_father_en" class="form-control" >
                        @error('name_father_en')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="col-md-3">
                        <label for="title">{{trans('parent_trans.Job_Father')}}</label>
                        <input type="text" wire:model='job_father_ar' class="form-control">
                        @error('job_father_ar')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-3">
                        <label for="title">{{trans('parent_trans.Job_Father_en')}}</label>
                        <input type="text" wire:model="job_father_en" class="form-control">
                        @error('job_father_en')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col">
                        <label for="title">{{trans('parent_trans.National_ID_Father')}}</label>
                        <input type="text" wire:model="national_ID_fatehr" class="form-control">
                        @error('national_ID_fatehr')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
            
                    <div class="col">
                        <label for="title">{{trans('parent_trans.Phone_Father')}}</label>
                        <input type="text" wire:model="phone_father" class="form-control">
                        @error('phone_father')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                </div>


                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputCity">{{trans('parent_trans.Nationality_Father_id')}}</label>
                        <select class="custom-select my-1 mr-sm-2" wire:model="nationality_father_id">
                            <option selected>{{trans('parent_trans.Choose')}}...</option>
                            @foreach($nationalities as $nationality)
                                <option value="{{$nationality->id}}">{{$nationality->name}}</option>
                            @endforeach
                        </select>
                        @error('nationality_father_id')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col">
                        <label for="inputState">{{trans('parent_trans.Blood_Type_Father_id')}}</label>
                        <select class="custom-select my-1 mr-sm-2" wire:model="blood_type_father_id">
                            <option selected>{{trans('parent_trans.Choose')}}...</option>
                            @foreach($bloodes as $blood)
                                <option value="{{$blood->id}}">{{$blood->name}}</option>
                           @endforeach
                        </select>
                        @error('blood_type_father_id')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col">
                        <label for="inputZip">{{trans('parent_trans.Religion_Father_id')}}</label>
                        <select class="custom-select my-1 mr-sm-2" wire:model="religion_father_id">
                            <option selected>{{trans('parent_trans.Choose')}}...</option>
                            @foreach($religions as $religion)
                                <option value="{{$religion->id}}">{{$religion->name}}</option>
                           @endforeach
                        </select>
                        @error('religion_father_id')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>


                <div class="form-group">
                    <label for="exampleFormControlTextarea1">{{trans('parent_trans.Address_Father')}}</label>
                    <textarea class="form-control" wire:model="address_father" id="exampleFormControlTextarea1" rows="4"></textarea>
                    @error('address_father')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <button class="btn btn-success btn-sm nextBtn btn-lg pull-right" wire:click="increaseStepSubmit"
                        type="button">{{trans('parent_trans.Next')}}
                </button>
               
            </div>
        </div>
    </div>
@endif