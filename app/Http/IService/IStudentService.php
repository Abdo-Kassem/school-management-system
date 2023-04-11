<?php

namespace App\Http\IService;
use App\Http\IService\ParentInterfaces\IService;
use Illuminate\Http\Request;

interface IStudentService extends IService
{
    public function getByID($studentID);

    public function uploadAttachment(Request $request);

    public function deleteAttachment(Request $request);
}

?>