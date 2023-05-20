<?php

namespace App\Http\Services;

use App\Models\Promotion;
use App\Models\Student;
use Exception;
use Illuminate\Support\Facades\DB;

class PromotionService implements \App\Http\IService\IPromotion
{

    public function getAll()
    {
        return Promotion::all();
    }

    public function store($data)
    {
        try{

            $students = Student::where('classID',$data->classID)->where('gradeID',$data->gradeID)->select(['id','gradeID','classID'])->get();
            $studentIDs = '';

            DB::beginTransaction();

            foreach($students as $student) {
                $student->gradeID = $data->gradeID_new;
                $student->classID = $data->classID_new;
                $student->save();

                $studentIDs = $studentIDs . $student->id . ',';
            }

            $promotion = new Promotion;

            $promotion->gradeID_from = $data->gradeID;
            $promotion->gradeID_to = $data->gradeID_new;
            $promotion->classID_from = $data->classID;
            $promotion->classID_to = $data->classID_new;
            $promotion->studentIDs = $studentIDs;

            $promotion->save();

            DB::commit();
            return true;

        }catch(Exception $ex) {
            DB::rollBack();
            throw $ex;
        }
        
    }

    public function update($data)
    {

    }

    public function delete($request)
    {
        if(isset($request->studentID)) {

            $promotion = Promotion::find($request->promotionID);

            DB::beginTransaction();

            $status = Student::where('id',$request->studentID)->update([
                'gradeID' => $promotion->gradeID_from,'classID' => $promotion->classID_from
            ]);

            $promotion->studentIDs = str_replace($request->studentID.',','',$promotion->studentIDs);
            $status = $promotion->save();

            DB::commit();

            return $status? true : false;

        }else {

            $promotion = Promotion::findorfail($request->promotionID);

            $studentIDs = explode(',',$promotion->studentIDs);

            DB::beginTransaction();

            Student::whereIn('id',$studentIDs)->update([
                'classID'=>$promotion->classID_from,'gradeID'=>$promotion->gradeID_from
            ]);

            $promotion->delete();

            DB::commit();
            return true;
        }
    }

    public function deleteAll($data)
    {
        $promotionIDs = explode(',',$data->promotionIDs);
        try{

            $promotions = Promotion::whereIn('id',$promotionIDs)->get();
        
            foreach($promotions as $promotion) {

                $studentIDs = explode(',',$promotion->studentIDs);

                DB::beginTransaction();

                Student::whereIn('id',$studentIDs)->update([
                    'classID'=>$promotion->classID_from,'gradeID'=>$promotion->gradeID_from
                ]);

                $promotion->delete();

                DB::commit();
            }

            return true;

        }catch(Exception $ex) {
            DB::rollBack();
            throw $ex;
        }
    }

    public function show($promotionID,&$promotion = null)
    {
        $promotion = Promotion::findorfail($promotionID);
        $studentIDs = explode(',',$promotion->studentIDs);
        return Student::wherein('id',$studentIDs)->select(['name','id'])->paginate(10);
        
    }
}
