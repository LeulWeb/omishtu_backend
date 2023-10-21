<?php

namespace App\Enums;
enum PaymentStatusEnum :string{
    case UNPAID = 'unpaid';
    case PAID = 'paid';
    case REFUND = 'refund';
    case DECLINED = 'declined';
    case PARTIAL = 'partial';
}
