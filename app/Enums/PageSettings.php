<?php

namespace App\Enums;

enum PageSettings: int
{
    case ADMIN_QUANTITY_ITEMS_PER_PAGE = 10;
    case API_QUANTITY_ITEMS_PER_PAGE = 3;
}
