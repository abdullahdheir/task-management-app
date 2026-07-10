<?php

namespace App\Enums;

use Illuminate\Support\Str;

enum Department: string
{
    case PRODUCT_DESIGN = "product_design";
    case OPERATIONS = "operations";
    case ENGINEERING = "engineering";
    case MARKETING = "marketing";
    case DESIGN = "design";
    case HUMAN_RESOURCE = "human_resource";
    case FINANCE = "finance";
    case CUSTOMER_SUCCESS = "customer_success";
    case LEGAL = "legal";
    case PRODUCT_MANAGEMENT = "product_management";
    case MANAGEMENT = "management";
    case EXECUTIVE = "executive";

    public function getLabel(): string
    {
        return Str::of($this->value)->replace('_', ' ')->title();
    }
}
