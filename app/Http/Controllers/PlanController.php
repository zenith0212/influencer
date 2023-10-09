<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePlanRequest;
use App\Http\Requests\UpdatePlanRequest;
use App\Models\Plan;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PlanController extends Controller
{
    public function index(): View
    {
        $this->data = array(
            'title' => 'Plans | ',
            'breadcrumbs' => array(
                'title' => 'Plans',
                'breadcrumb' => array(
                    'admin.dashboard' => __('plans.home'),
                    '',
                    'plans.index' => __('plans.title'),
                    '',
                    '#' => 'List Plan',
                ),
            ),
        );

        return view('admin.plan.index', $this->data);
    }

    public function getPlans(Request $request): JsonResponse
    {
        $draw                   = $request->get('draw');
        $start                  = $request->get("start");
        $rowPerPage             = $request->get("length"); // Rows display per page

        $columnIndex_arr        = $request->get('order');
        $columnName_arr         = $request->get('columns');
        $order_arr              = $request->get('order');
        $search_arr             = $request->get('search');

        $columnIndex            = $columnIndex_arr[0]['column']; // Column index
        $columnName             = $columnName_arr[$columnIndex]['data']; // Column name
        $columnSortOrder        = $order_arr[0]['dir']; // asc or desc
        $searchValue            = $search_arr['value']; // Search value

        // Total records
        $totalPlans                 = Plan::select('count(*) as allcount')->count();
        $totalPlansWithFilter       = Plan::select('count(*) as allcount')->where('name_en', 'like', '%' .$searchValue . '%')->count();

        // Fetch records
        $plans = Plan::latest()
            ->where('plans.name_en', 'like', "%$searchValue%")
            ->orWhere('plans.description_en', 'like', "%$searchValue%")
            ->orWhere('plans.amount', 'like', "%$searchValue%")
            ->orWhere('plans.plan_duration', 'like', "%$searchValue%")
            ->select('plans.*')
            ->skip($start)
            ->take($rowPerPage)
            ->get();

        $response = array();

        foreach ( $plans as $plan ) {
            $response[] = array(
                'id'                => $plan->id,
                'name_en'           => $plan->name_en,
                'description_en'    => $plan->description_en,
                'amount'            => $plan->amount,
                'status'            => $plan->status,
                'plan_duration'     => $plan->plan_duration,
            );
        }

        $response = array(
            'draw'                  => intval($draw),
            'iTotalRecords'         => $totalPlans,
            'iTotalDisplayRecords'  => $totalPlansWithFilter,
            'aaData'                => $response,
        );

        return response()->json($response);
    }

    public function create(): JsonResponse
    {
        $this->data = array(
            'title' => 'Create New Plan',
        );

        $view = view('admin.plan.add', $this->data)->render();
        $response = array(
            'status'        => true,
            'data'          => array(
                'view'      => $view,
            ),
        );

        return response()->json($response);
    }

    public function store( StorePlanRequest $request ): JsonResponse
    {
        $user = auth()->user();

        foreach( $request->validated()['features_group'] as $features ) {
            foreach ($features as $feature) {
                $features_en = $feature;
            }
            $features_en_group[] = $features_en;
        }
        $plan_creation = Plan::create([
            'name_en'                   => $request->validated()['name_en'],
            'description_en'            => strip_tags($request->validated()['description_en']),
            'amount'                    => $request->validated()['amount'],
            'status'                    => $request->status == '1' ? '1' : '0',
            'features_en'               => implode(',', $features_en_group),
            'plan_duration'             => $request->validated()['plan_duration'] . ' ' . $request->validated()['plan_duration_time'],
        ]);

        if ( $plan_creation ) {
            activity('created')
                ->performedOn($plan_creation)
                ->causedBy($user)
                ->log("Plan {$plan_creation->name_en} created by {$user->name}");

            $response = [
                'status'    => true,
                'message'   => 'New Plan has been created!'
            ];
        } else {
            $response = [
                'status'    => false,
                'message'   => 'Something went wrong, while create new plan.',
            ];
        }

        return response()->json($response);
    }

    public function edit($id): JsonResponse
    {
        $plan = Plan::find($id);
        if ( $plan ) {
            $plan_features_en_split     = explode(',', $plan->features_en);
            $split_plans                = explode(' ', $plan->plan_duration, 2);
            $plan_duration              = $split_plans[0];
            $plan_duration_time         = !empty($split_plans[1]) ? $split_plans[1] : '';

            $this->data = array(
                'plan'                      => $plan,
                'split_plans'               => $split_plans,
                'plan_features_en_split'    => $plan_features_en_split,
                'plan_duration'             => $plan_duration,
                'plan_duration_time'        => $plan_duration_time,
            );

            $view = view('admin.plan.edit', $this->data)->render();

            $response = array(
                'status'    => true,
                'data'      => array(
                    'view'  => $view,
                ),
            );
        } else {
            $response = array(
                'status'    => false,
                'message'   => 'Something went wrong, Plan not found.',
            );
        }

        return response()->json($response);
    }

    public function update(UpdatePlanRequest $request, $id): JsonResponse
    {
        $user = auth()->user();
        $plan = Plan::find($id);

        if ( $plan ) {
            $plan->name_en          = $request->validated()['name_en'];
            $plan->description_en   = strip_tags($request->validated()['description_en']);
            $plan->amount           = $request->validated()['amount'];

            foreach($request->validated()['features_group'] as $key => $value ) {
                foreach($value as $fn) {
                  $features_en              = $fn;
                }
                $features_en_group[]        = $features_en ;
            }
            $plan->features_en = implode(',',$features_en_group);

            if($request['status'] == null){
                $plan->status = "0";
            }else {
                $plan->status = "1";
            }

            $split_plans                    = explode(' ', $request->validated()['plan_duration'], 2);
            $plan_duration                  = $split_plans[0];
            $plan_duration_time             = !empty($split_plans[1]) ? $split_plans[1] : '';
            $plan->plan_duration            = $request->validated()['plan_duration'] . ' ' . $request->validated()['plan_duration_time'];

            $plan_updated = $plan->save();

            if($plan_updated) {
                activity('updated')
                    ->performedOn($plan)
                    ->causedBy($user)
                    ->log('Plan'. ' ' . $request->validated()['name_en'] . ' ' . 'has been updated by ' . $user->name);
            }

            return response()->json(
                 [
                   'status'     => true,
                   'message'    => 'Plan has been updated.'
                 ]
            );
        } else {

        }

        return response()->json($response);
    }


    public function destroy(Request $request)
    {
        $user           = auth()->user();
        $plans_delete   = Plan::find($request->id);
        if ( $plans_delete ) {
            $plan_name_en = $plans_delete->name_en;
            if ( $plans_delete->delete() ) {
                activity('deleted')
                ->performedOn($plans_delete)
                ->causedBy($user)
                ->log("Plan $plan_name_en  has been deleted by {$user->name}");

                return response()->json([
                    'status'    => true,
                    'message'   => 'Plan has been deleted.',
                ]);
            }
        }
        return response()->json([
            'status'    => false,
            'message'   => 'Something went wrong, Plan not found!',
        ]);

    }

    public function changeStatus(Request $request): JsonResponse
    {
        $user                   = auth()->user();
        $plans_status           = Plan::find($request->id);
        $plans_status->status   = $request->status == 'true' ? '1' : '0';
        $plans_status->save();

        if ( $plans_status->save() ) {
            activity('change_status')
                ->performedOn($plans_status)
                ->causedBy($user)
                ->log("Plan's {$plans_status->name_en}'s status has been changed by {$user->name} ");
            $response = array(
                'status'        => true,
                'message'       => 'Status has been updated.',
            );
        } else {
            $response = array(
                'status'        => false,
                'message'       => 'Something went wrong, while update the status',
            );
        }

        return response()->json($response);
    }
}

