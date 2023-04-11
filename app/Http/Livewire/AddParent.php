<?php

namespace App\Http\Livewire;

use App\Models\Bloode;
use App\Models\My_Parent;
use App\Models\Nationality;
use App\Models\ParentAttachement;
use App\Models\Religion;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class AddParent extends Component
{

    use WithFileUploads;
    
    public $currentStep = 1,$success_message = '',
            $fail_message = '',$exception_message = '',
            $showTable = true, $updateMode = false;
    public $email , $password , $photos , $parentID ,
            //father properties
            $name_father_ar , $name_father_en , 
            $job_father_ar , $job_father_en , $national_ID_fatehr , 
            $phone_father , $nationality_father_id ,
            $blood_type_father_id , $religion_father_id , $address_father ,
            //mother properties
            $mother_name_ar , $mother_name_en , $mother_job_ar , 
            $mother_job_en , $mother_national_id , $mother_phone ,
            $mother_nationality_id , $mother_bloode_type_id , $mother_religion_id , 
            $mother_address;


    /*statr real time validation  */
    protected function rules()
    {
        if($this->updateMode) {
            return [
                'email' => 'required|email|unique:my_parents,email,'.$this->parentID,
                'password' => 'required|regex:/[A-Z][0-9]{6,18}[A-Z]/',
                'phone_father' => 'required|numeric|digits_between:10,11|unique:my_parents,fatherPhone,'.$this->parentID,
                'national_ID_fatehr' => 'required|numeric|digits_between:14,14|unique:my_parents,fatherNationalID,'.$this->parentID,
                'mother_phone' => 'required|numeric|digits_between:10,11|unique:my_parents,motherPhone,'.$this->parentID,
                'mother_national_id' => 'required|numeric|digits_between:14,14|unique:my_parents,motherNationalID,'.$this->parentID
            ];
        }else {
            return [
                'email' => 'required|email|unique:my_parents,email',
                'password' => 'required|regex:/[A-Z][0-9]{6,18}[A-Z]/',
                'phone_father' => 'required|numeric|digits_between:10,11|unique:my_parents,fatherPhone',
                'national_ID_fatehr' => 'required|numeric|digits_between:14,14|unique:my_parents,fatherNationalID',
                'mother_phone' => 'required|numeric|digits_between:10,11|unique:my_parents,motherPhone',
                'mother_national_id' => 'required|numeric|digits_between:14,14|unique:my_parents,motherNationalID|'
            ];
        }
    } 

    protected function messages() 
    {
        return [
            'password.regex' => trans('messages.password.regex'),
            'email.unique' => trans('messages.email.unique'),
        ];
    }  

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName,$this->rules(),$this->messages());
    }
    /*end real time validation */

    public function edit($parentID) 
    {
        $parent = My_Parent::find($parentID);
        $this->updateMode = true;
        $this->showTable = false;
        $this->parentID = $parentID;
        $this->email = $parent->email; 
        $this->password = $parent->password;
        //father properties
        $this->name_father_ar = $parent->getTranslation('fatherName','ar');
        $this->name_father_en = $parent->getTranslation('fatherName','en'); 
        $this->job_father_ar = $parent->getTranslation('fatherJob','ar');
        $this->job_father_en = $parent->getTranslation('fatherJob','en');
        $this->national_ID_fatehr = $parent->fatherNationalID; 
        $this->phone_father = $parent->fatherPhone;
        $this->nationality_father_id = $parent->fatherNationalityID;
        $this->religion_father_id = $parent->fatherReligionsID;
        $this->blood_type_father_id = $parent->fatherBloodeID; 
        $this->address_father = $parent->fatherAddress;
        //mother properties
        $this->mother_name_ar = $parent->getTranslation('motherName','ar');
        $this->mother_name_en = $parent->getTranslation('motherName','en');
        $this->mother_job_ar = $parent->getTranslation('motherJob','ar'); 
        $this->mother_job_en = $parent->getTranslation('motherJob','en');
        $this->mother_national_id = $parent->motherNationalID;
        $this->mother_phone = $parent->motherPhone;
        $this->mother_nationality_id = $parent->motherNationalityID;
        $this->mother_bloode_type_id = $parent->motherBloodeID;
        $this->mother_religion_id = $parent->motherReligionsID;
        $this->mother_address = $parent->motherAddress;
         
    }

    /*add parent*/

    public function addParent()
    {
        try {

            DB::beginTransaction();

            My_Parent::create([
                'email' => $this->email,
                'password' => Hash::make($this->password),
                'fatherName' => ['ar'=>$this->name_father_ar,'en'=>$this->name_father_en], 
                'fatherJob' => ['ar'=>$this->job_father_ar,'en'=>$this->job_father_en], 
                'fatherNationalID' => $this->national_ID_fatehr, 
                'fatherPhone' => $this->phone_father,
                'fatherNationalityID' => $this->nationality_father_id ,
                'fatherBloodeID' => $this->blood_type_father_id , 
                'fatherReligionsID' => $this->religion_father_id,
                'fatherAddress' => $this->address_father,
    
                'motherName' => ['ar'=>$this->name_father_ar,'en'=>$this->name_father_en], 
                'motherJob' => ['ar'=>$this->job_father_ar,'en'=>$this->job_father_en], 
                'motherNationalID' => $this->national_ID_fatehr, 
                'motherPhone' => $this->phone_father,
                'motherNationalityID' => $this->nationality_father_id ,
                'motherBloodeID' => $this->blood_type_father_id , 
                'motherReligionsID' => $this->religion_father_id,
                'motherAddress' => $this->address_father,
            ]);
    
            if(isset($this->photos) && count($this->photos) > 0) {
                $this->addAttachements(My_Parent::where('fatherPhone',$this->phone_father)->first()->id);
            }

            DB::commit();

            $this->success_message = trans('messages.success');
            $this->eptyForm();
            $this->currentStep = 1;
           

        } catch(Exception $ex) {
            $this->exception_message = trans('messages.exception');
            $this->currentStep = 1;
        }
    }

    private function addAttachements($parentID) 
    {
        foreach($this->photos as $photo) {
            $photo->storeAs($this->national_ID_fatehr,$photo->getClientOriginalName());

            ParentAttachement::insert([
                'fileName'=>$photo->getClientOriginalName(),'parentID'=>$parentID
            ]);

        }
    }

    /*end add parent*/

    /*start update parent*/
    public function updateParent() 
    {
        $parent = My_Parent::findorfail($this->parentID);
        try{

            DB::beginTransaction();
            $parent->update([

                'email' => $this->email,
                'fatherName' => ['ar'=>$this->name_father_ar,'en'=>$this->name_father_en], 
                'fatherJob' => ['ar'=>$this->job_father_ar,'en'=>$this->job_father_en], 
                'fatherNationalID' => $this->national_ID_fatehr, 
                'fatherPhone' => $this->phone_father,
                'fatherNationalityID' => $this->nationality_father_id ,
                'fatherBloodeID' => $this->blood_type_father_id , 
                'fatherReligionsID' => $this->religion_father_id,
                'fatherAddress' => $this->address_father,
    
                'motherName' => ['ar'=>$this->name_father_ar,'en'=>$this->name_father_en], 
                'motherJob' => ['ar'=>$this->job_father_ar,'en'=>$this->job_father_en], 
                'motherNationalID' => $this->national_ID_fatehr, 
                'motherPhone' => $this->phone_father,
                'motherNationalityID' => $this->nationality_father_id ,
                'motherBloodeID' => $this->blood_type_father_id , 
                'motherReligionsID' => $this->religion_father_id,
                'motherAddress' => $this->address_father,
    
            ]);
            
            if(isset($this->photos) && count($this->photos) > 0) {
                $this->addAttachements(My_Parent::where('fatherPhone',$this->phone_father)->first()->id);
            }

            DB::commit();

            $this->success_message = trans('messages.success');
            $this->currentStep = 1;
            $this->showTable = true;

        }catch(Exception $obj) {
            $this->exception_message = trans('messages.exception');
            $this->currentStep = 1;
        }
        
    }
    /*end update parent */

    /*start delete parent */
    public function delete($parentID) 
    {
        $parent = My_Parent::findorfail($parentID);

        $attachments = ParentAttachement::where('parentID',$parentID)->pluck('parentID','fileName');
        
        if(count($attachments) > 0) {
            foreach($attachments as $key => $value) {
                Storage::deleteDirectory('/'.$key);
            }
        }
        
        if($parent->delete()) {

            $this->success_message = trans('messages.success');

        }else {

            $this->fail_message = trans('messages.fail');

        }
    }
    /*end delete parent */
    private function fatherValidation() 
    {
        $rules = [
            'email' => 'required',
            'password' => 'required',
            'name_father_ar' => 'regex:/^[\p{Arabic}\s]+$/u' , 
            'name_father_en'=> 'regex:/^[a-zA-Z\s]+$/' , 
            'job_father_ar' => 'regex:/^[\p{Arabic}\s]+$/u', 
            'job_father_en' => 'regex:/^[a-zA-Z\s]+$/' , 
            'national_ID_fatehr' => 'required', 
            'phone_father' => 'required',
            'nationality_father_id' => 'required|numeric' ,
            'blood_type_father_id' => 'required|numeric' , 
            'religion_father_id' => 'required|numeric' ,
            'address_father' => 'required'
        ];

        $messages = [
            'name_father_ar.regex' => trans('messages.string.regex'),
            'name_father_en.regex' => trans('messages.string.regex'),
            'job_father_ar.regex' => trans('messages.string.regex'),
            'job_father_en.regex' => trans('messages.string.regex'),
        ];

         $this->validate($rules,$messages);
    }

    private function motherValidation() 
    {
        $rules = [
            'name_father_ar' => 'regex:/^[\p{Arabic}\s]+$/u' , 
            'name_father_en'=> 'regex:/^[a-zA-Z\s]+$/' , 
            'job_father_ar' => 'regex:/^[\p{Arabic}\s]+$/u', 
            'job_father_en' => 'regex:/^[a-zA-Z\s]+$/', 
            'mother_national_id' => 'required', 
            'mother_phone' => 'required',
            'mother_nationality_id' => 'required|numeric' ,
            'mother_bloode_type_id' => 'required|numeric' , 
            'mother_religion_id' => 'required|numeric' , 
            'mother_address' => 'required'
        ];
        $messages = [
            'mother_name_ar.regex' => trans('messages.string.regex'),
            'mother_name_en.regex' => trans('messages.string.regex'),
            'mother_job_ar.regex' => trans('messages.string.regex'),
            'mother_job_en.regex' => trans('messages.string.regex'),
        ];
        $this->validate($rules,$messages);

    }

    

    private function eptyForm()
    {
            $this->email = ''; 
            $this->password = '';
            //father properties
            $this->name_father_ar = '' ;
            $this->name_father_en = ''; 
            $this->job_father_ar = '' ;
            $this->job_father_en = '';
            $this->national_ID_fatehr = '' ;
            $this->address_father = '';
            $this->phone_father = ''; 
            $this->nationality_father_id = '';
            $this->blood_type_father_id = ''; 
            $this->religion_father_id = '';
            
            //mother properties
            $this->mother_name_ar = ''; 
            $this->mother_name_en = '';
            $this->mother_job_ar = ''; 
            $this->mother_job_en = '';
            $this->mother_national_id = ''; 
            $this->mother_phone = '';
            $this->mother_nationality_id = ''; 
            $this->mother_bloode_type_id = '';
            $this->mother_religion_id = ''; 
            $this->mother_address = '';
    }


    public function render()
    {
    
        return view('livewire.add-parent',[
            'nationalities'=>Nationality::all(),
            'religions'=>Religion::all(),
            'bloodes'=>Bloode::all(),
            'parents' => My_Parent::all()
        ]);
    }

    public function showFormAdd()
    {
        $this->showTable = false;
    }

    public function increaseStepSubmit() 
    {
        if($this->currentStep === 1) {
            $this->fatherValidation();
        }
        elseif($this->currentStep === 2) {
            $this->motherValidation();
        }
        $this->currentStep++;
    }

    
    public function back($pageIndex) 
    {
        $this->currentStep = $pageIndex;
    }

    
}
