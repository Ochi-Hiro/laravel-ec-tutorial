<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Shop;
use App\Models\SecondaryCategory;
use App\Models\Image;

class Product extends Model
{
    use HasFactory;

    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }

    public function category()
    {
        return $this->belongsTo(SecondaryCategory::class, 'secondary_category_id');
        //メソッド名を省略しているので第2引数で外部キーのカラム名を指定する。
    }

    public function imageFirst() //メソッド名をimage1にすると、productsデータベースのimage1カラムと全く同じ名前のためエラーになる
    {
        return $this->belongsTo(Image::class, 'image1', 'id'); 
        //(~_id)だとidカラムと判別してくれるが、違う場合は第３引数で指定する
    }
}
