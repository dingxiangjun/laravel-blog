<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Extensions\Asset\AssetAmountMorphMany;

class UserWithdrawOrder extends Model
{
    use AssetAmountMorphMany;
}
