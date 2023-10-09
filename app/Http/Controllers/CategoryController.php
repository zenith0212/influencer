<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function index(): View
    {
        $this->data = array(
            'title' => 'Categories | ',
            'breadcrumbs' => array(
                'title' => 'Categories',
                'breadcrumb' => array(
                    'admin.dashboard' => __('categories.home'),
                    '',
                    'categories.index' => __('categories.title'),
                    '',
                    '#' => 'List Categories',
                ),
            ),
        );
        return view('admin.category.index', $this->data);

    }

    public function getCategories(Request $request): JsonResponse
    {
        ## Read value
        $draw                   = $request->get('draw');
        $start                  = $request->get("start");
        $rowperpage             = $request->get("length"); // Rows display per page

        $columnIndex_arr        = $request->get('order');
        $columnName_arr         = $request->get('columns');
        $order_arr              = $request->get('order');
        $search_arr             = $request->get('search');

        $columnIndex            = $columnIndex_arr[0]['column']; // Column index
        $columnName             = $columnName_arr[$columnIndex]['data']; // Column name
        $columnSortOrder        = $order_arr[0]['dir']; // asc or desc
        $searchValue            = $search_arr['value']; // Search value

        // Total records
        $totalCategories                = Category::select('count(*) as allcount')->count();
        $totalCategoriesWithFilter      = Category::select('count(*) as allcount')->where('name_en', 'like', '%' .$searchValue . '%')->count();

        // Fetch records
        $categories = Category::latest()
            ->where('categories.name_en', 'like', '%' .$searchValue . '%')
            ->orWhere('categories.description_en', 'like', '%' .$searchValue . '%')
            ->select('categories.*')
            ->skip($start)
            ->take($rowperpage)
            ->get();

        $response = array();

        foreach( $categories as $category ) {
            $response[] = array(
                'id'                => $category->id,
                'name_en'           => $category->name_en,
                'description_en'    => $category->description_en,
                'image'             => $category->image,
            );
        }

        return response()->json(array(
            'draw'                  => intval($draw),
            'iTotalRecords'         => $totalCategories,
            'iTotalDisplayRecords'  => $totalCategoriesWithFilter,
            'aaData'                => $response,
         ));
    }

    public function create(): JsonResponse
    {
        $this->data = array(
            'title' => 'Create Category',
        );

        $view = view('admin.category.add', $this->data)->render();

        $response = array(
            'status'    => true,
            'data'      => array(
                'view'  => $view,
            ),
        );

        return response()->json($response);
    }

    public function store( StoreCategoryRequest $request ): JsonResponse
    {
        $user = auth()->user();

        if ( $request->file('image') != null ) {

            $validated_data         = $request->validated();
            $fileName               = '';

            if ( $request->file() ) {
                $fileName           = time().'_'.$validated_data['image']->getClientOriginalName();
                $filePath           = $request->file('image')->storeAs('categoriesUploads', $fileName, 'public');
            }

            $category = Category::create([
                'name_en'           => $validated_data['name_en'],
                'description_en'    => strip_tags($validated_data['description_en']),
                'image'             => $fileName,
            ]);

            if ( $category ) {
                activity('created')
                    ->performedOn($category)
                    ->causedBy($user)
                    ->log('Category '. ' ' . $validated_data['name_en'] . ' ' . 'created by ' . $user->name);

                return response()->json([
                    'status'    => true,
                    'message'   => 'New Category has been created!'
                ]);
            }
        }
        return response()->json([
            'status'    => false,
            'message'   => 'Something went wrong while create a new category.',
        ]);
    }

    public function edit($id): JsonResponse
    {
        $category = Category::find($id);

        if ( $category ) {
            $this->data = array(
                'category' => $category,
            );
            $view = view('admin.category.edit', $this->data)->render();

            $response = array(
                'status'    => true,
                'data'      => array(
                    'view'  => $view,
                ),
            );
        } else {
            $response = array(
                'status'    => false,
                'message'   => 'Something went wrong.',
            );
        }

        return response()->json($response);
    }

    public function update(UpdateCategoryRequest $request, $id): JsonResponse
    {
        $user           = auth()->user();
        $category       = Category::find($id);

        if ( $category ) {

            $category->name_en          = $request->validated()['name_en'];
            $category->description_en   = strip_tags($request->validated()['description_en']);

            if ( $request->file() ) {
                $fileName               = time().'_'.$request->image->getClientOriginalName();
                $filePath               = $request->file('image')->storeAs('categoriesUploads', $fileName, 'public');
                $category->image        = $fileName;
            }

            if ( $category->save() ) {
                activity('updated')
                    ->performedOn($category)
                    ->causedBy($user)
                    ->log("Category {$category->name_en} has been updated by {$user->name}");

                $response = [
                    'status'    => true,
                    'message'   => 'Category has been updated.'
                ];
            } else {
                $response = [
                    'status'    => false,
                    'message'   => 'Something went wrong while update the category.',
                ];
            }
        } else {
            $response = [
                'status'        => false,
                'message'       => 'Something went wrong, category not found.',
            ];
        }
        return response()->json( $response );
    }

    public function destroy(Request $request): JsonResponse
    {
        $user               = auth()->user();
        $category_delete    = Category::findOrFail($request->id);

        if ( $category_delete ) {

            $name_en = $category_delete->name_en;

            if ( $category_delete->delete() ) {
                activity('deleted')
                    ->performedOn($category_delete)
                    ->causedBy($user)
                    ->log("Category $name_en has been deleted by {$user->name}");

                return response()->json([
                    'status'    => true,
                    'message'   => 'Category has been deleted!',
                ]);
            }

            return response()->json([
                'status'        => false,
                'message'       => 'Something went wrong! Category not found!',
            ]);
        }
        return response()->json([
            'status'        => false,
            'message'       => 'Something went wrong! Category not found!',
        ]);
    }
}
