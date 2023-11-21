<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\Subscription;
use App\Models\SubscriptionTier;
use App\Models\SubscriptionArrangement;
use App\Models\CreditCard;
use App\Models\Gcash;
use App\Models\ManualPayment;
use App\Models\ProgressWeek;
use App\Models\ProgressDay;
use App\Models\ProgressDayTask;


class MemberController extends Controller
{
    public function home() {
        return view('member.home');
    }

    public function packages() {
        return view('member.packages');
    }

    /**
     * Show to unsubscribed users
     */
    public function unavailableFitnessProgress() {
        return view('member.default-manage-fitness-view');
    }

    /**
     * 
     * My progress
     */
    public function myProgress() {
        $data['progressWeeks'] = ProgressWeek::where('user_id', Auth::user()->id)->orderBy('week_number', 'desc')->get();
        $data['user'] = Auth::user();
        return view('member.my-progress', $data);
    }

    /**
     * 
     * View/Edit My Weekly progress
     */
    public function myWeeklyProgress($wkProgressId) {
        $data['weekProgress'] = ProgressWeek::find($wkProgressId);
        $data['days'] = ProgressDay::where('progress_week_id', $wkProgressId)->get();
        $data['user'] = Auth::user();
        return view('member.my-weekly-progress-view', $data);
    }

    /**
     * Create Progress Week
     */
    public function createProgressWeek(Request $request) {
        $request->validate([
            'progress_week_title' => ['required', 'string', 'max:255'],
            'progress_week_number' => ['required', 'integer']
        ]);

        $progressWeek = new ProgressWeek([
            'week_title' => $request->progress_week_title,
            'week_number' => $request->progress_week_number,
            'status' => 'active',
            'author' => 'member',
            'start_date' => Carbon::now(),
            'end_date' => Carbon::now()->addWeeks(1),
        ]);
        $user = User::find(Auth::user()->id);
        $progressWeek->user()->associate($user);
        $progressWeek->save();

        // redirect
        return redirect()->back()->with('success', 'Progress Week Created Successfully.');
    }

    /**
     * 
     * Delete Progress Week
     */
    public function deleteProgressWeek($pw_id) {
        $pw = ProgressWeek::find($pw_id);
        $pw->delete();
        return response()->json([
            'message' => '<strong>'.ucfirst($pw->week_title).'</strong> successfully deleted.'
        ]); 
    }
    

    /**
     * 
     * Create Day Progress
     */
    public function createDayProgress(Request $request) {
        $request->validate([
            'day_title' => ['required', 'string'],
            'day_number' => ['required', 'string']
        ]);

        $progressDay = new ProgressDay([
            'day_title' => $request->day_title,
            'day_number' => $request->day_number,
            'status' => 'active',
        ]);
        $progressWeek = ProgressWeek::find($request->progress_week_id);
        $progressDay->progressWeek()->associate($progressWeek);
        $progressDay->save();

        // redirect
        return redirect()->back()->with('success', 'Progress Day Created Successfully.');
    }

    /**
     * 
     * Update Day Progress
     */
    public function updateDayProgress(Request $request) {
        $request->validate([
            'day_title' => ['required', 'string'],
            'day_number' => ['required', 'string']
        ]);
        $day = ProgressDay::find($request->day_id);
        $day->day_title = $request->day_title;
        $day->day_number = $request->day_number;
        $day->save();

        // redirect
        return redirect()->back()->with('success', 'Progress Day Updated Successfully.'); 
    }


    /**
     * 
     * Day Completed
     */
    public function dayComplete(Request $request, $dayId) {
        $day = ProgressDay::find($dayId);
        $day->status = $request->status;
        $day->save();

        // redirect
        return response()->json([
            'message' => 'Day <strong >"'.ucwords($day->day_title).'"</strong> Status has been modified.',
        ]); 
    }


    /**
     * 
     * Create Day Task
     */
    public function createDayTask(Request $request) {
        $request->validate([
            'task_title' => ['required', 'string'],
        ]);

        $dayTask = new ProgressDayTask([
            'task_title' => $request->task_title,
        ]);
        $progressDay = ProgressDay::find($request->progress_day_id);
        $dayTask->progressDay()->associate($progressDay);
        $dayTask->save();

        // redirect
        return response()->json([
            'message' => 'Task Created For <strong>'.ucwords($progressDay->day_title).'.',
            'task_id' => $dayTask->id
        ]); 
    }


    /**
     * 
     * Delete Day Progress
     */
    public function deleteDayProgress($day_id) {
        $day = ProgressDay::find($day_id);
        $day->delete();
        return response()->json([
            'message' => '<strong>'.ucfirst($day->day_title).'</strong> successfully deleted.'
        ]); 
    }



    /**
     * 
     * Delete Day Task
     */
    public function deleteDayTask($task_id) {
        $task = ProgressDayTask::find($task_id);
        $task->delete();
        return response()->json([
            'message' => '<strong>'.ucfirst($task->task_title).'</strong> successfully deleted.'
        ]); 
    }


    /**
     * Create Progress Week
     */
    public function updateProgressWeek(Request $request) {
        $request->validate([
            'progress_week_title' => ['required', 'string', 'max:255'],
            'progress_week_number' => ['required', 'integer']
        ]);

        $progressWeek = ProgressWeek::find($request->pw_id);
        $progressWeek->week_title = $request->progress_week_title;
        $progressWeek->week_number = $request->progress_week_number;
        $progressWeek->save();

        // redirect
        return redirect()->back()->with('success', 'Progress Week Updated Successfully.');
    }

    /**
     * 
     * View Membership Details
     */
    public function membershipDetails() {
        $subscription = Subscription::where('user_id', Auth::user()->id)->first();
        $data['subscription'] = $subscription;
        if($subscription) {
            $current_date = date('Y-m-d');
            $start_timestamp = strtotime($subscription->start_date);
            $end_timestamp = strtotime($subscription->end_date);
            $current_timestamp = strtotime($current_date);
            $data['total_days'] = ($end_timestamp - $start_timestamp) / (60 * 60 * 24);
            $data['days_elapsed'] = ($current_timestamp - $start_timestamp) / (60 * 60 * 24);
            $data['percentage_completed'] = ($data['days_elapsed'] / $data['total_days']) * 100;
    
            $data['start_date'] = Carbon::parse($subscription->start_date);
            $data['end_date']= Carbon::parse($subscription->end_date);
    
            
            $data['tier'] = SubscriptionTier::where('id', $subscription->subscription_tier_id)->first();
            $data['user'] = Auth::user();

            $data['assigned_staff'] = User::find($subscription->staff_assigned_id);

            if($subscription->payment_option == 'credit card') {
                $data['creditCard'] = CreditCard::where('subscription_id', $subscription->id)->first();
            } else if ($subscription->payment_option == 'gcash') {
                $data['gCash'] = Gcash::where('subscription_id', $subscription->id)->first();
            } else if ($subscription->payment_option == 'manual payment') {
                $data['manualPayment'] = ManualPayment::where('subscription_id', $subscription->id)->first();
            }


            return view('member.membership-details', $data);
        }

        return view('member.membership-details', $data);
    }

}
