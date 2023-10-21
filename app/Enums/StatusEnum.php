<?php

namespace App\Enums;
enum StatusEnum :string{
    case NEW = 'new';
    case ONGOING = 'ongoing';
    case COMPLETED = 'completed';
    case DECLINED = 'declined';
}
