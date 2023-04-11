<?php

namespace App\Http\IService\ParentInterfaces;

interface IService
{
    public function getAll();

    public function store($data);

    public function update($data);

    public function delete($id);
    
}


?>