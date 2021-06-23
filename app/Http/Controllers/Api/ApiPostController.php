<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ExamsService;
use Symfony\Component\HttpFoundation\Response;
use App\Post;
use App\Category_post;
use Illuminate\Support\Facades\Storage;
use phpDocumentor\Reflection\Types\AbstractList;
use Session;

class ApiPostController extends Controller
{
    private $examService, $category;

    public function __construct(Post $examService123, Category_post $category){
        $this->examService = $examService123;
        $this->category = $category;
    }           

    public function store(Request $request){
        try{
            $post = $this->examService->getFirstByIdViewCount(['name'=>$request->view_count]);

            return response()->json([
                'status'   => true,
                'code'     => Response::HTTP_OK,
                'post'     => $post,
            ]);
        }catch(\Exception $e){
            return response()->json([
                'status' => false,
                'code'  => Response::HTTP_OK,
                'message' => $e->getMessage(),
            ]);
        }
        
    }

    public function update(Request $request, $id)
    {
        try{
            $post = Post::findOrFail($id);

            return response()->json([
                'status'   => true,
                'code'     => Response::HTTP_OK,
                'postList' =>  $post,
            ]);
        }catch(\Exception $e){
            return response()->json([
                'status' => false,
                'code'  => Response::HTTP_OK,
                'message' => $e->getMessage(),
            ]);
        }

        $post = Post::findOrFail($id);
        $post->update($request->all());
    }

    public function getAll(Request $request){
        try {
            // $post = $this->examService->getAll();
            // dd($post);
            return response()->json([
                'status'   => true,
                'code'     => Response::HTTP_OK,
                'postList' =>  $this->examService->getAll(),
            ]);
        } catch (\Exception $e){
            return response()->json([
                'status'  => false,
                'code'    => Response::HTTP_INTERNAL_SERVER_ERROR,
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function index(Request $request)
    {
        try {
            $examPaginate = $this->examService->getAllPaginate();
            // dd($examPaginate);
            return response()->json([
                'status' => true,
                'code'   => Response::HTTP_OK,
                'exams'  => $examPaginate->items(),
                'meta'   => [
                    'total'       => $examPaginate->total(),
                    'perpage'     => $examPaginate->perPage(),
                    'currentPage' => $examPaginate->currentPage(),
                ],
            ]);

        } catch (\Exception $e){
            return response()->json([
                'status'  => false,
                'code'    => Response::HTTP_INTERNAL_SERVER_ERROR,
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function getFirstByIdViewCount(Request $request, $id)
    {
        try {
            return response()->json([
                'status'  => true,
                'code'    => Response::HTTP_OK,
                'post'    => $this->examService->getFirstById($id),
                'categories' => $this->category->category(),
            ]);

        } catch(\Exception $e){
            return response()->json([
                'status' => false,
                'code'   => Response::HTTP_INTERNAL_SERVER_ERROR,
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function SessionViewCount(Request $request, $id){
        $post = Post::getFirstByIdViewCount($id);
        return [$post];
    }


    public function showMain(){
        try{
            // dd(Session::has('view_count'));
            return response()->json([
                'status' => true,
                'code'   => Response::HTTP_OK,
                'postAll' => $this->examService->getListApi(),
                'postMain'   => $this->examService->showMain(),
                'post1'   => $this->examService->showSub1(),
                'post2'   => $this->examService->showSub2(),
                'postNew' => $this->examService->showNew(),
                'categories' => $this->category->category(),
                // 'test' => $test,
            ]);
        } catch(\Exception $e){
            return response()->json([
                'status' => false,
                'code'   => Response::HTTP_INTERNAL_SERVER_ERROR,
                'message' => $e->getMessage(),
            ]);
        }
    }


    public function showCategory($category){
        try{
            return response()->json([
                'status' => true,
                'code' => true,
                'code'   => Response::HTTP_OK,
                'postMain' => Post::where('post_category', $category)->latest('updated_at')->take(1)->first(),
                'postCategory' => Post::where('post_category', $category)->latest('updated_at')->skip(1)->take(5)->get(),
                'postNew' => Post::showNew($category),
                'categories' => $this->category->category(),
            ]);
        }
        catch(\Exception $e){
            return response()->json([
                'status' => false,
                'code'   => Response::HTTP_INTERNAL_SERVER_ERROR,
                'message' => $e->getMessage(),
            ]);
        }
    }
}
