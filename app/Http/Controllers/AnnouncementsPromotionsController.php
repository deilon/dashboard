<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\AnnouncementsPromotion;
use App\Models\User;


class AnnouncementsPromotionsController extends Controller
{
    public function index() {
        $data['aps'] = AnnouncementsPromotion::orderBy('created_at', 'desc')->get();
        return view('admin.announcements-promotions', $data);
    }

    public function create(Request $request) {
        // Validate 
        $request->validate([
            "title" => ['required', 'string', 'max:255'],
            "tag" => ['required', 'string', 'max:255'],
            'description' => ['sometimes', 'nullable', 'string', 'max:255'],
            'photo' => ['sometimes', 'image', 'max:2048']
        ]);

        $user = Auth::user();
        $ap = new AnnouncementsPromotion([
            'ap_title' => $request->title,
            'ap_tag' => $request->tag,
            'ap_description' => $request->description,
        ]);

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $defaultImageFilename = 'default_announcement.png';
    
            // Check if the uploaded file's original filename matches the default image filename
            if ($file->getClientOriginalName() !== $defaultImageFilename) {
                $oldPhoto = $user->photo;
                // Handle uploading the new photo
                $filename = $file->hashName();
                $imagePath = $file->storeAs('public/assets/img/layouts', $filename);
                $ap->photo = $filename;

                Storage::delete('public/assets/img/layouts/' . $oldPhoto);
            } 
        } else {
            $ap->photo = null;
        }

        $ap->user()->associate($user);
        $ap->save();
        // redirect
        return redirect('admin/announcements-promotions')->with('success', 'You have successfully added new Announcement/Promotion.');
    }

    public function update(Request $request) {
        // Validate 
        $request->validate([
            "title" => ['required', 'string', 'max:255'],
            "tag" => ['required', 'string', 'max:255'],
            'description' => ['sometimes', 'nullable', 'string', 'max:255'],
            'photo' => ['sometimes', 'image', 'max:2048']
        ]);

        $user = User::find($request->authorId);
        $ap = AnnouncementsPromotion::where('id', $request->apId)->first();
        $ap->ap_title = $request->title;
        $ap->ap_tag = $request->tag;
        $ap->ap_description = $request->description;

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $defaultImageFilename = 'default_announcement.png';
    
            // Check if the uploaded file's original filename matches the default image filename
            if ($file->getClientOriginalName() !== $defaultImageFilename) {
                $oldPhoto = $user->photo;
                // Handle uploading the new photo
                $filename = $file->hashName();
                $imagePath = $file->storeAs('public/assets/img/layouts', $filename);
                $ap->photo = $filename;

                Storage::delete('public/assets/img/layouts/' . $oldPhoto);
            } 
        }

        $ap->user()->associate($user);
        $ap->save();
        // redirect
        return redirect('admin/announcements-promotions')->with('success', 'You have successfully updated Announcement/Promotion.');
    }

    public function delete($ap_id) {
        $ap = AnnouncementsPromotion::find($ap_id);
        $ap->delete();
        return response()->json([
            'message' => '<strong>'.ucfirst($ap->ap_title).'</strong> successfully deleted.'
        ]); 
    }
}
