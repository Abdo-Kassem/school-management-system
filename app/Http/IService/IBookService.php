<?php

namespace App\Http\IService;
use App\Http\IService\ParentInterfaces\IService;

interface IBookService extends IService
{

    public function downloadAttachment($fileName);

    public function create();

    public function getAllOfTeacher();

    public function getAllOfStudent();

    public function createByTeacher();

}

?>