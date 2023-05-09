<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Shop;
use App\Models\SecondaryCategory;
use App\Models\Image;
use App\Models\Stock;
use App\Models\User;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'shop_id',
        'name',
        'information',
        'price',
        'is_selling',
        'sort_order',
        'secondary_category_id',
        'image1',
        'image2',
        'image3',
        'image4'
    ];

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

    public function imageSecond()
    {
        return $this->belongsTo(Image::class, 'image2', 'id'); 
    }

    public function imageThird()
    {
        return $this->belongsTo(Image::class, 'image3', 'id'); 
    }

    public function imageFourth()
    {
        return $this->belongsTo(Image::class, 'image4', 'id'); 
    }

    public function stock()
    {
        return $this->hasMany(Stock::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'carts')
        ->withPivot(['id', 'quantity']);
    }
}
