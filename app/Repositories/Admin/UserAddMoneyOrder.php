<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Extensions\Asset\AssetAmountMorphMany;

class UserAddMoneyOrder extends Model
{
    use AssetAmountMorphMany;
}
