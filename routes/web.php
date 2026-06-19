<?php

use App\Http\Controllers\ActivityController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AnimeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlockController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CustomListController;
use App\Http\Controllers\LibraryController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\SettingsController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AnimeController::class, 'landing'])->name('landing');
Route::get('/discover', [AnimeController::class, 'discover'])->name('discover');
Route::get('/seasonal', [AnimeController::class, 'seasonal'])->name('seasonal');
Route::get('/top-anime', [AnimeController::class, 'top'])->name('top-anime');
Route::get('/search', [AnimeController::class, 'search'])->name('search');
Route::get('/anime/{anime}', [AnimeController::class, 'show'])->name('anime.show');
Route::get('/reviews', [ReviewController::class, 'index'])->name('reviews.index');
Route::get('/reviews/{review}', [ReviewController::class, 'show'])->name('reviews.show');
Route::get('/users/{user:username}', [ProfileController::class, 'show'])->name('profiles.show');
Route::get('/users/{user:username}/library', [ProfileController::class, 'library'])->name('profiles.library');
Route::get('/users/{user:username}/reviews', [ProfileController::class, 'reviews'])->name('profiles.reviews');
Route::get('/users/{user:username}/lists', [ProfileController::class, 'lists'])->name('profiles.lists');
Route::get('/users/{user:username}/activity', [ProfileController::class, 'activity'])->name('profiles.activity');
Route::get('/users/{user:username}/followers', [ProfileController::class, 'followers'])->name('profiles.followers');
Route::get('/users/{user:username}/following', [ProfileController::class, 'following'])->name('profiles.following');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
    Route::view('/forgot-password', 'auth.forgot-password')->name('password.request');
});

Route::middleware(['auth'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/home', [LibraryController::class, 'home'])->name('home');
    Route::get('/library/{status?}', [LibraryController::class, 'index'])
        ->whereIn('status', ['watching', 'completed', 'planned', 'on-hold', 'dropped'])
        ->name('library.index');
    Route::patch('/library/bulk/update', [LibraryController::class, 'bulk'])->name('library.bulk');
    Route::patch('/library/{libraryEntry}', [LibraryController::class, 'update'])->name('library.update');
    Route::delete('/library/{libraryEntry}', [LibraryController::class, 'destroy'])->name('library.destroy');
    Route::get('/activity', ActivityController::class)->name('activity.index');
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::patch('/notifications/read', [NotificationController::class, 'markAllRead'])->name('notifications.read');
    Route::patch('/notifications/{notification}/read', [NotificationController::class, 'markRead'])->name('notifications.item.read');
    Route::delete('/notifications/{notification}', [NotificationController::class, 'destroy'])->name('notifications.destroy');
    Route::get('/lists', [CustomListController::class, 'index'])->name('lists.index');
    Route::get('/lists/create', [CustomListController::class, 'create'])->name('lists.create');
    Route::post('/lists', [CustomListController::class, 'store'])->name('lists.store');
    Route::get('/lists/{customList}/edit', [CustomListController::class, 'edit'])->name('lists.edit');
    Route::patch('/lists/{customList}', [CustomListController::class, 'update'])->name('lists.update');
    Route::delete('/lists/{customList}', [CustomListController::class, 'destroy'])->name('lists.destroy');
    Route::post('/lists/{customList}/like', [CustomListController::class, 'like'])->name('lists.like');
    Route::post('/lists/{customList}/save', [CustomListController::class, 'save'])->name('lists.save');
    Route::get('/reviews/create/{anime}', [ReviewController::class, 'create'])->name('reviews.create');
    Route::post('/reviews/create/{anime}', [ReviewController::class, 'store'])->name('reviews.store');
    Route::get('/reviews/{review}/edit', [ReviewController::class, 'edit'])->name('reviews.edit');
    Route::patch('/reviews/{review}', [ReviewController::class, 'update'])->name('reviews.update');
    Route::delete('/reviews/{review}', [ReviewController::class, 'destroy'])->name('reviews.destroy');
    Route::post('/reviews/{review}/like', [ReviewController::class, 'like'])->name('reviews.like');
    Route::post('/reviews/{review}/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::patch('/comments/{comment}', [CommentController::class, 'update'])->name('comments.update');
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');
    Route::post('/comments/{comment}/like', [CommentController::class, 'like'])->name('comments.like');
    Route::get('/reports/create', [ReportController::class, 'create'])->name('reports.create');
    Route::post('/reports', [ReportController::class, 'store'])->name('reports.store');
    Route::get('/reports/thanks', [ReportController::class, 'thanks'])->name('reports.thanks');
    Route::post('/users/{user:username}/follow', [ProfileController::class, 'follow'])->name('profiles.follow');
    Route::delete('/users/{user:username}/follow', [ProfileController::class, 'unfollow'])->name('profiles.unfollow');
    Route::post('/users/{user:username}/block', [BlockController::class, 'store'])->name('profiles.block');
    Route::delete('/users/{user:username}/block', [BlockController::class, 'destroy'])->name('profiles.unblock');
    Route::get('/settings/profile', [SettingsController::class, 'profile'])->name('settings.profile');
    Route::patch('/settings/profile', [SettingsController::class, 'updateProfile'])->name('settings.profile.update');
    Route::get('/settings/account', [SettingsController::class, 'account'])->name('settings.account');
    Route::patch('/settings/account', [SettingsController::class, 'updateAccount'])->name('settings.account.update');
    Route::get('/settings/account/export', [SettingsController::class, 'export'])->name('settings.account.export');
    Route::delete('/settings/account', [SettingsController::class, 'destroyAccount'])->name('settings.account.destroy');
    Route::get('/settings/privacy', [SettingsController::class, 'privacy'])->name('settings.privacy');
    Route::patch('/settings/privacy', [SettingsController::class, 'updatePrivacy'])->name('settings.privacy.update');
    Route::get('/settings/notifications', [SettingsController::class, 'notifications'])->name('settings.notifications');
    Route::patch('/settings/notifications', [SettingsController::class, 'updateNotifications'])->name('settings.notifications.update');
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/admin/users', [AdminController::class, 'users'])->name('admin.users');
    Route::patch('/admin/users/{user}', [AdminController::class, 'updateUser'])->name('admin.users.update');
    Route::get('/admin/reviews', [AdminController::class, 'reviews'])->name('admin.reviews');
    Route::patch('/admin/reviews/{review}', [AdminController::class, 'updateReview'])->name('admin.reviews.update');
    Route::get('/admin/comments', [AdminController::class, 'comments'])->name('admin.comments');
    Route::patch('/admin/comments/{comment}', [AdminController::class, 'updateComment'])->name('admin.comments.update');
    Route::get('/admin/reports', [AdminController::class, 'reports'])->name('admin.reports');
    Route::patch('/admin/reports/{report}', [AdminController::class, 'updateReport'])->name('admin.reports.update');
    Route::get('/admin/anime-cache', [AdminController::class, 'animeCache'])->name('admin.anime-cache');
    Route::post('/admin/anime-cache/refresh', [AdminController::class, 'refreshAnime'])->name('admin.anime-cache.refresh');
});

Route::get('/lists/{customList}', [CustomListController::class, 'publicShow'])->name('lists.show');
