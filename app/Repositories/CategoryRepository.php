<?php
//
//namespace App\CategoryRepository;
//
//use App\Category;
//
//class CategoryRepository
//{
//    protected $model;
//
//    public function __construct()
//    {
//        $this->model = app()->make(Category::class);
//    }
//
//    //Tạo Category
//    public function storeCategory($data): Category
//    {
//        $category = $this->model->create($data);
//        return $category;
//    }
//
//    //Sửa Category
//    public function updateCategory($data, $category): bool
//    {
//        return $category->update($data);
//    }
//
//    //Show Category
//    public function showCategory($id): Category
//    {
//        return $this->model->findOrFail($id);
//    }
//
//    //Xóa Category
//    public function destroyCategory($id): bool
//    {
//        return $this->model->delete();
//    }
//}
