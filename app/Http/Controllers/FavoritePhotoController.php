<?php

namespace App\Http\Controllers;

use Auth;
use Carbon\Carbon;
use App\Models\User;
use App\Models\FavoritePhoto;
use App\Http\Requests\FavoritePhotoRequest;
use Illuminate\Http\Request;

class FavoritePhotoController extends Controller
{
    public function index() {
        return FavoritePhoto::orderBy('id', 'desc')->get()->pluck('photo_id')->take(100);
    }

    public function store(FavoritePhotoRequest $request) {

        $validator = $request->validated();
        $user = Auth::user();

        $favoritePhoto = $user->favoritePhotos()->where('photo_id', $request->photo_id);

        if($favoritePhoto->exists()) {
            $post = $favoritePhoto->delete();
        } else {
            $favoritePhoto = FavoritePhoto::create([
                'user_id' => $user->id,
                'photo_id' => $request->photo_id
            ]);
        }        
    }

    public function userFavoritePhotos() {

        $user = Auth::user();

        $favoritePhotos = $user->favoritePhotos()->get();

        return $favoritePhotos->pluck('photo_id');
    }

    public function usersFavoritedMost() {
      
        $usersFavoritedMost = User::withCount(['favoritePhotos' => function ($query) {
            $query->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
        }])->orderBy('favorite_photos_count', 'DESC')
            ->get();

        return $usersFavoritedMost;
    }
}
