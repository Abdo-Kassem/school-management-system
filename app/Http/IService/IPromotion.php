<?php

namespace App\Http\IService;

use App\Http\IService\ParentInterfaces\IService;

interface IPromotion extends IService
{
    public function deleteAll( $data);

    public function show($promotionID);
}
