<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
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

class StaffController extends Controller
{
    public function home() {
        // Registered Users Data
        $now = Carbon::now();
        $data['registered_today'] = User::where('role', 'member')->whereDate('created_at', $now->toDateString())->count();

        return view('staff.home', $data);
    }

    public function manageFitnessView() {
        return view('staff.manage-fitness');
    }

    /**
     * 
     * Trainer Progress View
     */
    public function trainerProgress() {
        $data['progressWeeks'] = ProgressWeek::where('user_id', Auth::user()->id)->orderBy('week_number', 'asc')->get();
        $data['user'] = Auth::user();
        return view('staff.trainer-progress', $data);
    }

    /**
     * 
     * View/Edit My Weekly progress
     */
    public function myWeeklyProgress($wkProgressId) {
        $data['weekProgress'] = ProgressWeek::find($wkProgressId);
        $data['days'] = ProgressDay::where('progress_week_id', $wkProgressId)->orderBy('day_number', 'asc')->get();
        $data['user'] = Auth::user();
        return view('staff.week-progress-view', $data);
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
     * Create Staff
     */
    public function createStaff(Request $request) {
        $request->validate([
            'email' => ['required', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed', 'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^\da-zA-Z]).+$/'],
            'firstName' => ['required', 'string', 'max:255'],
            'lastName' => ['required', 'string', 'max:255'],
            'role' => ['string', 'max:255', 'default:member'],
        ], [
            'password.regex' => 'Your password must contain at least one lowercase letter, one uppercase letter, one number, and one special character.'
        ]);

        $user = User::create([
            'email' => strtolower($request->email),
            'password' => Hash::make(strtolower($request->password)),
            'firstname' => strtolower($request->firstName),
            'lastname' => strtolower($request->lastName),
            'role' => 'staff',
        ]);

        $user->save();
        return redirect()->back()->with('success', 'Staff successfully created.');
    }

    /**
     * Update staff record
     */
    public function updateStaff(Request $request) {
        $request->validate([
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($request->staffId)],
            'password' => ['required', 'string', 'min:8', 'confirmed', 'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^\da-zA-Z]).+$/'],
            'firstName' => ['required', 'string', 'max:255'],
            'lastName' => ['required', 'string', 'max:255'],
            'role' => ['string', 'max:255', 'default:member'],
        ], [
            'password.regex' => 'Your password must contain at least one lowercase letter, one uppercase letter, one number, and one special character.'
        ]);

        $user = User::find($request->staffId);
        $user->email = strtolower($request->email);
        $user->password = Hash::make(strtolower($request->password));
        $user->firstname = strtolower($request->firstName);
        $user->lastname = strtolower($request->lastName);
        $user->save();
        return redirect()->back()->with('success', 'Staff successfully created.');
    }

    /**
     * Get Staff records
     */
    public function staffRecords($role) {
        $data['users'] = User::where('role', $role)->paginate(10);
        $data['role'] = $role;
        return view('management.staff-records', $data);
    }

    public function search(Request $request) {
        $query = $request->input('query');

        $users = User::where('role', 'staff')
        ->where(function ($queryBuilder) use ($query) {
            $queryBuilder->where('firstname', 'like', '%' . $query . '%')
                ->orWhere('lastname', 'like', '%' . $query . '%')
                ->orWhere('email', 'like', '%' . $query . '%')
                ->orWhere('status', 'like', '%' . $query . '%');
        })
        ->get();

        return response()->json(['users' => $users]);
    }

}
