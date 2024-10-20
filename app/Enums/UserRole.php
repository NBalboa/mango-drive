<?php

namespace App\Enums;

enum UserRole: int
{
    case ADMIN = 0;
    case CUSTOMER = 1;
    case CASHIER = 2;
    case RIDER = 3;
}
